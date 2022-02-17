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

	public function getCategories()
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

	/**
	 * Set the value of title
	 *
	 * @return  self
	 */ 
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Set the value of slug
	 *
	 * @return  self
	 */ 
	public function setSlug($slug)
	{
		$this->slug = $slug;

		return $this;
	}

	/**
	 * Set the value of created_at
	 *
	 * @return  self
	 */ 
	public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;

		return $this;
	}

	/**
	 * Set the value of author_id
	 *
	 * @return  self
	 */ 
	public function setAuthor_id($author_id)
	{
		$this->author_id = $author_id;

		return $this;
	}

	/**
	 * Set the value of content
	 *
	 * @return  self
	 */ 
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Set the value of categories
	 *
	 * @param  Category[]  $categories
	 *
	 * @return  self
	 */ 
	public function setCategories($categories)
	{
		$this->categories = $categories;

		return $this;
	}

	/**
	 * Set the value of medias
	 *
	 * @return  self
	 */ 
	public function setMedias($medias)
	{
		$this->medias = $medias;

		return $this;
	}
}