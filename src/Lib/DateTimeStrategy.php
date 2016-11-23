<?php
/**
 * Copyright (c) 2016 , Kaue Rodrigues All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted,:
 *
 */
namespace Common\Lib;


use DateTime;
use Zend\Hydrator\Strategy\DefaultStrategy;

/**
 * Class DateTimeStrategy
 *
 * @author Kaue Rodrigues <kauemsc@gmail.com>
 *
 * @package Common\Lib
 */
class DateTimeStrategy extends DefaultStrategy
{
    /**
     * hydrate
     *
     * @param mixed $value
     * @return DateTime|mixed|null
     */
    public function hydrate($value)
    {
        if (is_string($value) && "" === $value) {
            $value = null;
        } elseif (is_string($value)) {
            $value = new DateTime($value);
        }

        return $value;
    }
}