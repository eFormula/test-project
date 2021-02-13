<?php

namespace App\Core\Exception\Renderer;

use App\Core\Application;
use Throwable;

/**
 * The main class to handle the exceptions
 * PHP version >= 7.0
 *
 * @category Exception
 * @package  Test project
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class ExceptionRenderer
{
    /**
     * The throwable
     *
     * @var Throwable
     */
    private Throwable $throwable;

    /**
     * ExceptionHandler constructor.
     *
     * @param Throwable $throwable The throwable
     */
    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }

    /**
     * Render the throwable for the web
     */
    public function render(): void
    {
        $throwable = $this->throwable;
        if (Application::debug()) {
            include(__DIR__ . "/fullExceptionView.php");
        } else {
            include(__DIR__ . "/minimalExceptionView.php");
        }
    }
}
