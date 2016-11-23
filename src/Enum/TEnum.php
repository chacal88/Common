<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */
namespace Common\Enum;


use Psr\Log\InvalidArgumentException;

/**
 * Class TEnum
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Enum
 */
trait TEnum
{

    /**
     * TEnum constructor.
     * @param $value
     */
    final public function __construct($value)
    {
        $c = new \ReflectionClass($this);

        if (!in_array($value, $c->getConstants())) {

            throw new InvalidArgumentException();
        }
        $this->value = $value;
    }

    /**
     * __toString
     *
     * @return mixed
     */
    final public function __toString()
    {
        return $this->value;
    }
}
