<?php

namespace App\Core;

use App\Core\Exception\Renderer\ExceptionRenderer;
use App\Core\Helpers\Url;
use App\Core\Router\Router;
use App\Exceptions\NotFoundException;
use Dotenv\Dotenv;
use Throwable;

/**
 * The main file of application
 * PHP version >= 7.0
 *
 * @category Core
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class Application
{

    /**
     * The instance of application
     *
     * @var Application
     */
    private static Application $application;

    /**
     * Application constructor.
     */
    private function __construct()
    {
        session_start();
        $env = Dotenv::createImmutable(Url::basePath());
        $env->load();
    }

    /**
     * Get the instance of application
     *
     * @return Application
     */
    public static function init(): Application
    {
        if (empty(self::$application)) {
            self::$application = new self();
        }
        return self::$application;
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run(): void
    {
        try {
            $this->runWeb();
        } catch (Throwable $throwable) {
            $this->handleExceptions($throwable);
        }
    }

    /**
     * Run the application on web
     *
     * @return void
     * @throws NotFoundException
     */
    private function runWeb(): void
    {
        $router = new Router();
        $controllerNamespace = $router->getControllerNamespace();
        $controller = new $controllerNamespace();
        $action = $router->getAction();
        $controller->$action();
    }

    /**
     * Handle the throwable
     *
     * @param Throwable $throwable The throwable
     *
     * @return void
     */
    private function handleExceptions(Throwable $throwable): void
    {
        (new ExceptionRenderer($throwable))->render();
    }

    /**
     * A flag to determine what if the app is on debug mode or not
     *
     * @return bool
     */
    public static function debug()
    {
        $debugFlag = getenv("APP_DEBUG");
        if (empty($debugFlag)) {
            $debugFlag = true;
        }
        return $debugFlag == "true";
    }
}
