<?php

namespace App\Models;

use DateTime;

class Post {
	private int $id;
	private string $title;
	private string $slug;
	private string $created_at;
	private int $author_id;
	private string $content;
	private $categories = [];

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

	public function getCategories(): array
	{
		return $this->categories;
	}
}