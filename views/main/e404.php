<?php
http_response_code(404);
?>
<!-- 
<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-content">
						<h4>Erreur</h4>
						<h2>Page introuvable</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
</div> -->

<div class="error-page">
	<div class="error-content">
		<h1 class="error-type">404</h1>
		<h2 class="error-log">Oops! Page introuvable.</h2>
		<p class="error-message">Nous sommes désolés pour cet inconvenient. Il semble que vous essayez d'accéter à une page qui n'existe pas ou a été supprimée. </p>
		<a href="<?= $router->url('home') ?>" class="home-link">Page d'acceuil</a>
	</div>
</div>

