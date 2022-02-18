<?php

use App\Models\Post;
use App\PDOConnection;
use App\Table\CategoryTable;
use App\Table\PostTable;
use App\Validator\PostValidator;

$id = $params['id'];
$pdo = PDOConnection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($id);
$categories = (new CategoryTable($pdo))->getElements();
(new CategoryTable($pdo))->hydratePosts([$post]);
$success = false;
$errors = [];

if(!empty($_POST)) {
	$datas = array_merge($_POST, $_FILES);
	$v = new PostValidator($datas, $postTable, $post->getID());
	$post->setTitle($_POST['title'])
		 ->setSlug($_POST['slug'])
		 ->setCategories($_POST['categories'] ?? [])
		 ->setContent($_POST['content']);
	if($v->validate()) {
		$mediasList = [];
		foreach($_FILES['medias']['name'] as $key=>$value) {
			if($_FILES['medias']['size'][$key] <= 10000000) {
				$upload_extension = (pathinfo($value))['extension'];
				$enabled_extensions = ['png', 'svg', 'jpg', 'gif', 'jpeg', 'webp'];
				if(in_array($upload_extension, $enabled_extensions)) {
					$upload_dir = dirname(dirname(dirname(__DIR__))) . '/public/storage/post_images/';
					$name = "article{$post->getID()}_". str_replace(' ', '', basename($_FILES['medias']['name'][$key]));
					$mv_file = move_uploaded_file($_FILES['medias']['tmp_name'][$key], "{$upload_dir}{$name}");
					if($mv_file !== false) {
						$mediasList[] = $name;
					}
				}
			}
		}
		$post->setMedias($mediasList);
		$postTable->editPost($post, $_POST['updateMode']);
		$url = $router->url('admin_post_view', ['id' => $post->getID(), 'slug' => $post->getSlug()]);
		header('Location:'. $url . '?update=1');
	}
	else {
		$errors = $v->getErrors();
	}
}


?>

<div class="heading-page header-text">
	<section class="page-heading">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<div class="text-content">
				<h4>Modifier</h4>
				<h2>Liste des articles</h2>
			</div>
			</div>
		</div>
		</div>
	</section>
</div>

<div class="container mt-5">
	<?php require '_form.php' ?>
</div>