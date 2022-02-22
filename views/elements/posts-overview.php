<?php

use App\Helpers\Text;
use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CommentTable;
use App\Table\categoryTable;

$pdo = PDOConnection::getPDO();
$overviewPosts = (new PostTable($pdo))->getElements(3);
(new categoryTable($pdo))->hydratePosts($overviewPosts);
(new PostTable($pdo))->getPostMedias($overviewPosts);
?>

<div class="all-blog-posts">
				<div class="row">
					<?php foreach($overviewPosts as $overviewPost): ?>
						<?php
							$category = $overviewPost->getCategories()[0]; 
							$author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername(); 
							$countComments = (new CommentTable($pdo))->countForPost($overviewPost->getID());
						?>
						<div class="col-lg-12">
							<div class="blog-post">
								<div class="blog-thumb">
									<img src="storage/post_images/<?= $overviewPost->getMedias()[0] ?>" alt="Image article" class="img-overview">
								</div>
								<div class="down-content">
									<span><a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>" style="color: inherit"><?= $category->getName()  ?></a></span>
									<a href="<?= $router->url('post', ['id' => $overviewPost->getID(), 'slug' => $overviewPost->getSlug()]) ?>"><h4 class="post-title"><?= $overviewPost->getTitle() ?></h4></a>
									<ul class="post-info">
										<li><a href="#"><?= $author ?></a></li>
										<li><a href="#"><?= $overviewPost->getCreatedAt()->format('d F Y') ?></a></li>
										<?php if($countComments > 0): ?>
											<li><a href="#"><?= $countComments ?> <?= ($countComments > 1) ? "Commentaires" : "Commentaire" ?></a></li>
										<?php endif ?>
										<!-- <li><a href="#">12 Comments</a></li> -->
									</ul>
									<div class="post-text-content">
										<?= Text::excerpt($overviewPost->getContent(), 300) ?>
									</div>
									<div class="post-options">
										<div class="row">
											<!-- <div class="col-sm-6">
												<ul class="post-tags">
													<li><i class="fa fa-tags"></i></li>
													<li><a href="#">Beauty</a>,</li>
													<li><a href="#">Nature</a></li>
												</ul>
											</div> -->
											<div class="col">
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