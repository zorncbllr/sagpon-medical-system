<?php

class ArchivedPatient extends Model
{
	public $firstName, $middleName, $lastName, $gender, $birthDate, $address, $phoneNumber, $photo;
	public $patientId, $userId, $email;
	public $emergencyContact, $insuranceProvider, $policyNumber;

	public function __construct(
		$patientId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$birthDate = null,
		$address = null,
		$email = null,
		$phoneNumber = null,
		$photo = null,
		$userId = null,
		$emergencyContact = null,
		$insuranceProvider = null,
		$policyNumber = null
	) {
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->lastName = $lastName;
		$this->gender = $gender;
		$this->birthDate = $birthDate;
		$this->address = $address;
		$this->email = $email;
		$this->phoneNumber = $phoneNumber;
		$this->photo = $photo;
		$this->userId = $userId;
		$this->patientId = $patientId;
		$this->emergencyContact = $emergencyContact;
		$this->insuranceProvider = $insuranceProvider;
		$this->policyNumber = $policyNumber;
	}

	public static function initPatient()
	{
		self::migrateModel("
			patientId CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()), 
			userId CHAR(36),
			email VARCHAR(80) UNIQUE NOT NULL, 
			firstName VARCHAR(50) NOT NULL, 
            lastName VARCHAR(50) NOT NULL, 
            middleName VARCHAR(50) NOT NULL, 
            gender ENUM('male', 'female', 'other') NOT NULL, 
            birthDate DATE NOT NULL, 
            address VARCHAR(255) NOT NULL, 
            phoneNumber VARCHAR(20) NOT NULL, 
            photo MEDIUMBLOB,
			emergencyContact VARCHAR(20) NOT NULL, 
			insuranceProvider VARCHAR(255), 
			policyNumber VARCHAR(50),
			FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
		");
	}
}
