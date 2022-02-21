<?php

namespace App\Models;

class Users {

	private $id;
	private $mail;
	private $username;
	private $password;

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the value of username
	 */ 
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the value of mail
	 */ 
	public function getMail()
	{
		return $this->mail;
	}

	/**
	 * Get the value of id
	 */ 
	public function getID()
	{
		return $this->id;
	}

	/**
	 * Set the value of mail
	 *
	 * @return  self
	 */ 
	public function setMail($mail)
	{
		$this->mail = $mail;

		return $this;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}
}