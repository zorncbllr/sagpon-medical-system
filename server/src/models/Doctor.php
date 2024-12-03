<?php

class Doctor extends MedicalPerson
{
	private $doctorId, $licenseNumber;
	public $specialization, $hospitalAffiliation, $availability;

	public function __construct(
		$doctorId = null,
		$firstName = null,
		$lastName = null,
		$gender = null,
		$email = null,
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
			$lastName,
			$gender,
			$email,
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
			doctorId INT PRIMARY KEY AUTO_INCREMENT, 
			licenseNumber VARCHAR(100) NOT NULL, 
			specialization VARCHAR(100) NOT NULL, 
			hospitalAffiliation VARCHAR(100) NOT NULL, 
			availability VARCHAR(50)
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
