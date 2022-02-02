<?php
use App\Router;

require dirname(__DIR__) . '/vendor/autoload.php';
// $router = new AltoRouter();
// $homePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/home.php';
// $contactPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/contact.php';
// $router->map('GET', '/', $homePath , 'home');
// $router->map('GET', '/nous-contacter', $contactPath, '/contact');

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router->get('/', 'main.home', 'home')
	   ->get('/nous-contacter', 'main.contact', 'contact')
	   ->get('/a-propos', 'main.about', 'about')
	   ->run();

// $match = $router->match();
// if($match === false) {
// 	echo 'Erreur 404 ! Page introuvable';
// }
// else {
// 	ob_start();
// 	require $match['target'];
// 	$pageContent = ob_get_clean();
// 	require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/layouts/default.php';
// }