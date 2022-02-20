<?php

namespace App\Models;

use DateTime;

class Comment {
	private $id;
	private $author_name;
	private $author_email;
	private $content;
	private $created_at;
	private $post_id;

	/**
	 * Get the value of post_id
	 */ 
	public function getPostID()
	{
		return $this->post_id;
	}

	/**
	 * Set the value of post_id
	 *
	 * @return  self
	 */ 
	public function setPostID($post_id)
	{
		$this->post_id = $post_id;

		return $this;
	}

	/**
	 * Get the value of content
	 */ 
	public function getContent()
	{
		return $this->content;
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
	 * Get the value of author_email
	 */ 
	public function getAuthorEmail()
	{
		return $this->author_email;
	}

	/**
	 * Set the value of author_email
	 *
	 * @return  self
	 */ 
	public function setAuthorEmail($author_email)
	{
		$this->author_email = $author_email;

		return $this;
	}

	/**
	 * Get the value of author_name
	 */ 
	public function getAuthorName()
	{
		return $this->author_name;
	}

	/**
	 * Set the value of author_name
	 *
	 * @return  self
	 */ 
	public function setAuthorName($author_name)
	{
		$this->author_name = $author_name;

		return $this;
	}

	/**
	 * Get the value of id
	 */ 
	public function getID()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setID($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of created_at
	 */ 
	public function getCreatedAt()
	{
		return new DateTime($this->created_at);
	}

	/**
	 * Set the value of created_at
	 *
	 * @return  self
	 */ 
	public function setCreatedAt($created_at)
	{
		$this->created_at = $created_at;

		return $this;
	}
}