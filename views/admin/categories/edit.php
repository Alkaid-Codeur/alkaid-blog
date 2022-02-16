<?php

use App\HTML\Form;
use App\PDOConnection;
use App\Table\CategoryTable;
use App\Validator\CategoryValidator;
use Valitron\Validator;

$id = $params['id'];
$pdo = PDOConnection::getPDO();

/**
 * @var CategoryTable
 */
$categoryTable = new CategoryTable($pdo);
$category = $categoryTable->find($id);
$success = false;
$errors = [];
if(!empty($_POST)) {
	$category->setName($_POST['name'])
			  ->setSlug($_POST['slug']);
	$v = new CategoryValidator($_POST, $categoryTable, $category->getID());
	if ($v->validate()) {
		$categoryTable->update($category);
		$success = true;
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
				<h2 style="text-transform: none; word-wrap: break-word">Modifier <span style="color: #f48840; text-transform: uppercase; font-weight: 900;"><?= $category->getName() ?></span></h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<?php if(!empty($_POST)): ?>
		<?php if($success): ?>
			<?php 
				$urlParams = ['edit' => 1, 'editedItem' => $category->getName()];
				$url = $router->url('admin_categories') . '?' . http_build_query($urlParams);
				header('Location:' . $url);
				exit();
			?>
		<?php else: ?>
			<div class="alert alert-danger">
				La modification n'a pas été éffectuée ! Merci de rentrer des informations valides
			</div>
		<?php endif ?>
	<?php endif ?>
	<div class="col-lg-12">
		<?php require '_form.php' ?>
	</div>
</div>