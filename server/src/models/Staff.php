<?php

class Staff extends MedicalPerson
{
	private $staffId;
	public $shift, $department, $position;

	public function __construct(
		$staffId = null,
		$firstName = null,
		$middleName = null,
		$lastName = null,
		$gender = null,
		$birthDate = null,
		$address = null,
		$phoneNumber = null,
		$photo = null,
		$shift = null,
		$department = null,
		$position = null
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

		$this->staffId = $staffId;
		$this->shift = $shift;
		$this->department = $department;
		$this->position = $position;
	}

	public static function initStaff()
	{
		parent::initMedicalPerson("
			staffId CHAR(36) NOT NULL PRIMARY KEY, 
			shift VARCHAR(50), 
			department VARCHAR(100) NOT NULL, 
			position VARCHAR(100) NOT NULL,
			FOREIGN KEY (staffId) REFERENCES users(userId) ON DELETE CASCADE
		");
	}

	public function setStaffId($id)
	{
		$this->staffId = $id;
	}

	public function getStaffId()
	{
		return $this->staffId;
	}
}
