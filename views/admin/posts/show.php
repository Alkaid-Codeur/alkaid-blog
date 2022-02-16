<?php

use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CategoryTable;

$pdo = PDOConnection::getPDO();
$id = $params['id'];
$slug = $params['slug'];

$post = (new PostTable($pdo))->find($id);
$author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername();
$categories = (new CategoryTable($pdo))->getPostCategories($post->getID());

?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-content">
					<h4>Admin - Post Details</h4>
				</div>
			</div>
		</div>
		</div>
	</section>
</div>

<section class="blog-posts grid-system">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="all-blog-posts">
					<div class="row">
						<div class="col-lg-12">
							<div class="blog-post">
								<div class="blog-thumb">
									<img src="/assets/images/blog-post-02.jpg" alt="">
								</div>
								<div class="down-content">
									<?php foreach($categories as $category): ?>
										<a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"><span><?= $category->getName() ?></span></a>, &nbsp;
									<?php endforeach ?>
								<a href="post-details.html"><h4>Aenean pulvinar gravida sem nec</h4></a>
								<ul class="post-info">
									<li><a href="#"><?= $author ?></a></li>
									<!-- <li><a href="#">Admin</a></li> -->
									<li><a href="#"><?= $post->getCreatedAt()->format('d F Y') ?></a></li>
									<!-- <li><a href="#">10 Comments</a></li> -->
								</ul>
								<p><?= nl2br(e($post->getContent()))?></p>
								<div class="post-options">
									<div class="row">
										<div class="col-6">
											<a href="<?= $router->url('post_edit', ['id' => $post->getID()]) ?>" class="btn btn-secondary">Modifier</a>
										</div>
										<div class="col-6">
											<form action="<?= $router->url('post_delete', ['id'=> $post->getID()]) ?>" method="post" style="float: right" onsubmit="return confirm(`Voulez vous supprimer cet article ?`)">
												<button type="submit" class="btn btn-danger">Supprimer</button>
											</form>
										</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>