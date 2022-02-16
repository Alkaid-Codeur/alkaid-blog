<?php

namespace App\Models;

class Users {

	private int $id;
	private string $mail;
	private string $username;
	private string $password;

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
	public function getId()
	{
		return $this->id;
	}
}