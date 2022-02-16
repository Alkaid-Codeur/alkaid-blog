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

// Routes any-user : 
$router->get('/', 'main.home', 'home')
	   ->get('/nous-contacter', 'main.contact', 'contact')
	   ->get('/a-propos', 'main.about', 'about')
	   ->match('/articles', 'posts.index', 'posts')
	   ->get('/article/[*:slug]-[i:id]', 'posts.show', 'post')
	   ->get('/category/[*:slug]-[i:id]', 'categories.category', 'category')

	   // ROUTES ADMINISTRATION

	   // Gestion des articles CRUD
	   ->get('/admin', 'admin.posts.index', 'admin_posts')
	   ->get('/admin/post/[*:slug]-[i:id]', 'admin.posts.show', 'admin_post_view')
	   ->post('/admin/post/[i:id]/delete', 'admin.posts.delete', 'post_delete')
	   ->match('/admin/post/[i:id]/edit', 'admin.posts.edit', 'post_edit')
	   ->match('/admin/post/new', 'admin.posts.new', 'post_create')

	   // GESTION DES CATEGORIES CRUD
	   ->get('/admin/categories', 'admin.categories.index', 'admin_categories')
	   ->post('/admin/category/[i:id]/delete', 'admin.categories.delete', 'category_delete')
	   ->match('/admin/category/[i:id]/update', 'admin.categories.edit', 'category_edit')
	   ->match('/admin/category/new', 'admin.categories.new', 'category_create')
	   ->run();