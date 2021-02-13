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
class MinRule extends AbstractRule
{
    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isValid($ruleValue, $valueToCompare): bool
    {
        if ($valueToCompare < $ruleValue) {
            $this->addError("The value should not be less than $ruleValue");
            return false;
        }
        return true;
    }
}
