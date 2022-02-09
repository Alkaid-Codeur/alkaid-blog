<div class="search-bar">
	<div class="container">
		<div class="sidebar-item search">
			<form id="search_form" name="gs" method="POST" action="<?= $router->url('posts') ?>">
				<input type="text" name="searchText" class="searchText" placeholder="Rechercher un titre..." autocomplete="on" required>
			</form>
		</div>
	</div>
</div>