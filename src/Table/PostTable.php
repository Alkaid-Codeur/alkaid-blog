<?php

namespace App\Table;

use PDO;
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

	/**
	 * @param Post[]
	 */
	public function getPostMedias(array $posts) {
		foreach ($posts as $post) {
			$query = $this->pdo->prepare("SELECT url FROM post_media WHERE post_id  = :id");
			$query->execute([
				'id' => $post->getID()
			]);
			$response = $query->fetchAll(PDO::FETCH_COLUMN);
			if(count($response) === 0) {
				$post->setMedias(['default.jpg']);
			}
			else {
				$post->setMedias($response);
			}
		}
	}

	public function delete($id) {
		$query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
		$status = $query->execute(['id' => $id]);
		if($status === false) {
			throw new Exception("Impossible de supprimer l'enregistrement $id");
		};
	}

	public function editPost(Post $post, string $updateMode) {
		$query = $this->pdo->prepare("UPDATE {$this->table} 
								SET title = :title,
								slug = :slug,
								content = :content
								WHERE id = :id
		");
		$status = $query->execute([
			'title' => $post->getTitle(),
			'slug' => $post->getSlug(),
			'content' => $post->getContent(),
			'id' => $post->getID()
		]);
		if($status === false) {
			throw new Exception("Impossible d'éffectuer la modification");
		}

		$query = $this->pdo->query("DELETE FROM post_category WHERE post_id = {$post->getID()}");
		foreach($post->getCategories() as $category) {
			$query = $this->pdo->prepare('INSERT INTO post_category VALUES (:post_id, :category_id)');
			$query->execute([
				'post_id' => $post->getID(),
				'category_id' => $category
			]);
		}

		if($updateMode === "updateMode1") {
			foreach($post->getMedias() as $media) {
				$query = $this->pdo->prepare("INSERT INTO post_media VALUES (:post_id, :url)");
				$query->execute([
					'post_id' => $post->getID(),
					'url' => $media
				]);
			}
		}
		else if ($updateMode === "updateMode2") {
			$query = $this->pdo->query("DELETE FROM post_media WHERE post_id = {$post->getID()}");
			foreach($post->getMedias() as $media) {
				$query = $this->pdo->prepare("INSERT INTO post_media VALUES (:post_id, :url)");
				$query->execute([
					'post_id' => $post->getID(),
					'url' => $media
				]);
			}
		}

	}
	
}