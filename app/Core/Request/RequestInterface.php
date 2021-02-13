<?php

namespace App\Core\Request;

/**
 * The interface to include the methods for requests validations
 * PHP version >= 7.0
 *
 * @category Requests
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
interface RequestInterface
{
    /**
     * @return array
     */
    public function rules(): array;
}
