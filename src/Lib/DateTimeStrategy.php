<?php

namespace Common\Lib;

use DateTime;
use Zend\Hydrator\Strategy\DefaultStrategy;

class DateTimeStrategy extends DefaultStrategy
{
    /**
     * {@inheritdoc}
     *
     * Convert a string value into a DateTime object
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