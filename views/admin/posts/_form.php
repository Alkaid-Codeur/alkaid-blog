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
	<?= $form->checkMode('updateMode', 'Fusionner les images', 'Remplacer les images') ?>
	<div class="mt-3">
		<button class="btn btn-primary"><?= ($post->getID() !== null) ? "Modifier l'article" : "Publier" ?></button>
	</div>
</form>

<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script>
	let filesInput = document.querySelector('.files-input');
	filesInput.addEventListener('change', handleFilePreview);

	function handleFilePreview(e, files) {
		let target = e.target;
		files = target.files;
		let previewContainer = target.parentNode.querySelector('#input-preview');
		var imageType = /^image\//;
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			if (!imageType.test(file.type)) {
				alert("Veuillez sélectionner une image");
			}
			else{
				if(i == 0){
					previewContainer.innerHTML = '';
				}
				var img = document.createElement("img");
				img.classList.add("obj");
				img.file = file;
				previewContainer.appendChild(img);
				var reader = new FileReader();
				reader.onload = ( function(aImg) { 
				return function(e) { 
				aImg.src = e.target.result; 
				}; 
			})(img);

			reader.readAsDataURL(file);
			}

		}
	}
</script>
	
<script>
	$(document).ready(function() {
    $('.basic-multiple-select').select2();
	});
</script>