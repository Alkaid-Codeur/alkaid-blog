<?php

use App\Helpers\Text;
use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\categoryTable;

$pdo = PDOConnection::getPDO();
$overviewPosts = (new PostTable($pdo))->getElements(3);
(new categoryTable($pdo))->hydratePosts($overviewPosts);

?>

<div class="all-blog-posts">
				<div class="row">
					<?php foreach($overviewPosts as $overviewPost): ?>
						<?php $author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername(); ?>
						<div class="col-lg-12">
							<div class="blog-post">
								<div class="blog-thumb">
									<img src="assets/images/blog-post-01.jpg" alt="">
								</div>
								<div class="down-content">
								<span><?= $overviewPost->getCategories()[0]->getName()  ?></span>
								<a href="<?= $router->url('post', ['id' => $overviewPost->getID(), 'slug' => $overviewPost->getSlug()]) ?>"><h4><?= $overviewPost->getTitle() ?></h4></a>
								<ul class="post-info">
									<li><a href="#"><?= $author ?></a></li>
									<li><a href="#"><?= $overviewPost->getCreatedAt()->format('d F Y') ?></a></li>
									<li><a href="#">12 Comments</a></li>
								</ul>
								<p><?= e(Text::excerpt($overviewPost->getContent(), 300)) ?></p>
								<div class="post-options">
									<div class="row">
									<div class="col-6">
										<ul class="post-tags">
										<li><i class="fa fa-tags"></i></li>
										<li><a href="#">Beauty</a>,</li>
										<li><a href="#">Nature</a></li>
										</ul>
									</div>
									<div class="col-6">
										<ul class="post-share">
										<li><i class="fa fa-share-alt"></i></li>
										<li><a href="#">Facebook</a>,</li>
										<li><a href="#"> Twitter</a></li>
										</ul>
									</div>
									</div>
								</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>

				<div class="col-lg-12">
					<div class="main-button">
						<a href="<?= $router->url('posts') ?>">Tous les articles</a>
					</div>
				</div>
			</div>