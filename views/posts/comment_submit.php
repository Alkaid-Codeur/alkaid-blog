<?php

use App\HTML\Form;
use App\Models\Comment;
use App\PDOConnection;
use App\Table\CommentTable;
use App\Validator\CategoryValidator;
use App\Validator\CommentValidator;

$pdo = PDOConnection::getPDO();
$comment = new Comment;
$url = $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]);
$success = false;
$errors = [];
if(!empty($_POST)) {
	$v = new CommentValidator($_POST);
	$comment->setAuthorName($_POST['author_name'])
			->setAuthorEmail($_POST['author_email'])
			->setContent($_POST['content'])
			->setPostID($post->getID());
	if($v->validate()) {
		(new CommentTable($pdo))->insertComment($comment);
		$success = true;
		header('Location:'. $url . '?insert_comment=1');
	}
	else {
		$errors = $v->getErrors();
		$success = false;
	}
}
$form = new Form($comment, $errors);
?>

<div class="col-lg-12">
	<?php if(isset($_GET['insert_comment'])): ?>
		<div class="alert alert-success mb-3">
			Votre commentaire a été ajouté !
		</div>
	<?php endif ?>
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger mb-3">
			Le commentaire n'a pas été ajouté. Corrigez les erreurs !
		</div>
	<?php endif ?>
	<div class="sidebar-item submit-comment">
		<div class="sidebar-heading">
			<h2>Votre commentaire</h2>
		</div>
		<div class="content">
			<form id="comment" action="<?= $url ?>" method="post">
				<?= $form->textInput('author_name', 'Votre nom') ?>
				<?= $form->textInput('author_email', 'Votre mail') ?>
				<?= $form->textarea('content', 'Entrez votre commentaire') ?>
				<div class="col-lg-12">
					<button type="submit" id="form-submit" class="main-button">Envoyer</button>
				</div>
				<!-- <div class="row">
					<div class="col-md-6 col-sm-12">
						<fieldset>
							<label for="name">Votre nom :</label>
							<input name="name" type="text" id="name" value="" required>
						</fieldset>
					</div>
					<div class="col-md-6 col-sm-12">
						<fieldset>
							<label for="email">Votre mail :</label>
							<input name="email" type="text" id="email" value=" required>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset>
							<label for="message">Entrez votre commentaire</label>
							<textarea name="message" rows="6" id="message" required></textarea>
						</fieldset>
					</div>
					<div class="col-lg-12">
						<fieldset>
							<button type="submit" id="form-submit" class="main-button">Envoyer</button>
						</fieldset>
					</div>
				</div> -->
			</form>
		</div>
	</div>
</div>