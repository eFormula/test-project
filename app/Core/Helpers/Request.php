<?php

namespace App\Core\Helpers;

/**
 * A helper to help the application to manage the http requests
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @link     null
 */
class Request
{
    /**
     * Check what if the incoming request has the given key or not
     *
     * @param string $parameter The parameter name
     *
     * @return bool
     */
    public static function has(string $parameter): bool
    {
        return isset($_REQUEST[$parameter]);
    }

    /**
     * Check what if the incoming request has not the given key or not
     *
     * @param string $parameter The parameter name
     *
     * @return bool
     */
    public static function hasNot(string $parameter): bool
    {
        return !self::has($parameter);
    }

    /**
     * Check what if the given parameter is empty or not
     *
     * @param string $parameter The parameter name
     *
     * @return bool
     */
    public static function empty(string $parameter): bool
    {
        return isset($_REQUEST[$parameter]) && empty($_REQUEST[$parameter]);
    }

    /**
     * Return all received requests
     *
     * @return array
     */
    public static function all(): array
    {
        return $_REQUEST;
    }

    /**
     * Get the parameter value from request
     *
     * @param string      $parameter  The parameter
     * @param string|null $validation The validation value
     *
     * @return string
     */
    public static function get(string $parameter, string $validation = null): string
    {
        $value = null;
        if (isset($_REQUEST[$parameter])) {
            $value = trim(htmlspecialchars($_REQUEST[$parameter]));
        }
        if (empty($value)) {
            $value = filter_var($value, $validation);
        }
        return $value;
    }
}