<?php

use App\Auth;

$auth_status = Auth::checkAuthentification();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? "Alkaid-Blog" ?></title>
	<link rel="stylesheet" href="/assets/vendor/select/css/select2.min.css">
	<meta name="description" content="">
	<meta name="author" content="CodHub">
	<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet"> -->

	<!-- Bootstrap core CSS -->
	<link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	<!-- Additional CSS Files -->
	<link rel="stylesheet" href="/assets/css/fontawesome.css">
	<link rel="stylesheet" href="/assets/css/templatemo-stand-blog.css">
	<link rel="stylesheet" href="/assets/css/owl.css">

	<style>
		.table thead th {
			vertical-align: middle !important;
		}

		.table .th-center {
			text-align: center;
		}

		#input-preview {
			margin-top: 20px;
			margin-bottom: 10px;
			display: flex;
			align-items: stretch;
		}

		#input-preview .obj {
			display: block;
			padding: 15px;
			width: 100%;
			height: 170px;
			object-fit: contain;
		}
	</style>
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
		<div class="dropdown">
			<a class="navbar-brand" href="<?= $router->url('admin_posts') ?>"><h2>Alkaid-Blog<em>.</em><span style="font-size: 12px; font-style: italic, padding-left: 5px; text-transform: capitalize">(Admin)</span></h2></a>
		</div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item <?= ((str_contains($_SERVER['REQUEST_URI'], 'post')) || $_SERVER['REQUEST_URI'] === "/admin" || str_contains($_SERVER['REQUEST_URI'], '/admin?')) ? "active": "" ?>">
					<a class="nav-link" href="<?= $router->url('admin_posts') ?> ">Articles</a>
				</li>			
				<li class="nav-item <?= (str_contains($_SERVER['REQUEST_URI'], 'categor'))? "active": "" ?>">
					<a class="nav-link" href="<?= $router->url('admin_categories') ?> ">Categories</a>
				</li>		
				<li class="nav-item <?= ($_SERVER['REQUEST_URI'] === '/')? "active": "" ?>">
					<form action="<?= $router->url('admin_logout') ?>" method="post" style="display: inline">
						<button type="submit" class="nav-link" style="display: inline-block; border: none; background: transparent; font-size: 15px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Deconnexion</button>
					</form>
					<!-- <span class="sr-only">(current)</span> -->
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
					<div class="copyright-text">
						<?php if(defined('DEBUG_TIME')): ?>
							<p style="text-transform: capitalize">
							Page générée en <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms
							</p>
						<?php endif ?>
					<!-- <p>Copyright 2020 Stand Blog Co.
						| Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a>
					</p> -->
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Additional Scripts -->
	<script src="/assets/vendor/select/js/select2.min.js"></script>
	<!-- <script src='https://cdn.tiny.cloud/1/5yp2vl48agzjtdsdbgrxcpr4gnedytdenrhynm9z56zsh3ee/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script> -->
	<script src="/assets/vendor/tiny/tiny.js"></script>
	<script src="/assets/js/custom.js"></script>
	<script src="/assets/js/admin_custom.js"></script>
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

Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur sed earum ipsam tenetur soluta quos, obcaecati ut voluptatibus ratione sint. Laboriosam, laborum facere? Cupiditate ullam esse odio iusto iste cum.

Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur sed earum ipsam tenetur soluta quos, obcaecati ut voluptatibus ratione sint. Laboriosam, laborum facere? Cupiditate ullam esse odio iusto iste cum.
