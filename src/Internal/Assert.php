<?php

declare(strict_types=1);

namespace Siketyan\YarnLock\Internal;

class Assert
{
    /**
     * @phpstan-return ($value is int ? int : never)
     *
     * @throws AssertionException
     */
    public static function int($value): int
    {
        if (!\is_int($value)) {
            throw new AssertionException('int', \gettype($value));
        }

        return $value;
    }

    /**
     * @phpstan-return ($value is positive-int ? positive-int : never)
     *
     * @throws AssertionException
     */
    public static function positiveInt($value): int
    {
        if (($i = self::int($value)) <= 0) {
            throw new AssertionException('positive-int', 'negative-int or 0');
        }

        return $i;
    }

    /**
     * @phpstan-return ($value is string ? string : never)
     *
     * @throws AssertionException
     */
    public static function string($value): string
    {
        if (!\is_string($value)) {
            throw new AssertionException('string', \gettype($value));
        }

        return $value;
    }

    /**
     * @phpstan-return ($value is non-empty-string ? non-empty-string : never)
     *
     * @throws AssertionException
     */
    public static function nonEmptyString($value): string
    {
        if (($s = self::string($value)) === '') {
            throw new AssertionException('non-empty-string', 'empty string');
        }

        return $s;
    }

    /**
     * @phpstan-return ($value is null|string ? string : never)
     *
     * @throws AssertionException
     */
    public static function stringOrNull($value): ?string
    {
        try {
            return self::string($value);
        } catch (AssertionException $_) {
            return self::null($value);
        }
    }

    /**
     * @return null
     *
     * @throws AssertionException
     */
    public static function null($value)
    {
        if ($value !== null) {
            throw new AssertionException('non-null value', 'null');
        }

        return null;
    }

    /**
     * @template T
     *
     * @param null|T $value
     *
     * @return T
     *
     * @throws AssertionException
     */
    public static function nonNull($value)
    {
        if ($value === null) {
            throw new AssertionException('non-null value', 'null');
        }

        return $value;
    }

    /**
     * @template TKey of array-key
     * @template TValue
     *
     * @phpstan-param TKey        $needle
     *
     * @param array<TKey, TValue> $haystack
     *
     * @return never|TValue
     *
     * @throws AssertionException
     */
    public static function in($needle, array $haystack)
    {
        if (!\array_key_exists($needle, $haystack)) {
            throw new AssertionException("array contains key {$needle}", 'array without the key');
        }

        return $haystack[$needle];
    }
}
