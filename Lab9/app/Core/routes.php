<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Define routes. */
Router::any('Home', 'Controllers\Pages@index');
Router::any('Courses', 'Controllers\Course@index');
Router::any('Confirmation', 'Controllers\Course@confirmation');
Router::any('RegisteredCourses', 'Controllers\Course@listing');
Router::any('About', 'Controllers\Pages@about');

Router::any('Login', 'Controllers\Account@login');
Router::any('Logout', 'Controllers\Account@logout');
Router::any('Register', 'Controllers\Account@register');

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/** If no route found. */
Router::error('Core\Error@index');

/** Turn on old style routing. */
Router::$fallback = false;

/** Execute matched routes. */
Router::dispatch();
