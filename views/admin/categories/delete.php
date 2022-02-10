<?php

use App\PDOConnection;
use App\Table\CategoryTable;

$id = $params['id'];
$pdo = PDOConnection::getPDO();

$req = (new CategoryTable($pdo))->delete($id);
header('Location:' . $router->url('admin_categories') . '?delete=1');

?>