<?php

namespace Rohos\RsSitemap\Validators;

use Rohos\RsSitemap\Validators\Interfaces\Validator;
use Rohos\RsSitemap\Elements\Interfaces\ChangefreqElement;
use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Class ChangefreqValidator
 * @package Rohos\RsSitemap\Validators
 */
class ChangefreqValidator implements Validator
{
    /** @var array */
    private $values;

    /** @var $this|null */
    private static $instance;

    private function __construct()
    {
        $this->values = [
            ChangefreqElement::CHANGEFREQ_ALWAYS,
            ChangefreqElement::CHANGEFREQ_DAILY,
            ChangefreqElement::CHANGEFREQ_HOURLY,
            ChangefreqElement::CHANGEFREQ_MONTHLY,
            ChangefreqElement::CHANGEFREQ_WEEKLY,
            ChangefreqElement::CHANGEFREQ_YEARLY,
            ChangefreqElement::CHANGEFREQ_NEVER,
        ];
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
            throw new IncorrectElementValueException('Incorrect value: "'. $val .'" for changefreq');
        }
    }
}