<?php

namespace App\Core\Exception\Exceptions;

use Exception;
use Throwable;

/**
 * The exception for when a rule is not found
 * PHP version >= 7.0
 *
 * @category Exception
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class RuleNotFoundException extends Exception
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
    public function __construct($message = "The rule you set not found.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message,
            $code,
            $previous);
    }
}
