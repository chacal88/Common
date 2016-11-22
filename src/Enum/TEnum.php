<?php
namespace Common\Enum;

use Psr\Log\InvalidArgumentException;

/**
 * Class AbstractEnum
 * @package Avaliacao\Lib\Enum
 */
trait TEnum
{

    /**
     * AbstractEnum constructor.
     * @param $value
     */
    final public function __construct($value)
    {
        $c = new \ReflectionClass($this);
        if (!in_array($value, $c->getConstants())) {
            throw InvalidArgumentException();
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    final public function __toString()
    {
        return $this->value;
    }
}
