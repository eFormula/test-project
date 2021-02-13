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
class TypeRule extends AbstractRule
{
    /**
     * @param mixed $ruleValue
     * @param mixed $valueToCompare
     *
     * @return bool
     */
    public function isValid($ruleValue, $valueToCompare): bool
    {
        switch ($ruleValue) {
            case "numeric" :
                if (!is_numeric($valueToCompare)) {
                    $this->addError("The value must be numeric.");
                    return false;
                }
        }
        return true;
    }
}
