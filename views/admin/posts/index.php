<?php

use App\PDOConnection;
use App\Table\PostTable;

$pdo = PDOConnection::getPDO();
[$posts, $paginatedQuery] = (new PostTable($pdo))->getPostsWithPagination([], 16);
$link = $router->url('admin_posts');
?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Articles</h4>
				<h2>Liste des articles</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<div class="container" style="margin-top: 70px; padding-left: 20px; padding-right: 20px">
	<?php if(isset($_GET['delete'])): ?>
		<div class="alert alert-success">
			L'article a été supprimé !
		</div>
	<?php endif ?>
	<?php if(isset($_GET['insert'])): ?>
		<div class="alert alert-success">
			L'article a été enregistré !
		</div>
	<?php endif ?>
	<div class="col-lg-12">
		<div class="">
			<button class="btn btn-dark" style="display: block; width: fit-content; width: -moz-fit-content; margin: 20px auto"><a href="<?= $router->url('post_create') ?>" style="color: #fff">Creer un article</a></button>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col" class="th-center">Numero</th>
					<th scope="col" class="th-center">Titre</th>
					<th scope="col" class="th-center">Date</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($posts as $post): ?>
					<tr>
						<th scope="row" class="th-center">#<?= $post->getID() ?></th>
						<td style="text-transform: capitalize; text-align: center"><em><a href="<?= $router->url('admin_post_view', ['id'=>$post->getID(), 'slug' => $post->getSlug()]) ?>"><?= $post->getTitle() ?></a></em></td>
						<td style="text-align: center"><i><?= $post->getCreatedAt()->format('d F Y') ?></i></td>
					</tr>
				<?php endforeach ?>
				
			</tbody>
		</table>

		<div class="col-lg-12" style="margin-top: 100px">
			<ul class="page-numbers">
				<?= $paginatedQuery->previousLink($link) ?>
				<?= $paginatedQuery->pageLinks($link) ?>
				<?= $paginatedQuery->nextLink($link) ?>
			</ul>
		</div>
	</div>
</div>

