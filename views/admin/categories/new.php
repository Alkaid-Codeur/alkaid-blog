<?php

use App\Models\Category;
$category = new Category;

?>
<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<div class="text-content">
					<h4>Categories</h4>
					<h2 style="text-transform: none; word-wrap: break-word">Ajouter une nouvelle categorie</h2>
				</div>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<div class="col-lg-12">
		<?php require '_form.php' ?>
	</div>
</div>