<?php

use App\PDOConnection;
use App\Models\Category;
use App\Table\CategoryTable;
use App\Validator\CategoryValidator;

$pdo = PDOConnection::getPDO();
$category = new Category;
$categoryTable = new CategoryTable($pdo);
$success = false;
$errors = [];

if(!empty($_POST)) {
	$category->setName($_POST['name'])->setSlug($_POST['slug']);
	$v = new CategoryValidator($_POST, $categoryTable);
	if($v->validate()) {
		$categoryTable->insert($category);
		$success = true;
		header('Location:'. $router->url('admin_categories') . '?insert=1');
	}
	else {
		$errors = $v->getErrors();
	}
}

?>
<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<div class="text-content">
					<h4>Categories</h4>
					<h2 style="text-transform: none; word-wrap: break-word">Ajouter une nouvelle categorie</h2>
				</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<div class="col-lg-12">
		<?php require '_form.php' ?>
	</div>
</div>