<?php

namespace App\Models;

class Category {
	private int $id;
	private string $name;
	private string $slug;
	private int $post_id;

	public function getID(): ?int 
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function getSlug(): ?string
	{
		return $this->slug;
	}

	public function getPostID(): ?int
	{
		return $this->post_id;
	}

}