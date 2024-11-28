<?php

class User extends Model
{
	private $id, $email, $password, $role;
	private $firstName, $lastName, $createdAt, $updatedAt;

	public function __construct(
		$id = null,
		$email = null,
		$password = null,
		$role = null,
		$firstName = null,
		$lastName = null,
		$createdAt = null,
		$updatedAt = null
	) {

		$this->id = $id;
		$this->email = $email;
		$this->password = $password;
		$this->role = $role;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->createdAt = $createdAt;
		$this->updatedAt = $updatedAt;
	}

	public static function initUser()
	{
		self::createTable("
			id INT PRIMARY KEY AUTO_INCREMENT,
			email VARCHAR(100) UNIQUE NOT NULL, 
			password VARCHAR(255) NOT NULL, 
			role ENUM('patient', 'doctor', 'nurse', 'admin') NOT NULL, 
			firstName VARCHAR(50) NOT NULL, 
			lastName VARCHAR(50) NOT NULL, 
			createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
			updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		");
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
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

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
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
