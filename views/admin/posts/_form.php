<?php

use App\HTML\Form;
$form = new Form($post, $errors);
?>

<form action="" method="post" enctype="multipart/form-data">
	<?= $form->textInput('title', "Titre de l'article") ?>
	<?= $form->textInput('slug', 'Choisir un slug') ?>
	<?= $form->multipleSelect('categories', 'Selectionnez les catégories') ?>
	<?= $form->textarea('content', 'Entrez le contenu') ?>
	<?= $form->insertMedias('medias', 'Choisissez des images :') ?>
	<?php if($post->getID() !== null): ?>
		<?= $form->checkMode('updateMode', 'Fusionner les images', 'Remplacer les images') ?>
	<?php endif ?>
	<div class="mt-3">
		<button class="btn btn-primary"><?= ($post->getID() !== null) ? "Modifier l'article" : "Publier" ?></button>
	</div>
</form>
