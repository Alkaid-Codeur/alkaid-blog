<?php

use App\Models\Post;
use App\PDOConnection;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = $params['id'];
$pdo = PDOConnection::getPDO();
$post = (new PostTable($pdo))->find($id);
$categories = (new CategoryTable($pdo))->getElements();
(new CategoryTable($pdo))->hydratePosts([$post]);
$success = false;
$errors = [];

if(!empty($_POST)) {

}

?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Modifier</h4>
				<h2>Liste des articles</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<?php require '_form.php' ?>
</div>