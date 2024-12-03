<?php

class Staff extends MedicalPerson
{
	private $staffId;
	public $shift, $department, $position;

	public function __construct(
		$staffId = null,
		$firstName = null,
		$lastName = null,
		$gender = null,
		$email = null,
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
			$lastName,
			$gender,
			$email,
			$birthDate,
			$address,
			$phoneNumber,
			$photo
		);

		$this->staffId = $staffId;
		$this->shift = $shift;
		$this->$department = $department;
		$this->position = $position;
	}

	public static function initStaff()
	{
		parent::initMedicalPerson("
			staffId INT PRIMARY KEY AUTO_INCREMENT, 
			shift VARCHAR(50), 
			department VARCHAR(100), 
			position VARCHAR(100)
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
