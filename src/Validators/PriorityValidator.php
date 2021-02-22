<?php

namespace Rohos\RsSitemap\Validators;

use Rohos\RsSitemap\Validators\Interfaces\Validator;
use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Class PriorityValidator
 * @package Rohos\RsSitemap\Validators
 */
class PriorityValidator implements Validator
{
    /** @var array */
    private $values;

    /** @var $this|null */
    private static $instance;

    private function __construct()
    {
        $this->values = array_map('strval', range(0, 1.0, 0.1));
    }

    private function __clone() {}
    private function __sleep() {}
    private function __wakeup() {}

    /**
     * @return self
     */
    public static function i(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param mixed $val
     * @throws IncorrectElementValueException
     */
    public function check($val)
    {
        if (!in_array($val, $this->values)) {
            throw new IncorrectElementValueException('Incorrect value: "'. $val .'" for priority');
        }
    }
}