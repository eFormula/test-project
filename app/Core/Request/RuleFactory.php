<?php

namespace App\Core\Request;

use App\Core\Exception\Exceptions\RuleNotFoundException;

/**
 * This class will validate incoming request based on the received data
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test Project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class RuleFactory
{
    /**
     * @param string $fieldName
     * @param string $ruleName
     *
     * @return AbstractRule
     * @throws RuleNotFoundException
     */
    public static function create(string $fieldName, string $ruleName): AbstractRule
    {
        $namespace = "App\Core\Request\\" . ucFirst($ruleName) . "Rule";
        if (class_exists($namespace)) {
            return new $namespace($fieldName, $ruleName);
        }
        throw new RuleNotFoundException();
    }
}
