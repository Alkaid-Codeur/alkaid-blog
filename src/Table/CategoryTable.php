<?php

namespace App\Table;

use PDO;
use App\Models\Category;
use Exception;

final class categoryTable extends Table {

	protected $table = 'category';
	protected $class = Category::class;

	public function hydratePosts(array $posts) 
	{
		$postByIDs = [];
		foreach($posts as $post) {
			$postByIDs[$post->getID()] = $post;
		}

		$list = implode(", ", array_keys($postByIDs));
		$categories = $this->pdo->query("SELECT c.*, pc.post_id FROM category c JOIN post_category pc ON pc.category_id = c.id WHERE pc.post_id IN ($list)")->fetchAll(PDO::FETCH_CLASS, Category::class);
		foreach($categories as $category) {
			$postByIDs[$category->getPostID()]->addCategories($category);
		}

	}

	/**
	 * @return Category[]
	 */

	public function getPostCategories($postID): array
	{
		$query = $this->pdo->prepare("SELECT c.* 
			FROM category c, post p, post_category pc
			WHERE p.id = pc.post_id AND pc.category_id = c.id AND p.id = :id");
		$query->execute(['id' => $postID]);
		$categories = $query->fetchAll(PDO::FETCH_CLASS, Category::class);
		return $categories;
	}
}