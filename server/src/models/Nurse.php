<?php

class Nurse extends MedicalPerson
{
	public $nurseId, $licenseNumber, $userId;
	public $shift, $hospitalAffiliation, $availability, $department;

	public function __construct(
		$nurseId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$userId = null,
		$birthDate = null,
		$address = null,
		$phoneNumber = null,
		$photo = null,
		$licenseNumber = null,
		$shift = null,
		$hospitalAffiliation = null,
		$availability = null,
		$department = null
	) {

		parent::__construct(
			$firstName,
			$middleName,
			$lastName,
			$gender,
			$birthDate,
			$address,
			$phoneNumber,
			$photo,
		);

		$this->nurseId = $nurseId;
		$this->licenseNumber = $licenseNumber;
		$this->shift = $shift;
		$this->hospitalAffiliation = $hospitalAffiliation;
		$this->availability = $availability;
		$this->department = $department;
		$this->userId = $userId;
	}

	public static function initNurse()
	{
		parent::initMedicalPerson("
			nurseId CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()),
			userId CHAR(36), 
			licenseNumber VARCHAR(50) NOT NULL, 
			shift VARCHAR(50), 
			hospitalAffiliation VARCHAR(100), 
			availability VARCHAR(50), 
			department VARCHAR(100) NOT NULL,
			FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
		");
	}
}
