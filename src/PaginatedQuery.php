<?php

namespace App;

use PDO;
use Exception;
use App\Helpers\URL;

class PaginatedQuery {
	private PDO $pdo;
	private string $query;
	private string $queryCount;
	private int $perPage;
	private $count = null;
	private $items;
	

	public function __construct($pdo, $query, $queryCount, $perPage = 12)
	{
		$this->pdo = $pdo;
		$this->query = $query;
		$this->queryCount = $queryCount;
		$this->perPage = $perPage;	
	}

	public function getItems(string $classMapping)
	{
		if($this->items === null) {
			$currentPage = $this->getCurrentPage();
			$pages = $this->getPages();
			if($currentPage > $pages) {
				throw new Exception("Cette page n'existe pas");
			}
			$offset = ($this->getCurrentPage() - 1) * $this->perPage;
			$this->items = $this->pdo->query($this->query . " LIMIT $this->perPage OFFSET $offset")->fetchAll(PDO::FETCH_CLASS, $classMapping);
		}
		return $this->items;
	}

	public function getSeachItems(string $text, string $classMapping) {
		$currentPage = $this->getCurrentPage();
		$pages = $this->getPages();
		if($pages === 0) {
			return null;
		}
		elseif($currentPage > $pages) {
			throw new Exception("Cette page n'existe pas");
		}
		$offset = ($this->getCurrentPage() - 1) * $this->perPage;
		$query = $this->pdo->prepare($this->query  ." LIMIT :limit OFFSET :offset");
		$query->execute([
			'search' => "%$text%",
			'limit' =>$this->perPage,
			'offset' => $offset
		]);
		$this->items = $query->fetchAll(PDO::FETCH_CLASS, $classMapping);
		return $this->items;
	}

	private function getCurrentPage(): int 
	{
		return URL::getInt('page', 1);
	}

	private function getPages(): int
	{
		if($this->count === null) {
			$this->count = (int)$this->pdo->query($this->queryCount)
									 ->fetch(PDO::FETCH_NUM)[0];
		}
		return ceil($this->count / $this->perPage);
	}


	public function previousLink(string $link)
	{
		$currentPage = $this->getCurrentPage();
		if($currentPage <= 1) return null;
		if($currentPage > 2) $link .= '?page=' . $currentPage - 1;

		return "<li><a href=\"{$link}\"><i class=\"fa fa-angle-double-left\"></i></a></li>";
	}

	public function pageLinks(string $link)
	{
		$pages = $this->getPages(); 
		$currentPage = $this->getCurrentPage();
		for($i =  1; $i<= $pages; $i++ ) {
			$anchorLink = ($i === 1) ? $link: $link. '?page=' .$i;
			$active = ($i === $currentPage) ? "active" : "";
			echo <<<HTML
				<li class="$active"><a href="{$anchorLink}">$i</a></li>
			HTML;
		}
	}

	public function nextLink(string $link)
	{
		$pages = $this->getPages();
		$currentPage = $this->getCurrentPage();
		if($currentPage >= $pages) return null;
		$link.= "?page=" . ($currentPage + 1);
		return <<< HTML
		<li><a href="{$link}"><i class="fa fa-angle-double-right"></i></a></li>
		HTML;
	}
}