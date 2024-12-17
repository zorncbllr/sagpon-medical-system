<?php

class Doctor extends MedicalPerson
{
	public $doctorId, $licenseNumber, $userId;
	public $specialization, $hospitalAffiliation, $availability;

	public function __construct(
		$doctorId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$birthDate = null,
		$userId = null,
		$address = null,
		$phoneNumber = null,
		$photo = null,
		$licenseNumber = null,
		$specialization = null,
		$hospitalAffiliation = null,
		$availability = null
	) {
		parent::__construct(
			$firstName,
			$middleName,
			$lastName,
			$gender,
			$birthDate,
			$address,
			$phoneNumber,
			$photo
		);
		$this->doctorId = $doctorId;
		$this->licenseNumber = $licenseNumber;
		$this->hospitalAffiliation = $hospitalAffiliation;
		$this->availability = $availability;
		$this->specialization = $specialization;
		$this->userId = $userId;
	}

	public static function initDoctor()
	{
		parent::initMedicalPerson("
			doctorId CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()),
			userId CHAR(36), 
			licenseNumber VARCHAR(100) NOT NULL, 
			specialization VARCHAR(100) NOT NULL, 
			hospitalAffiliation VARCHAR(100), 
			availability VARCHAR(50),
			FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
		");
	}
}
