<?php

namespace alcamo\collection;

use alcamo\exception\SyntaxError;

/**
 * @brief (De)Serializer for a subset of RFC 4514 syntax
 *
 * @date Last reviewed 2026-10-23
 */
class Rfc4514Serializer
{
    /// Mapping of characters to escape to the escaped versions
    public const ESCAPE_MAP = [
        "\x00" => '\\00',
        "\x01" => '\\01',
        "\x02" => '\\02',
        "\x03" => '\\03',
        "\x04" => '\\04',
        "\x05" => '\\05',
        "\x06" => '\\06',
        "\x07" => '\\07',
        "\x08" => '\\08',
        "\x09" => '\\09',
        "\x0A" => '\\0A',
        "\x0B" => '\\0B',
        "\x0C" => '\\0C',
        "\x0D" => '\\0D',
        "\x0E" => '\\0E',
        "\x0F" => '\\0F',
        "\x10" => '\\10',
        "\x11" => '\\11',
        "\x12" => '\\12',
        "\x13" => '\\13',
        "\x14" => '\\14',
        "\x15" => '\\15',
        "\x16" => '\\16',
        "\x17" => '\\17',
        "\x18" => '\\18',
        "\x19" => '\\19',
        "\x1A" => '\\1A',
        "\x1B" => '\\1B',
        "\x1C" => '\\1C',
        "\x1D" => '\\1D',
        "\x1E" => '\\1E',
        "\x1F" => '\\1F',
        "\xFF" => '\\FF',
        ' ' => '\\ ',
        '"' => '\\"',
        '#' => '\\#',
        '+' => '\\+',
        ',' => '\\,',
        ';' => '\\;',
        '<' => '\\<',
        '=' => '\\=',
        '>' => '\\>',
        '\\' => '\\\\'
    ];

    /// Mapping of escaped characters to unescaped ones
    public const UNESCAPE_MAP = [
        '\\ ' => ' ',
        '\\"' => '"',
        '\\#' => '#',
        '\\+' => '+',
        '\\,' => ',',
        '\\;' => ';',
        '\\<' => '<',
        '\\=' => '=',
        '\\>' => '>',
        '\\\\' => '\\'
    ];

    /**
     * @brief Regexp describing a valid keystring
     *
     * @sa [RFC 4512 section 1.4](https://www.rfc-editor.org/info/rfc4512/#section-1.4)
     */
    public const KEYSTRING_REGEXP = '/^[A-Za-z][-0-9A-Za-z]*$/';

    /// Complete regexp describing a string to deserialize
    public const PARSE_REGEXP =
        '/([A-Za-z][-0-9A-Za-z]*)=(([^,\\\\]*(\\\\.)*)*),/A';

    /**
     * @brief Regexp describing a sequence of backslashes of odd length
     *
     * The lookbehind assertion ensures that the last backslash is not
     * preceded by a sequence of backslashes of odd length (of at most 15
     * backslashes since a lookbehind assertion must be of limited length).
     */
    public const ODD_LENGTH_BACKSLASH_SEQUENCE_REGEXP =
        '(?<!(?:^|[^\\\\])\\\\(?:\\\\\\\\){0,7})\\\\';

    /**
     * @brief Regexp describing a hexstring escape
     *
     * @sa [RFC 4514 section 3](https://www.rfc-editor.org/info/rfc4514/#section-3)
     */
    public const HEXSTRING_REGEXP =
        '/' . self::ODD_LENGTH_BACKSLASH_SEQUENCE_REGEXP . '([0-9A-Fa-f]{2})/';

    public const INVALID_ESCAPE =
        '/' . self::ODD_LENGTH_BACKSLASH_SEQUENCE_REGEXP . '[^ "#+,;<=>\\\\]/';

    /**
     * @brief Serialize any iterable to a string in RFC 4514 syntax
     *
     * Each key-value pair is serialized as described in [RFC 4514 section
     * 2.2](https://www.rfc-editor.org/info/rfc4514/#section-2.2) as if it
     * were a RelativeDistinguishedName. The key is copied verbatim. In the
     * value, all characters from \x00 to \x1F are escaped, as well as all the
     * characters for which escaping with a backslash prefix is allowed. This
     * is more than the minimum escaping required by RFC 4514, but it allows
     * for a simple and fast implementation.
     */
    public function serialize(iterable $data): string
    {
        $result = '';

        foreach ($data as $key => $value) {
            if (!preg_match(static::KEYSTRING_REGEXP, $key)) {
                /** @throw alcamo::exception::SyntaxError if a key is not a
                 *  valid key string according to
                 * [RFC 4512 section 1.4](https://www.rfc-editor.org/info/rfc4512/#section-1.4).
                 */
                throw (new SyntaxError())->setMessageContext(
                    [
                        'forKey' => $key,
                        'extraMessage' => 'not a valid RFC 4512 keystring'
                    ]
                );
            }

            if (isset($result[0])) {
                $result .= ',';
            }

            $result .= $key . '=' . strtr($value, static::ESCAPE_MAP);
        }

        return $result;
    }

    public function deserialize(string $text, &$result = null)
    {
        if (!isset($result)) {
            $result = [];
        }

        /* Appending a comma to the text significantly simplifies the regexp
         * needed to parse it. */
        for (
            $offset = 0;
            preg_match(
                static::PARSE_REGEXP,
                "$text,",
                $matches,
                PREG_OFFSET_CAPTURE,
                $offset
            );
            $offset += strlen($matches[0][0])
        ) {
            $value = preg_replace_callback(
                static::HEXSTRING_REGEXP,
                function ($matches) {
                    return chr(intval($matches[1], 16));
                },
                $matches[2][0]
            );

            if (preg_match(static::INVALID_ESCAPE, $value)) {
                /** @throw alcamo::exception::SyntaxError if a value contains
                 *  escapes which are invalid in RFC 4514 syntax. */
                throw (new SyntaxError())->setMessageContext(
                    [
                        'inData' => $value,
                        'forKey' => $matches[1][0],
                        'extraMessage' => 'not valid RFC 4514 syntax'
                    ]
                );
            }

            $result[$matches[1][0]] = strtr($value, static::UNESCAPE_MAP);
        }

        if (isset($text[$offset - 1])) {
            /** @throw alcamo::exception::SyntaxError if a text is not a valid
             *  string in RFC 4514 syntax. */
            throw (new SyntaxError())->setMessageContext(
                [
                    'inData' => $text,
                    'atOffset' => $offset,
                    'extraMessage' => 'not valid RFC 4514 syntax'
                ]
            );
        }

        return $result;
    }
}
