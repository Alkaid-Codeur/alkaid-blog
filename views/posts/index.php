<?php

use App\Models\Post;
use App\PaginatedQuery;
use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CategoryTable;

$pdo = PDOConnection::getPDO();

[$posts, $paginatedQuery] = (new PostTable($pdo))->getPostsWithPagination($_POST);
if($posts !== null) {
	(new CategoryTable($pdo))->hydratePosts($posts);	
	(new PostTable($pdo))->getPostMedias($posts);
}

$link = $router->url('posts');
?>
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Recent Posts</h4>
				<h2>Our Recent Blog Entries</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<!-- Banner Ends Here -->

<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/search-bar.php' ?>

<?php if(isset($_POST['searchText'])):?>
	<div class="search-title">
		<div class="container">
			<h4>Résultats de la recherche pour <strong><i><?= e($_POST['searchText'])?></i></strong></h4>
		</div>
	</div>
<?php endif ?>

<section class="blog-posts grid-system">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<?php if($posts === null): ?>
					<h5>Aucun résultat</h5>
				<?php else: ?>
					<div class="all-blog-posts">
						<div class="row" style="align-items: stretch">
							<?php foreach($posts as $post): ?>
								<?php $author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername(); ?>
								<?php require 'card.php' ?>
							<?php endforeach ?>
							<div class="col-lg-12">
								<ul class="page-numbers">
									<?= $paginatedQuery->previousLink($link) ?>
									<?= $paginatedQuery->pageLinks($link) ?>
									<?= $paginatedQuery->nextLink($link) ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endif ?>
			</div>
			<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/sidebar.php' ?>
		</div>
	</div>
</section>

