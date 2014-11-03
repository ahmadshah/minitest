<?php
require 'config.php';
require 'vendor/autoload.php';

$_SERVER['APP_ENV'] = $config->environment;

$app = new \Slim\Slim( array(
	'templates.path' => './views'
));