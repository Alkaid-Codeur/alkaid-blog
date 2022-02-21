<?php

use App\HTML\Form;
use App\Models\Users;
use App\PDOConnection;
use App\Table\UserTable;
use App\Validator\UserValidator;

$pdo = PDOConnection::getPDO();
$user = new Users;
$errors = [];
$success = false;

if(!empty($_POST)) {
	$v = new UserValidator($_POST);
	$user->setMail($_POST['mail'])
		 ->setPassword($_POST['password']);
	if($v->validate()) {
		$auth = (new UserTable($pdo))->userAuth($user);
		if($auth !== false){
			$success === true;
			session_start();
			$_SESSION['auth'] = $auth->getID(); 
			$_SESSION['user_infos'] = $auth;
			header('Location:' . $router->url('admin_posts'));
			exit();
		}
	}
	else {
		$errors = $v->getErrors();
	}
}

$form = new Form($user, $errors);

?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<div class="text-content">
					<h4>Espace Administrateur</h4>
					<h2 style="text-transform: none; word-wrap: break-word">Authentification</h2>
				</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<?php if(isset($_GET['forbidden'])): ?>
		<div class="alert alert-danger">
			Vous devez vous connecter pour accéder à cette page.
		</div>
	<?php endif ?>
	<?php if(!empty($errors)): ?>
		<div class="alert alert-danger">
			Authentification échouéé! Corrigez les erreurs !
		</div>
	<?php endif ?>
	<?php if(isset($auth) && $auth === false): ?>
		<div class="alert alert-danger">
			Authentification échouéé! Mail ou mot de passe incorrects
		</div>
	<?php endif ?>

	<div class="col-lg-12">
		<form action="<?= $router->url('admin_login') ?>" method="post">
			<?= $form->textInput('mail', 'Adresse mail :', "mail");  ?>
			<?= $form->textInput('password', 'Mot de passe :', "password");  ?>
			<button type="submit" class="btn btn-primary">Se connecter</button>
		</form>
	</div>
</div>