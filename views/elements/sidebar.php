<?php

use App\PDOConnection;
use App\Table\CategoryTable;
use App\Table\PostTable;

$pdo = PDOConnection::getPDO();

$sidebarPosts = (new PostTable($pdo))->getElements(3);
$sidebarCategories = (new CategoryTable($pdo))->getElements();
?>
<div class="col-lg-4">
				<div class="sidebar">
					<div class="row">
						<div class="col-lg-12">
						<!-- <div class="sidebar-item search">
							<form id="search_form" name="gs" method="GET" action="#">
							<input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
							</form>
						</div> -->
						</div>
						<div class="col-lg-12">
						<div class="sidebar-item recent-posts">
							<div class="sidebar-heading">
							<h2>Recent Posts</h2>
							</div>
							<div class="content">
							<ul>
								<?php foreach($sidebarPosts as $post): ?>
									<li><a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()])?>">
									<h5><?= $post->getTitle() ?></h5>
									<span><?= $post->getCreatedAt()->format('d F Y') ?></span>
									</a></li>
								<?php endforeach ?>
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
								<?php foreach($sidebarCategories as $category): ?>
									<li style="text-transform: capitalize"><a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]) ?>">- <?= $category->getName() ?></a></li>
								<?php endforeach ?>
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