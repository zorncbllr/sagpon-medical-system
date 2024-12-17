<?php

class Patient extends MedicalPerson
{
	public $patientId, $userId, $insuranceProvider, $policyNumber;

	public $emergencyContact;

	public function __construct(
		$patientId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$birthDate = null,
		$address = null,
		$phoneNumber = null,
		$photo = null,
		$userId = null,
		$emergencyContact = null,
		$insuranceProvider = null,
		$policyNumber = null
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

		$this->userId = $userId;
		$this->patientId = $patientId;
		$this->emergencyContact = $emergencyContact;
		$this->insuranceProvider = $insuranceProvider;
		$this->policyNumber = $policyNumber;
	}

	public static function initPatient()
	{
		parent::initMedicalPerson("
			patientId CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()), 
			userId CHAR(36),
			emergencyContact VARCHAR(20) NOT NULL, 
			insuranceProvider VARCHAR(255), 
			policyNumber VARCHAR(50),
			FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
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
