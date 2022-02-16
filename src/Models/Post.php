<?php

namespace App\Models;

use DateTime;

class Post {
	private $id;
	private $title;
	private $slug;
	private $created_at;
	private $author_id;
	private $content;

	/**
	 * @var Category[]
	 */
	private $categories = [];

	private $medias = [];

	public function getID(): ?int
	{
		return $this->id;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function getSlug(): ?string
	{
		return $this->slug;
	}
	public function getAuthorID(): ?int
	{
		return $this->author_id;
	}

	public function getCreatedAt(): ?DateTime
	{
		return new DateTime($this->created_at); 
	}

	public function getContent(): string
	{
		return $this->content;
	}

	public function addCategories(Category $category) {
		$this->categories[] = $category;
	}

	public function getCategories(): array
	{
		return $this->categories;
	}

	/**
	 * Get the value of medias
	 */ 
	public function getMedias(): array
	{
		return $this->medias;
	}
}