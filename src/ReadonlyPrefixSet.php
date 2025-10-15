<?php

namespace alcamo\collection;

use Ds\Set;

/**
 * @brief Set of prefixes
 *
 * @date Last reviewed 2025-10-15
 */
class ReadonlyPrefixSet implements \Countable, \IteratorAggregate
{
    use CountableTrait;
    use IteratorAggregateTrait;

    protected const ESCAPE_PAIRS = [
        '\\' => '\\\\',
        '^' => '\^',
        '$' => '\$',
        '.' => '\.',
        '[' => '\[',
        ']' => '\]',
        '|' => '\|',
        '(' => '\(',
        ')' => '\)',
        '?' => '\?',
        '*' => '\*',
        '+' => '\+',
        '{' => '\{',
        '}' => '\}',
        '~' => '\~'
    ];

    protected $data_; ///< Set of prefixes.
    private $pcre_;   ///< Pcre used by contains().

    /**
     * @brief Create from list of prefixes
     *
     * @param $prefixText String of prefixes
     *
     * @param $sepRegexp Separator regular expression [default whitespace]
     */
    public static function newFromString(
        string $prefixText,
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
            )
        );
    }

    /**
     * @param $prefixes Set of prefixes
     */
    public function __construct(Set $prefixes)
    {
        $this->data_ = $prefixes;

        $escapedPrefixes = [];

        foreach ($prefixes as $prefix) {
            $escapedPrefixes[] = strtr($prefix, static::ESCAPE_PAIRS);
        }

        $this->pcre_ = '~' . implode('.*|', $escapedPrefixes) . '.*~A';
    }

    /// Return the PCRE used in contains()
    public function getPcre(): string
    {
        return $this->pcre_;
    }

    /// Whether the set contains an initial substring of $value
    public function contains(string $value): bool
    {
        return preg_match($this->pcre_, $value);
    }
}
