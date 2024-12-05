<?php 

use DI\Container;
use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ .'/vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

$twig = Twig::create(__DIR__.'/views',['cache'=>false]);

$app->add(TwigMiddleware::create($app, $twig));

$app->get('/',function($request,$response,$args){
    $view = Twig::fromRequest($request);
    return $view->render($response,'index.twig',[
        'name' => "John Doe"
    ]);
});
$app->run();