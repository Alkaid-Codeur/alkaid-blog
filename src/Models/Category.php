<?php

namespace App\Models;

class Category {

	private $id;

	private $name;
	
	private $slug;
	
	private $post_id;

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

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */ 
	public function setName($name)
	{
		$this->name = $name;
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
}