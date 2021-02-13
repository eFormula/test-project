<?php

namespace App\Core\Helpers;

/**
 * A helper to help the application to manage the Strings
 * PHP version >= 7.0
 *
 * @category Core
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @link     null
 */
class Str
{
    /**
     * @param string $string
     *
     * @return string|string[]
     */
    public static function dashToPascal(string $string): string
    {
        $string = ucwords(str_replace('-', ' ', $string));
        return str_replace(" ", "", $string);
    }

    /**
     * @param string $string
     *
     * @return string|string[]
     */
    public static function dashToCamel(string $string): string
    {
        return lcfirst(self::dashToPascal($string));
    }
}