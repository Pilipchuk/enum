<?php
/**
 * @author Vladimir Pilipchuk <vovapilipchuk@gmail.com>
 */
namespace Enum;

/**
 * Class Enum
 * @package Enum
 */
abstract class Enum
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
     * Enum constructor.
     *
     * @param string|int $value
     */
    final public function __construct($value)
    {
        if (!is_string($value) && !is_int($value)) {
            throw new \InvalidArgumentException('String or int expected');
        } elseif (!self::inSet($value)) {
            throw new \InvalidArgumentException(sprintf(
                '[%s] Unknown value - `%s`',
                get_called_class(),
                $value
            ));
        }

        $this->value = $value;
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
     * @return array
     */
    final public static function getList(): array
    {
        $calledClass = get_called_class();
        if (!isset(self::$list[$calledClass])) {
            $reflection = new \ReflectionClass($calledClass);
            self::$list[$calledClass] = array_values($reflection->getConstants());
        }

        return self::$list[$calledClass];
    }

    /**
     * @param string|int $value
     * @return bool
     */
    final public static function inSet($value): bool
    {
        return in_array($value, self::getList(), true);
    }
}
