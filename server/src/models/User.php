<?php

class User extends Model
{
	private $userId, $email, $password, $role, $createdAt, $updatedAt;

	public function __construct(
		$userId = null,
		$email = null,
		$password = null,
		$role = null,
		$createdAt = null,
		$updatedAt = null
	) {

		$this->userId = $userId;
		$this->email = $email;
		$this->password = $password;
		$this->role = $role;
		$this->createdAt = $createdAt;
		$this->updatedAt = $updatedAt;
	}

	public static function initUser()
	{
		self::migrateModel("
			userId CHAR(36) NOT NULL DEFAULT (UUID()) PRIMARY KEY, 
			email VARCHAR(80) NOT NULL, 
			password VARCHAR(255) NOT NULL, 
			role ENUM('patient', 'admin', 'doctor', 'nurse', 'staff'), 
			createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		");
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}
}
