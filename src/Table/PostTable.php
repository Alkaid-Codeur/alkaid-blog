<?php

namespace App\Table;

use App\Models\Post;
use App\PaginatedQuery;

final class PostTable extends Table {
	protected $table  = 'post';
	protected $class = Post::class;

	public function getPostsWithPagination() {
		$query = "SELECT * FROM post ORDER BY created_at DESC";
		$queryCount = "SELECT count(id) FROM post";
		$paginatedQuery = new PaginatedQuery($this->pdo, $query, $queryCount);
		$posts = $paginatedQuery->getItems($this->class);
		return [$posts, $paginatedQuery];
	}

	public function getPostsWithPaginationFromCategory($id) {
		$query = "SELECT p.* 
		FROM post p, post_category pc, category c
		WHERE p.id = pc.post_id AND pc.category_id = c.id AND c.id = $id ORDER BY created_at DESC";
		$queryCount = "SELECT count(p.id) FROM post p, post_category pc, category c WHERE p.id = pc.post_id AND pc.category_id = c.id AND c.id = $id";
		$paginatedQuery = new PaginatedQuery($this->pdo, $query, $queryCount);
		$posts = $paginatedQuery->getItems($this->class);
		return [$posts, $paginatedQuery];
	}
	
}