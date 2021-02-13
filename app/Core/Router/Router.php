<?php

namespace App\Core\Router;

use App\Core\Helpers\Str;
use App\Core\Helpers\Url;
use App\Exceptions\NotFoundException;

/**
 * This class will route the requests to end controller
 * PHP version >= 7.0
 *
 * @category Core
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     null
 */
class Router
{
    /**
     * The URL
     *
     * @var string
     */
    private string $url;

    /**
     * @var array
     */
    private array $sections;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->setSections();
    }

    /**
     * Explode the URL to sections
     *
     * @return void
     */
    private function setSections(): void
    {
        $sections = explode("/", $this->url);
        $key = array_search(basename(realpath(Url::basePath())), $sections);
        unset($sections[$key]);
        $this->sections = array_values(array_filter($sections));
    }

    /**
     * Get the controller namespace
     *
     * @return string
     * @throws NotFoundException
     */
    public function getControllerNamespace(): string
    {
        if (isset($this->sections[0]) && !empty($this->sections[0])) {
            $controllerName = $this->sections[0];
        } else {
            throw new NotFoundException();
        }
        $controllerNamespace = "App\\Http\\Controllers\\" . Str::dashToPascal($controllerName) . "Controller";
        if (!class_exists($controllerNamespace)) {
            throw new NotFoundException();
        }
        return $controllerNamespace;
    }

    /**
     * Get the action name
     *
     * @return string
     */
    public function getAction(): string
    {
        if (isset($this->sections[1]) && !empty($this->sections[1])) {
            $sections = explode("?", $this->sections[1]);
            $actionName = $sections[0];
        } else {
            $actionName = "index";
        }
        return Str::dashToCamel($actionName);
    }
}
