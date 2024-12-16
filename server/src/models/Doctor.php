<?php

class Doctor extends MedicalPerson
{
	private $doctorId, $licenseNumber;
	public $specialization, $hospitalAffiliation, $availability;

	public function __construct(
		$doctorId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$birthDate = null,
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
	}

	public static function initDoctor()
	{
		parent::initMedicalPerson("
			doctorId CHAR(36) NOT NULL PRIMARY KEY, 
			licenseNumber VARCHAR(100) NOT NULL, 
			specialization VARCHAR(100) NOT NULL, 
			hospitalAffiliation VARCHAR(100), 
			availability VARCHAR(50),
			FOREIGN KEY (doctorId) REFERENCES users(userId) ON DELETE CASCADE
		");
	}

	public function getDoctorId()
	{
		return $this->doctorId;
	}

	public function setDoctorId($doctorId)
	{
		$this->doctorId = $doctorId;
	}

	public function getLicenseNumber()
	{
		return $this->licenseNumber;
	}

	public function setLicenseNumber($licenseNumber)
	{
		$this->licenseNumber = $licenseNumber;
	}
}
