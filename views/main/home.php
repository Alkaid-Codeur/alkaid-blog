<?php 
$title = "Acceuil";
?>
<!-- Banner Starts Here -->
<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/home-banner.php'  ?>
<!-- Banner Ends Here -->

<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/search-bar.php' ?>

<section class="blog-posts">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/posts-overview.php' ?>
			</div>
			<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/sidebar.php' ?>

		</div>
	</div>
</section>