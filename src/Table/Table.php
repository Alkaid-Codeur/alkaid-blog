<?php

namespace App\Table;

use App\Models\Category;
use App\Models\Post;
use PDO;
use Exception;

abstract class Table {
	protected PDO $pdo;
	protected $table = null;
	protected $class = null;

	public function __construct($pdo)
	{
		if($this->table === null) {
			throw new Exception("La classe ". get_class($this) . "n'a pas de propriété table");
		}
		$this->pdo = $pdo;
	}

	public function find($id) 
	{
		$query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id= :id");
		$query->execute(['id' => $id]);
		$query->setFetchMode(PDO::FETCH_CLASS, $this->class);
		$result = $query->fetch();
		if($result === false) {
			throw new Exception("Aucun enregistrement ne correspond à l'ID #$id dans la table {$this->table}");
		}
		return $result;
	}

	private function getOrder(): ?string
	{
		if($this->class !== null) {
			switch ($this->class) {
				case Post::class : 
					return "created_at DESC";
					break;
				
				case Category::class : 
					return "name";
					break;
				default: 
					return null;
			}
		}
	}

	public function getElements($limit = null): array
	{
		$limitQuery = ($limit === null) ? '' : "LIMIT $limit";
		$order = ($this->getOrder() === null) ? '' : "ORDER BY {$this->getOrder()}";
		$query = $this->pdo->query("SELECT * FROM {$this->table} $order $limitQuery");
		$result = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
		if($result === false) {
			throw new Exception("Aucun enregistrement trouvé dans la table {$this->table}");
		}
		return $result;
	}

}