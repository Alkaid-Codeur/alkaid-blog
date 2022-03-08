<?php

use App\Validator\SendMailValidator;
use Valitron\Validator;

if(!empty($_POST)) {
	Validator::lang('fr');
	$v = new SendMailValidator($_POST);
	if($v->validate()) {
		try {
			$transport = (new Swift_SmtpTransport('localhost', 1025))
		  ->setUsername('')
		  ->setPassword('')
		;
		
		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);
		
		// Create a message
		$message = (new Swift_Message($_POST['subject']))
		  ->setFrom([$_POST['email'] => $_POST['name']])
		  ->setTo(['alkaid@codeur.com', 'alkaid@test.org' => 'Alkaid Codeur'])
		  ->setBody($_POST['message']);
		  ;
		
		// Send the message
		$result = $mailer->send($message);
			header('Location:' . $router->url('contact') . '?sendstatus=1');
		} catch (Exception $e) {
		  echo dd($e->getMessage());
		}
	}
	else {
		$errors = $v->getErrors();
		$errors_keys = array_keys($errors);
	}	
}
$title = "Contact";
?>

<!-- Banner : -->
<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Contact</h4>
				<h2>Restons en contact!</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<!-- Banner Ends Here -->

<section class="contact-us">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="down-contact">
					<div class="row">
						<div class="col-lg-8">
							<?php if(!empty($errors)): ?>
								<div class="alert alert-danger">
									Votre message n'a pas été envoyé !
									Erreurs détectées : 
									<ul class="list-group">
									<?php foreach($errors_keys as $key): ?>
										<?php foreach($errors[$key] as $error): ?>
											<li class="list-group-item"><?= $error ?></li>
										<?php endforeach ?>
									<?php endforeach ?>
									</ul>
								</div>
							<?php endif ?>
							<?php if(isset($_GET['sendstatus'])): ?>
								<div class="alert alert-success">
									Votre message a bien été envoyé !
								</div>
							<?php endif ?>
							<div class="sidebar-item contact-form">
								<div class="sidebar-heading">
									<h2>Nous envoyer un message</h2>
								</div>
								<div class="content">
									<form id="contact" action="" method="post">
										<div class="row">
											<div class="col-md-6 col-sm-12">
												<fieldset>
													<input name="name" type="text" id="name" placeholder="Your name" required value="<?= $_POST['name'] ?? "" ?>">
												</fieldset>
											</div>
											<div class="col-md-6 col-sm-12">
												<fieldset>
												<input name="email" type="text" id="email" placeholder="Your email" required value="<?= $_POST['email'] ?? "" ?>">
												</fieldset>
											</div>
											<div class="col-md-12 col-sm-12">
												<fieldset>
												<input name="subject" type="text" id="subject" placeholder="Subject" value="<?= $_POST['subect'] ?? "" ?>">
												</fieldset>
											</div>
											<div class="col-lg-12">
												<fieldset>
												<textarea name="message" rows="6" id="message" placeholder="Your Message" required><?= $_POST['message'] ?? "" ?></textarea>
												</fieldset>
											</div>
											<div class="col-lg-12">
												<fieldset>
												<button type="submit" id="form-submit" class="main-button">Send Message</button>
												</fieldset>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="sidebar-item contact-information">
								<div class="sidebar-heading">
								<h2>Contacts information</h2>
								</div>
								<div class="content">
								<ul>
									<li>
									<h5><a href="tel:+22969538063"> (00229)695 380 63</a></h5>
									<span>Numero de téléphone</span>
									</li>
									<li>
									<h5><a href="mailto:noblebusiness9@gmail.com">codhub@gmail.com</h5>
									<span>Adresse mail</span>
									</li>
									<li>
									<h5>123 Aenean id posuere dui, 
										<br>Praesent laoreet 10660</h5>
									<span>STREET ADDRESS</span>
									</li>
								</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>