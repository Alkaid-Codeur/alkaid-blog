<?php

namespace App\Table;

use Exception;
use App\Models\Post;
use App\PaginatedQuery;

final class PostTable extends Table {
	protected $table  = 'post';
	protected $class = Post::class;

	/**
	 * @param array "$_POST"
	 * Returns posts in paginated list;
	 */

	public function getPostsWithPagination(array $postElements = []) {
		if(isset($postElements['searchText'])) {
			$searched = e($postElements['searchText']);
			$query = "SELECT * FROM post WHERE title LIKE :search ORDER BY created_at DESC";
			$queryCount = "SELECT count(id) FROM post WHERE title LIKE '%$searched%'";
			$paginatedQuery = new PaginatedQuery($this->pdo, $query, $queryCount);
			$posts = $paginatedQuery->getSeachItems($postElements['searchText'], $this->class);
		}
		else {
			$query = "SELECT * FROM post ORDER BY created_at DESC";
			$queryCount = "SELECT count(id) FROM post";
			$paginatedQuery = new PaginatedQuery($this->pdo, $query, $queryCount);
			$posts = $paginatedQuery->getItems($this->class);
		}
		return [$posts, $paginatedQuery];
	}

	/**
	 * Returns paginated posts list in a category link
	 * @param int $id ( Category ID)
	 */

	public function getPostsWithPaginationFromCategory($id) {
		$query = "SELECT p.* 
		FROM post p, post_category pc, category c
		WHERE p.id = pc.post_id AND pc.category_id = c.id AND c.id = $id ORDER BY created_at DESC";
		$queryCount = "SELECT count(p.id) FROM post p, post_category pc, category c WHERE p.id = pc.post_id AND pc.category_id = c.id AND c.id = $id";
		$paginatedQuery = new PaginatedQuery($this->pdo, $query, $queryCount);
		$posts = $paginatedQuery->getItems($this->class);
		return [$posts, $paginatedQuery];
	}

	public function delete($id) {
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
		$status = $query->execute(['id' => $id]);
		if($status === false) {
			throw new Exception("Impossible de supprimer l'enregistrement $id");
		};
	}
	
}