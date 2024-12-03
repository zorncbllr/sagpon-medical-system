<?php

class Patient extends MedicalPerson
{
	private $patientId, $insuranceProvider, $policyNumber;

	public $emergencyContact;

	public function __construct(
		$patientId = null,
		$firstName = null,
		$lastName = null,
		$gender = null,
		$email = null,
		$birthDate = null,
		$address = null,
		$phoneNumber = null,
		$photo = null,
		$emergencyContact = null,
		$insuranceProvider = null,
		$policyNumber = null
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

		$this->patientId = $patientId;
		$this->emergencyContact = $emergencyContact;
		$this->insuranceProvider = $insuranceProvider;
		$this->policyNumber = $policyNumber;
	}

	public static function initPatient()
	{
		parent::initMedicalPerson("
			patientId INT PRIMARY KEY AUTO_INCREMENT, 
			emergencyContact VARCHAR(20), 
			insuranceProvider VARCHAR(255), 
			policyNumber VARCHAR(50)
		");
	}

	public function getPatientId()
	{
		return $this->patientId;
	}

	public function setPatientId($patientId)
	{
		$this->patientId = $patientId;
	}

	public function getInsuranceProvider()
	{
		return $this->insuranceProvider;
	}

	public function setInsuranceProvider($insuranceProvider)
	{
		$this->insuranceProvider = $insuranceProvider;
	}

	public function getPolicyNumber()
	{
		return $this->policyNumber;
	}

	public function setPolicyNumber($policyNumber)
	{
		$this->policyNumber = $policyNumber;
	}
}
