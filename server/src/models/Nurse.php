<?php

class Nurse extends MedicalPerson
{
	private $nurseId, $licenseNumber;
	public $shift, $hospitalAffiliation, $availability, $department;

	public function __construct(
		$nurseId = null,
		$firstName = null,
		$lastName = null,
		$gender = null,
		$email = null,
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
			$lastName,
			$gender,
			$email,
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
	}

	public static function initNurse()
	{
		parent::initMedicalPerson("
			nurseId CHAR(36) NOT NULL DEFAULT (UUID()) PRIMARY KEY, 
			licenseNumber VARCHAR(50), 
			shift VARCHAR(50), 
			hospitalAffiliation VARCHAR(100), 
			availability VARCHAR(50), 
			department VARCHAR(100)
		");
	}

	public function getNurseId()
	{
		return $this->nurseId;
	}

	public function setNurseId($id)
	{
		$this->nurseId = $id;
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
