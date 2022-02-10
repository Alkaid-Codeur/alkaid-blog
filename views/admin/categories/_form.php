<form action="" method="post">
	<div class="form-group mb-3">
		<label for="name">Nom de la catégorie :</label>
		<input type="text" class="form-control <?= isset($errors['title']) ? "is-invalid" : "" ?>" name="name" id="name" value="<?= $category->getName() ?? "" ?>" required>
		<?php if(isset($errors['title'])): ?>
			<p class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></p>
		<?php endif ?>	
	</div>
	<div class="form-group mb-3">
		<label for="slug">Slug de la catégorie :</label>
		<input type="text" class="form-control <?= isset($errors['slug']) ? "is-invalid" : "" ?>"" name="slug" id="slug" value="<?= $category->getSlug() ?? "" ?>" required>
		<?php if(isset($errors['slug'])): ?>
			<p class="invalid-feedback"><?= implode('<br>', $errors['slug']) ?></p>
		<?php endif ?>	
	</div>
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>