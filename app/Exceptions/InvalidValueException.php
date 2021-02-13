<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * The exceptions for wrong values
 * PHP version >= 7.0
 *
 * @category Exceptions
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class InvalidValueException extends Exception
{
    /**
     * Construct the exception. Note: The message is NOT binary safe.
     *
     * @link https://php.net/manual/en/exception.construct.php
     *
     * @param string         $message  [optional] The Exception message to throw.
     * @param int            $code     [optional] The Exception code.
     * @param Throwable|null $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct($message = "The value you set is wrong.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message,
            $code,
            $previous);
    }
}
