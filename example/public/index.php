<?php

set_include_path(
    get_include_path() . PATH_SEPARATOR .
    '../../library/' . PATH_SEPARATOR .
    '../views/' . PATH_SEPARATOR .
    '../'
);

require_once 'Quokka/Loader/Autoloader.php';

/**
 * Autoloading
 */
$autoload = new Quokka\Loader\Autoloader();
$autoload->addNamespace('Quokka', 'Quokka');
$autoload->addNamespace('Application\\Module', 'modules');
$autoload->addNamespace('Application\\Controller', 'controllers');
$autoload->register();

$application = new Quokka\Mvc\Application();

/**
 * Locale
 */
$locale = new Quokka\Locale('en_US.UTF8', ['fr_FR.UTF8', 'en_US.UTF8']);
$application->addResource('locale', $locale);

/**
 * Db
 */
$db = new Quokka\Db\PDO('mysql:dbname=test;host:localhost', 'root', '');
$application->addResource('db', $db);

/**
 * Routing
 */
$application->getRouter()->addRule('a', '/(index|)$', NULL, 'index', 'index');
$application->getRouter()->addRule('b', '/test$', NULL, 'index', 'index');
$application->getRouter()->addRule('b', '/toto$', NULL, 'index', 'toto');

/**
 * Layout
 */
$layout = new Quokka\Mvc\View\View('layout.phtml');
$application->setLayout($layout);

/**
 * Let's goooo !
 */
$application->run();
