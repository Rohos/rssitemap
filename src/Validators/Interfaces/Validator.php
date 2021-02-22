<?php

namespace Rohos\RsSitemap\Validators\Interfaces;

use Rohos\RsSitemap\Exceptions\IncorrectElementValueException;

/**
 * Interface Validator
 * @package Rohos\RsSitemap\Validators\Interfaces
 */
interface Validator
{
    /**
     * @param mixed $val
     * @throws IncorrectElementValueException
     */
    public function check($val);
}