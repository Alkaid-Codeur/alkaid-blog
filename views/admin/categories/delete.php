<?php

use App\PDOConnection;
use App\Table\CategoryTable;

$id = $params['id'];
$pdo = PDOConnection::getPDO();

$category = (new CategoryTable($pdo))->find($id);
$urlParams = ['delete' => 1, 'deletedItem' => $category->getName()];
$url = $router->url('admin_categories') . '?' . http_build_query($urlParams);

$req = (new CategoryTable($pdo))->delete($id);
header('Location:' . $url);

?>