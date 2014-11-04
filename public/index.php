<?php
session_start();

require __DIR__.'/../vendor/autoload.php';

use Slim\Slim;
use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use League\OAuth2\Client\Provider\Facebook;
use Illuminate\Database\Capsule\Manager as Capsule;

$kraken = new Slim([
    'templates.path' => '../app/views'
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

    $kraken->container->singleton('oauth', function () use ($kraken) {
        return new Facebook([
            'clientId' => $kraken->config->get('service.facebook.appId'),
            'clientSecret' => $kraken->config->get('service.facebook.secret'),
            'redirectUri' => $kraken->config->get('service.facebook.redirectUrl'),
            'scopes' => ['email', 'user_about_me', 'user_groups', 'user_interests']
        ]);
    });
});

$kraken->get('/', function () use ($kraken) {
    return (new \Kraken\Controller\HomeController($kraken))->showWelcome();
});

$kraken->get('/home', function () use ($kraken) {
    return (new \Kraken\Controller\HomeController($kraken))->showHome();
});

$kraken->get('/connect', function () use ($kraken) {
    return (new \Kraken\Controller\FacebookController($kraken))->connect();
});

$kraken->get('/disconnect', function () use ($kraken) {
    return (new \Kraken\Controller\FacebookController($kraken))->disconnect();
});

$kraken->run();
