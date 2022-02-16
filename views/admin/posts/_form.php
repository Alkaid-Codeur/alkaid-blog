<?php

use App\HTML\Form;
$form = new Form($post, $errors);
?>

<form action="" method="post">
	<?= $form->textInput('title', "Titre de l'article") ?>
	<?= $form->textInput('slug', 'Choisir un slug') ?>
	<?= $form->multipleSelect('categories', 'Selectionnez les catégories') ?>
	<?= $form->textarea('content', 'Entrez le contenu') ?>

	<button class="btn btn-primary"><?= ($post->getID() !== null) ? "Modifier" : "Publier" ?></button>
</form>

<script src="/assets/vendor/jquery/jquery.min.js"></script>
	
<script>
	$(document).ready(function() {
    $('.basic-multiple-select').select2();
	});
</script>