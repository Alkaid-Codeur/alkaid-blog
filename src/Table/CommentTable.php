<?php

namespace App\Table;

use PDO;
use DateTime;
use Exception;
use App\Models\Comment;

class CommentTable extends Table{

	protected $table = 'comments';
	protected $class = Comment::class;

	public function insertComment(Comment $comment)
	{
		$query = $this->pdo->prepare('INSERT INTO comments (author_name, author_email, content, created_at, post_id) VALUES (:name, :mail, :content, :created_at, :post_id)');

		$well = $query->execute([
			'name' => $comment->getAuthorName(),
			'mail' => $comment->getAuthorEmail(),
			'content' => $comment->getContent(),
			'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
			'post_id' => $comment->getPostID()
		]);

		if ($well === false) {
			throw new Exception("Impossible d'éffectuer l'enregistrement");
		}
	}

	public function countForPost(int $post_id): int
	{
		$query = $this->pdo->query("SELECT count(id) FROM {$this->table} WHERE post_id = $post_id");
		$query->setFetchMode(PDO::FETCH_COLUMN, 0);
		return $query->fetch();
	}

	public function getPostComments(int $post_id)
	{
		$query = $this->pdo->query("SELECT * FROM {$this->table} WHERE post_id = $post_id");
		$result = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
		return $result;
	}

}