<?php

use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CategoryTable;
$pdo = PDOConnection::getPDO();

$bannerPosts = (new PostTable($pdo))->getElements(10);
(new CategoryTable($pdo))->hydratePosts($bannerPosts);
foreach ($bannerPosts as $bannerPost) {
	(new PostTable($pdo))->getPostMedias($bannerPost);
}
?>

<div class="main-banner header-text">
	<div class="container-fluid">
		<div class="owl-banner owl-carousel">
			<?php foreach($bannerPosts as $post): ?>
				<?php $author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername(); ?>
				<div class="item">
					<img src="assets/images/banner-item-01.jpg" alt="">
					<div class="item-content">
						<div class="main-content">
							<div class="meta-category">
								<span><?= $post->getCategories()[0]->getName() ?></span>
							</div>
							<a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>"><h4><?= $post->getTitle() ?></h4></a>
							<ul class="post-info">
							<li><a href="#"><?= $author ?></a></li>
							<li><a href="#"><?= $post->getCreatedAt()->format('d F Y') ?></a></li>
							<li><a href="#">12 Comments</a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>