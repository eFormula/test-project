<?php

namespace App\Core\Exception\Exceptions;

use Exception;
use Throwable;

/**
 * The not found exception
 * PHP version >= 7.0
 *
 * @category Exceptions
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class NotFoundException extends Exception implements ShouldPublishInterface
{
    /**
     * CasinoException constructor.
     *
     * @param string         $message  The message of Exception
     * @param int            $code     The code of Exception
     * @param Throwable|null $previous The previous throwable used for the exception chaining.
     */
    public function __construct(
        $message = "Not found.",
        $code = 404,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
