<?php

namespace App\DTOs\BaseDTO;

use App\Exceptions\DtoException\ParseException;
use Carbon\Carbon;
use Exception;

trait ParseTrait
{
    /**
     * @throws ParseException
     */
    protected static function parseNullableInt(mixed &$value): ?int
    {
        try {
            if ((string) $value === '0') {
                return 0;
            }

            return empty($value) ? null : (int) $value;
        } catch (Exception $exception) {
            throw new ParseException('Parse int failed');
        }
    }

    /**
     * @throws ParseException
     */
    protected static function parseInt(mixed &$value, ?int $defaultValue = null): int
    {
        $castedValue = self::parseNullableInt($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse int value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    /**
     * @throws ParseException
     */
    protected static function parseNullableArray(mixed &$value): ?array
    {
        if (! isset($value)) {
            return null;
        }

        if (empty($value)) {
            return [];
        }

        try {
            return (array) $value;
        } catch (Exception $exception) {
            throw new ParseException('Parse array failed');
        }
    }

    /**
     * @description Reference(&) needed for passing Undefined array keys
     *
     * @throws ParseException
     */
    protected static function parseArray(mixed &$value, ?array $defaultValue = null): array
    {
        $castedValue = self::parseNullableArray($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse array value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    protected static function parseNullableBool(mixed &$value): ?bool
    {
        try {
            if ($value === null) {
                return null;
            }

            return (bool) $value;
        } catch (Exception $exception) {
            throw new ParseException('Parse bool failed');
        }
    }

    /** @description Reference(&) needed for passing Undefined array keys * */
    protected static function parseBool(mixed &$value, ?bool $defaultValue = null): bool
    {
        $castedValue = self::parseNullableBool($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse bool value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    /** @description Reference(&) needed for passing Undefined array keys * */
    protected static function parseNullableFloat(mixed &$value): ?float
    {
        try {
            if ((string) $value === '0') {
                return 0;
            }

            return empty($value) ? null : (float) $value;
        } catch (Exception $exception) {
            throw new ParseException('Parse float failed');
        }
    }

    /** @description Reference(&) needed for passing Undefined array keys * */
    protected static function parseFloat(mixed &$value, ?float $defaultValue = null): float
    {
        $castedValue = self::parseNullableFloat($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse float value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    protected static function parseNullableString(mixed &$value): ?string
    {
        try {
            if ($value === null) {
                return null;
            }

            return (string) $value;
        } catch (Exception $error) {
            throw new ParseException('Parse string failed');
        }
    }

    /** @description Reference(&) needed for passing Undefined array keys * */
    protected static function parseString(mixed &$value, ?string $defaultValue = null): string
    {
        $castedValue = self::parseNullableString($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse string value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    /**
     * @description Reference(&) needed for passing Undefined array keys
     *
     * @template T
     *
     * @param  class-string<T>  $className
     * @return T
     *
     * @throws ParseException
     */
    protected static function parseNullableEntity(string $className, mixed &$value)
    {
        $parsedValue = self::parseNullableArray($value);
        if ($parsedValue === null) {
            return null;
        }

        if (! is_subclass_of($className, self::class)) {
            throw new ParseException($className.' is not instance of '.BaseDTO::class);
        }

        return $className::fromArray($parsedValue);
    }

    /**
     * @description Reference(&) needed for passing Undefined array keys
     *
     * @template T
     *
     * @param  class-string<T>  $className
     * @param  T|null  $defaultValue
     * @return T&!null
     *
     * @throws ParseException
     */
    protected static function parseEntity(string $className, mixed &$value, mixed $defaultValue = null)
    {
        $castedValue = self::parseNullableEntity($className, $value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse entity value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    /**
     * @description Reference(&) needed for passing Undefined array keys
     *
     * @template T
     *
     * @param  class-string<T>  $className
     * @return array<T>|null
     *
     * @throws ParseException
     */
    protected static function parseNullableEntityList(string $className, mixed &$value): ?array
    {
        $parsedValues = self::parseNullableArray($value);
        if ($parsedValues === null) {
            return null;
        }

        $result = [];
        foreach ($parsedValues as $parsedValue) {
            $result[] = self::parseEntity($className, $parsedValue);
        }

        return $result;
    }

    /**
     * @description Reference(&) needed for passing Undefined array keys
     *
     * @template T
     *
     * @param  class-string<T>  $className
     * @param  array<T>|null  $defaultValue
     *
     * @throws ParseException
     */
    protected static function parseEntityList(string $className, mixed &$value, array $defaultValue = null): array
    {
        $castedValue = self::parseNullableEntityList($className, $value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse entity value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }

    /** @description Reference(&) needed for passing Undefined array keys * */
    protected static function parseNullableCarbon(mixed &$value): ?Carbon
    {
        try {
            $stringDate = self::parseNullableString($value);
            if ($stringDate === null) {
                return null;
            }

            return Carbon::parse($value);
        } catch (Exception $exception) {
            throw new ParseException('Parse invalid date time format');
        }

    }

    /** @description Reference(&) needed for passing Undefined array keys *
     * @throws ParseException
     */
    protected static function parseCarbon(mixed &$value, ?Carbon $defaultValue = null): Carbon
    {
        $castedValue = self::parseNullableCarbon($value);
        if ($castedValue === null) {
            if ($defaultValue === null) {
                throw new ParseException('Parse Carbon value required');
            }

            return $defaultValue;
        }

        return $castedValue;
    }
}
