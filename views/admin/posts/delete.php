<?php

use App\PDOConnection;
use App\Table\PostTable;

$id = $params['id'];
$pdo = PDOConnection::getPDO();

$post = (new PostTable($pdo))->find($id);
(new PostTable($pdo))->delete($id);
header('Location:' . $router->url('admin_posts') . '?delete=1');
?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Articles</h4>
				<h2>Supprimer</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>