<?php

use App\Helpers\Text;
use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CategoryTable;
$pdo = PDOConnection::getPDO();

$bannerPosts = (new PostTable($pdo))->getElements(10);
(new CategoryTable($pdo))->hydratePosts($bannerPosts);
(new PostTable($pdo))->getPostMedias($bannerPosts);
?>

<div class="main-banner header-text">
	<div class="container-fluid">
		<div class="owl-banner owl-carousel">
			<?php foreach($bannerPosts as $post): ?>
				<?php $author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername(); ?>
				<div class="item">
					<img src="storage/post_images/<?= $post->getMedias()[0] ?>" alt="">
					<div class="item-content">
						<div class="main-content">
							<div class="meta-category">
								<span><?= $post->getCategories()[0]->getName() ?></span>
							</div>
							<a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>"><h4><?= Text::excerptTitle($post->getTitle(), 40)?></h4></a>
							<ul class="post-info">
							<li><a href="#"><?= $author ?></a></li>
							<li><a href="#"><?= $post->getCreatedAt()->format('d F Y') ?></a></li>
							<!-- <li><a href="#">12 Comments</a></li> -->
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>