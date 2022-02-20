<?php

use App\Helpers\URL;
use App\PDOConnection;
use App\Table\PostTable;
use App\Table\UserTable;
use App\Table\CategoryTable;
use App\Table\CommentTable;

$title = "Article";
$pdo = PDOConnection::getPDO();
$id = (int)$params['id'];
$slug = $params['slug'];
$postTable = new PostTable($pdo);
$post = $postTable->find($id);
$author = (new UserTable($pdo))->find($post->getAuthorID())->getUsername();
$categories = (new CategoryTable($pdo))->getPostCategories($post->getID());
$commentTable = new CommentTable($pdo);
$url = $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]);
URL::handleSlugInURL($slug, $post->getSlug(), $url);

(new PostTable($pdo))->getPostMedias([$post]);

?>


<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
<section class="page-heading">
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
		<div class="text-content">
			<h4>Post Details</h4>
			<h2>Single blog post</h2>
		</div>
		</div>
	</div>
	</div>
</section>
</div>

<!-- Banner Ends Here -->
<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/search-bar.php' ?>

<section class="blog-posts grid-system">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="all-blog-posts">
					<div class="row">
						<div class="col-lg-12">
							<div class="blog-post">
								<div class="blog-thumb owl-carousel gallery-carousel">
									<?php foreach($post->getMedias() as $media): ?>
										<div class="item">
											<img class="gallery-img" src="/storage/post_images/<?= $media ?>" alt="Image article">
										</div>
									<?php endforeach ?>
								</div>
								<div class="down-content">
									<?php foreach($categories as $category): ?>
										<a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>"><span><?= $category->getName() ?></span></a>, &nbsp;
									<?php endforeach ?>
								<h4><?= $post->getTitle() ?></h4>
								<ul class="post-info">
									<li><a href="#"><?= $author ?></a></li>
									<li><a href="#"><?= $post->getCreatedAt()->format('d F Y') ?></a></li>
									<!-- <li><a href="#">10 Comments</a></li> -->
								</ul>
								<p><?= nl2br(e($post->getContent()))?></p>
								<div class="post-options">
									<div class="row">
									<div class="col-sm-12 col-lg-6">
										<ul class="post-tags">
										<li><i class="fa fa-tags"></i></li>
										<li><a href="#">Best Templates</a>,</li>
										<li><a href="#">TemplateMo</a></li>
										</ul>
									</div>
									<div class="col-sm-12 col-lg-6">
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
						<div class="col-lg-12">
							<div class="sidebar-item comments">
								<div class="sidebar-heading">
									<?php $countComments = $commentTable->countForPost($post->getID()); ?>
									<h2><?= ($countComments === 0) ? "Aucun " : $countComments ?> <?= ($countComments > 1) ? "commentaires" : "commentaire" ?> </h2>
								</div>
								<div class="content">
									<ul>
										<?php if(empty($commentTable->getPostComments($post->getID()))): ?>
											<div class="right-content">
												<p>Aucun commmentaire pour cet article.</p>
											</div>
										<?php endif ?>
										<?php foreach($commentTable->getPostComments($post->getID()) as $comment): ?>
											<li>
												<div class="author-thumb">
													<img src="assets/images/comment-author-01.jpg" alt="">
												</div>
												<div class="right-content">
													<h4><?= $comment->getAuthorName() ?><span><?= $comment->getCreatedAt()->format('F d, Y')?></span></h4>
													<p><?= $comment->getContent() ?></p>
												</div>
											</li>
										<?php endforeach ?>
									</ul>
								</div>
							</div>
						</div>
						<?php require 'comment_submit.php' ?>
					</div>
				</div>
			</div>
			<?php require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'elements/sidebar.php' ?>
		</div>
	</div>
</section>



