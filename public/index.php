<?php
require __DIR__.'/../vendor/autoload.php';

use Slim\Slim;
use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Capsule\Manager as Capsule;

$kraken = new Slim([
    'template.path' => '../app/views',
]);

$kraken->hook('slim.before', function () use ($kraken) {

    $kraken->container->singleton('config', function () use ($kraken) {
        $environment = 'production';
        $configPath = __DIR__.'/../app/config';

        $loader = new FileLoader(new Filesystem, $configPath);
        return new Repository($loader, $environment);
    });

    $capsule = new Capsule;
    $capsule->addConnection($kraken->config->get('database.mysql'));
    $capsule->setEventDispatcher(new Dispatcher(new Container));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
});

$kraken->get('/', function () use ($kraken) {
    return (new \Kraken\Controller\HomeController($kraken))->showWelcome();
});

$kraken->get('/home', function () use ($kraken) {
    return (new \Kraken\Controller\HomeController($kraken))->showHome();
});

$kraken->run();
