<?php

namespace Rohos\RsSitemap\Validators;

use Rohos\RsSitemap\Validators\Interfaces\Validator;
use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Class LocValidator
 * @package Rohos\RsSitemap\Validators
 */
class LocValidator implements Validator
{
    /** @var array */
    private $values;

    /** @var $this|null */
    private static $instance;

    private function __construct() {}
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
        if (filter_var($val, FILTER_VALIDATE_URL) === FALSE) {
            throw new IncorrectElementValueException('Incorrect value: "'. $val .'" for loc');
        }
    }
}
