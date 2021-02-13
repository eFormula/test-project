<?php
/**
 * The entrance file of app
 *
 * @category App
 * @package  Test project
 */


use App\Core\Application;

require "../vendor/autoload.php";

Application::init()->run();