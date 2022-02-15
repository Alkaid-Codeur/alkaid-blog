<?php

use App\HTML\Form;

$form = new Form($category, $errors);
?>

<form action="" method="post">
	<?= $form->textInput('name', 'Nom de la catégorie', $category) ?>
	<?= $form->textInput('slug', 'Slug pour la catégorie', $category) ?>
	
	<button type="submit" class="btn btn-primary"><?= ($category->getID() === 0) ? "Enregistrer" : "Modifier" ?></button>
</form>