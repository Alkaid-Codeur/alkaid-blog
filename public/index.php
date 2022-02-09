<?php
use App\Router;

require dirname(__DIR__) . '/vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

function e(string $text) {
	return htmlentities($text);
}

if(isset($_GET['page']) && $_GET['page'] === '1') {
	$uri = explode('?', $_SERVER['REQUEST_URI'])[0];
	$get = $_GET;
	unset($get['page']);
	$query = http_build_query($get);
	if(!empty($query)) {
		$uri .= '?' . $query;
	}
	header('Location: ' .$uri);
	http_response_code(301);
	exit();
}

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router->get('/', 'main.home', 'home')
	   ->get('/nous-contacter', 'main.contact', 'contact')
	   ->get('/a-propos', 'main.about', 'about')
	   ->match('/articles', 'posts.index', 'posts')
	   ->get('/article/[*:slug]-[i:id]', 'posts.show', 'article')
	   ->get('/category/[*:slug]-[i:id]', 'categories.category', 'category')
	   ->run();