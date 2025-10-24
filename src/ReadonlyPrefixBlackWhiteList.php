<?php

namespace alcamo\collection;

use Ds\Set;

/**
 * @brief Blacklist or whitelist of prefixes
 *
 * @date Last reviewed 2025-10-15
 */
class ReadonlyPrefixBlackWhiteList extends ReadonlyPrefixSet
{
    use BlackWhiteListTrait;

    /**
     * @brief Create from list of prefixes
     *
     * @param $prefixText String of prefixes
     *
     * @param $isBlacklist Whether this is a blacklist.
     *
     * @param $sepRegexp Separator regular expression [default whitespace]
     */
    public static function newFromStringAndBool(
        string $prefixText,
        ?bool $isBlacklist = null,
        ?string $sepRegexp = null
    ): self {
        return new self(
            new Set(
                preg_split(
                    $sepRegexp ?? '/\s+/',
                    $prefixText,
                    -1,
                    PREG_SPLIT_NO_EMPTY
                )
            ),
            $isBlacklist
        );
    }

    /**
     * @brief Create from list of prefixes
     *
     * @param $prefixText String of prefixes. Return a blacklist if the first
     * character is an exclamation mark. The exclamation mark may optionally
     * be followed by a separator.
     *
     * @param $sepRegexp Separator regular expression [default whitespace]
     */
    public static function newFromStringWithOperator(
        string $prefixText,
        ?string $sepRegexp = null
    ): self {
        if ($prefixText[0] == '!') {
            $isBlacklist = true;
            $prefixText = substr($prefixText, 1);
        } else {
            $isBlacklist = false;
        }

        return self::newFromStringAndBool($prefixText, $isBlacklist);
    }

    /**
     * @param $prefixes Set of prefixes.
     *
     * @param $isBlacklist Whether the prefixes form a blacklist rather than a
     * whitelist.
     */
    public function __construct(Set $prefixes, ?bool $isBlacklist = null)
    {
        parent::__construct($prefixes);

        $this->isBlacklist_ = (bool)$isBlacklist;
    }
}
