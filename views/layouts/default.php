<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? "Alkaid-Blog" ?></title>
	<meta name="description" content="">
	<meta name="author" content="TemplateMo">
	<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet"> -->

	<!-- Bootstrap core CSS -->
	<link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="/assets/css/fontawesome.css">
	<link rel="stylesheet" href="/assets/css/templatemo-stand-blog.css">
	<link rel="stylesheet" href="/assets/css/owl.css">
</head>
<body>
	<!-- ***** Preloader Start ***** -->
	<div id="preloader">
		<div class="jumper">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>  
	<!-- ***** Preloader End ***** -->

	<!-- Header -->
	<header class="background-header">
	<nav class="navbar navbar-expand-lg">
		<div class="container">
		<a class="navbar-brand" href="<?= $router->url('home') ?>"><h2>Alkaid-Blog<em>.</em></h2></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
			<li class="nav-item <?= ($_SERVER['REQUEST_URI'] === '/')? "active": "" ?>">
				<a class="nav-link" href="<?= $router->url('home') ?>">Acceuil
				<span class="sr-only">(current)</span>
				</a>
			</li> 
			<li class="nav-item">
				<a class="nav-link" href="blog.html">Articles</a>
			</li>
			<li class="nav-item <?= ($_SERVER['REQUEST_URI'] === '/a-propos')? "active": "" ?>">
				<a class="nav-link" href="<?= $router->url('about') ?>">A propos</a>
			</li>
			<li class="nav-item <?= ($_SERVER['REQUEST_URI'] === '/nous-contacter')? "active": "" ?>">
				<a class="nav-link" href="<?= $router->url('contact') ?>">Contact</a>
			</li>
			</ul>
		</div>
		</div>
	</nav>
	</header>

	<!-- Page Content -->
	<?= $pageContent ?>
	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="social-icons">
					<li><a href="#">Facebook</a></li>
					<li><a href="#">Twitter</a></li>
					<li><a href="#">Behance</a></li>
					<li><a href="#">Linkedin</a></li>
					<li><a href="#">Dribbble</a></li>
					</ul>
				</div>
				<div class="col-lg-12">
					<div class="copyright-text">
					<p>Copyright 2020 Stand Blog Co.
							
						| Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Additional Scripts -->
	<script src="/assets/js/custom.js"></script>
	<script src="/assets/js/owl.js"></script>
	<script src="/assets/js/slick.js"></script>
	<script src="/assets/js/isotope.js"></script>
	<script src="/assets/js/accordions.js"></script>

	<script language = "text/Javascript"> 
	cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
	function clearField(t){                   //declaring the array outside of the
	if(! cleared[t.id]){                      // function makes it static and global
		cleared[t.id] = 1;  // you could use true and false, but that's more typing
		t.value='';         // with more chance of typos
		t.style.color='#fff';
		}
	}
	</script>
</body>
</html>