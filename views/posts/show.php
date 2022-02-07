<?php

use App\Models\Category;
use App\Models\Post;
use App\PDOConnection;

$title = "Article";
$pdo = PDOConnection::getPDO();
$id = (int)$params['id'];
$slug = $params['slug'];
$query = $pdo->prepare('SELECT * FROM post WHERE id = ?');
$query->execute([$id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
$post = $query->fetch();

if($post === false) {
	throw new Exception("Aucun enregistrement ne correspond à l'ID dans les parametres");
}
$query = $pdo->prepare("SELECT c.* 
	FROM category c, post p, post_category pc
	WHERE p.id = pc.post_id AND pc.category_id = c.id AND p.id = :id");
$query->execute(['id' => $post->getID()]);
$categories = $query->fetchAll(PDO::FETCH_CLASS, Category::class);

if($post->getSlug() !== $slug) {
	$url = $router->url('article', ['id' => $post->getID(), 'slug' => $post->getSlug()]);
	http_response_code(301);
	header('Location:'. $url);
}
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

<section class="call-to-action">
<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<div class="main-content">
		<div class="row">
			<div class="col-lg-8">
			<span>Stand Blog HTML5 Template</span>
			<h4>Creative HTML Template For Bloggers!</h4>
			</div>
			<div class="col-lg-4">
			<div class="main-button">
				<a rel="nofollow" href="https://templatemo.com/tm-551-stand-blog" target="_parent">Download Now!</a>
			</div>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>
</section>


<section class="blog-posts grid-system">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="all-blog-posts">
					<div class="row">
						<div class="col-lg-12">
							<div class="blog-post">
								<div class="blog-thumb">
									<img src="/assets/images/blog-post-02.jpg" alt="">
								</div>
								<div class="down-content">
									<?php foreach($categories as $category): ?>
										<span><?= $category->getName() ?></span>, &nbsp;
									<?php endforeach ?>
								<a href="post-details.html"><h4>Aenean pulvinar gravida sem nec</h4></a>
								<ul class="post-info">
									<!-- <li><a href="#">Admin</a></li> -->
									<li><a href="#"><?= $post->getCreatedAt()->format('d F Y') ?></a></li>
									<!-- <li><a href="#">10 Comments</a></li> -->
								</ul>
								<p><?= nl2br(e($post->getContent()))?></p>
								<div class="post-options">
									<div class="row">
									<div class="col-6">
										<ul class="post-tags">
										<li><i class="fa fa-tags"></i></li>
										<li><a href="#">Best Templates</a>,</li>
										<li><a href="#">TemplateMo</a></li>
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
						<div class="col-lg-12">
							<div class="sidebar-item comments">
								<div class="sidebar-heading">
								<h2>4 comments</h2>
								</div>
								<div class="content">
								<ul>
									<li>
									<div class="author-thumb">
										<img src="assets/images/comment-author-01.jpg" alt="">
									</div>
									<div class="right-content">
										<h4>Charles Kate<span>May 16, 2020</span></h4>
										<p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo. Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus convallis eleifend posuere id tellus.</p>
									</div>
									</li>
									<li class="replied">
									<div class="author-thumb">
										<img src="assets/images/comment-author-02.jpg" alt="">
									</div>
									<div class="right-content">
										<h4>Thirteen Man<span>May 20, 2020</span></h4>
										<p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
									</div>
									</li>
									<li>
									<div class="author-thumb">
										<img src="assets/images/comment-author-03.jpg" alt="">
									</div>
									<div class="right-content">
										<h4>Belisimo Mama<span>May 16, 2020</span></h4>
										<p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis ac, molestie nibh.</p>
									</div>
									</li>
									<li class="replied">
									<div class="author-thumb">
										<img src="assets/images/comment-author-02.jpg" alt="">
									</div>
									<div class="right-content">
										<h4>Thirteen Man<span>May 22, 2020</span></h4>
										<p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo.</p>
									</div>
									</li>
								</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="sidebar-item submit-comment">
								<div class="sidebar-heading">
								<h2>Your comment</h2>
								</div>
								<div class="content">
								<form id="comment" action="#" method="post">
									<div class="row">
									<div class="col-md-6 col-sm-12">
										<fieldset>
										<input name="name" type="text" id="name" placeholder="Your name" required="">
										</fieldset>
									</div>
									<div class="col-md-6 col-sm-12">
										<fieldset>
										<input name="email" type="text" id="email" placeholder="Your email" required="">
										</fieldset>
									</div>
									<div class="col-md-12 col-sm-12">
										<fieldset>
										<input name="subject" type="text" id="subject" placeholder="Subject">
										</fieldset>
									</div>
									<div class="col-lg-12">
										<fieldset>
										<textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
										</fieldset>
									</div>
									<div class="col-lg-12">
										<fieldset>
										<button type="submit" id="form-submit" class="main-button">Submit</button>
										</fieldset>
									</div>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
				<div class="row">
					<div class="col-lg-12">
					<div class="sidebar-item search">
						<form id="search_form" name="gs" method="GET" action="#">
						<input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
						</form>
					</div>
					</div>
					<div class="col-lg-12">
					<div class="sidebar-item recent-posts">
						<div class="sidebar-heading">
						<h2>Recent Posts</h2>
						</div>
						<div class="content">
						<ul>
							<li><a href="post-details.html">
							<h5>Vestibulum id turpis porttitor sapien facilisis scelerisque</h5>
							<span>May 31, 2020</span>
							</a></li>
							<li><a href="post-details.html">
							<h5>Suspendisse et metus nec libero ultrices varius eget in risus</h5>
							<span>May 28, 2020</span>
							</a></li>
							<li><a href="post-details.html">
							<h5>Swag hella echo park leggings, shaman cornhole ethical coloring</h5>
							<span>May 14, 2020</span>
							</a></li>
						</ul>
						</div>
					</div>
					</div>
					<div class="col-lg-12">
					<div class="sidebar-item categories">
						<div class="sidebar-heading">
						<h2>Categories</h2>
						</div>
						<div class="content">
						<ul>
							<li><a href="#">- Nature Lifestyle</a></li>
							<li><a href="#">- Awesome Layouts</a></li>
							<li><a href="#">- Creative Ideas</a></li>
							<li><a href="#">- Responsive Templates</a></li>
							<li><a href="#">- HTML5 / CSS3 Templates</a></li>
							<li><a href="#">- Creative &amp; Unique</a></li>
						</ul>
						</div>
					</div>
					</div>
					<div class="col-lg-12">
					<div class="sidebar-item tags">
						<div class="sidebar-heading">
						<h2>Tag Clouds</h2>
						</div>
						<div class="content">
						<ul>
							<li><a href="#">Lifestyle</a></li>
							<li><a href="#">Creative</a></li>
							<li><a href="#">HTML5</a></li>
							<li><a href="#">Inspiration</a></li>
							<li><a href="#">Motivation</a></li>
							<li><a href="#">PSD</a></li>
							<li><a href="#">Responsive</a></li>
						</ul>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</section>

