<?php

namespace App\Core\Request;

/**
 * This rule will check the maximum amount of field
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class RegexRule extends AbstractRule
{
    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isValid($ruleValue, $valueToCompare): bool
    {
        preg_match($ruleValue, $valueToCompare, $matches);
        if(empty($matches)) {
            $this->addError("The provided value is incorrect.");
            return false;
        }
        return true;
    }
}
