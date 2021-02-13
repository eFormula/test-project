<?php

namespace App\Core\Request;

/**
 * This rule will check the include of array
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class InRule extends AbstractRule
{
    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isValid($ruleValue, $valueToCompare): bool
    {
        if (!in_array($valueToCompare, $ruleValue)) {
            $this->addError("The value should be in " . implode(", ", $ruleValue) . ".");
            return false;
        }
        return true;
    }
}
