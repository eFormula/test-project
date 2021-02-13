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
class RequiredRule extends AbstractRule
{
    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isValid($ruleValue, $valueToCompare): bool
    {
        if (empty($valueToCompare)) {
            $this->addError("This field is required.");
            return false;
        }
        return true;
    }
}
