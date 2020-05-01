<?php

declare(strict_types=1);

namespace DarkDevLab\Enum;

/**
 * Class Enum
 * @package DarkDevLab\Enum
 */
abstract class Enum implements \JsonSerializable
{
    /**
     * @var string|int
     */
    private $value;

    /**
     * @var array
     */
    protected static $list = [];

    /**
     * @var static[]
     */
    protected static $container = [];

    /**
     * Enum constructor.
     *
     * @param string|int $value
     * @throws \ReflectionException
     */
    final public function __construct($value)
    {
        if (!\is_string($value) && !is_numeric($value)) {
            throw new \InvalidArgumentException(sprintf(
                '[%s] String or numeric expected, %s given',
                \get_called_class(),
                \gettype($value)
            ));
        } elseif (!self::inSet($value)) {
            throw new \InvalidArgumentException(sprintf(
                '[%s] Unknown value - `%s`',
                \get_called_class(),
                $value
            ));
        }

        $this->value = $value;
    }

    /**
     * Destruct
     */
    final public function __destruct()
    {
        unset(static::$container[static::class][$this->getValue()]);
    }

    /**
     * @return string
     */
    final public function __toString()
    {
        return (string) $this->getValue();
    }

    /**
     * @return string|int
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return static
     * @throws \Exception
     */
    final public static function get($value): self
    {
        if (!isset(static::$container[static::class][$value])) {
            static::$container[static::class][$value] = new static($value);
        }

        return static::$container[static::class][$value];
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    final public static function getList(): array
    {
        $calledClass = \get_called_class();
        if (!isset(self::$list[$calledClass])) {
            $reflection = new \ReflectionClass($calledClass);
            self::$list[$calledClass] = array_values($reflection->getConstants());
        }

        return self::$list[$calledClass];
    }

    /**
     * @param string|int $value
     * @return bool
     * @throws \ReflectionException
     */
    final public static function inSet($value): bool
    {
        return \in_array($value, self::getList(), true);
    }

    /**
     * @inheritDoc
     */
    final public function jsonSerialize()
    {
        return $this->getValue();
    }
}
