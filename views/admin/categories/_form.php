<?php

use App\HTML\Form;

$form = new Form($category, $errors);
?>

<form action="" method="post">
	<?= $form->textInput('name', 'Nom de la catégorie') ?>
	<?= $form->textInput('slug', 'Slug pour la catégorie') ?>
	
	<button type="submit" class="btn btn-primary"><?= ($category->getID() !== null) ? "Modifier" : "Enregistrer" ?></button>
</form>
