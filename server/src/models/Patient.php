<?php

class Patient extends Model
 {
	private $id, $userId, $email, $phoneNumber;
	private $insurance;
	public $lastName, $firstName, $middleName, $suffix, $address;
	public $medicalBackground, $birthDate, $gender;

	public function __construct(
		$id = null, 
		$userId = null, 
		$email = null, 
		$phoneNumber = null, 
		$insurance = null, 
		$lastName = null, 
		$firstName = null, 
		$middleName = null, 
		$suffix = null, 
		$address = null, 
		$medicalBackground = null, 
		$birthDate = null, 
		$gender = null
	) {

		$this->id = $id;
		$this->userId = $userId;
		$this->email = $email;
		$this->phoneNumber = $phoneNumber;
		$this->insurance = $insurance;
		$this->lastName = $lastName;
		$this->firstName = $firstName;
		$this->middleName = $middleName;
		$this->suffix = $suffix;
		$this->address = $address;
		$this->medicalBackground = $medicalBackground;
		$this->birthDate = $birthDate;
		$this->gender = $gender;

	}
	public static function initPatient() {
		self::createTable('
			id <ADD YOUR CONFIGURATION>,
			userId <ADD YOUR CONFIGURATION>,
			email <ADD YOUR CONFIGURATION>,
			phoneNumber <ADD YOUR CONFIGURATION>,
			insurance <ADD YOUR CONFIGURATION>,
			lastName <ADD YOUR CONFIGURATION>,
			firstName <ADD YOUR CONFIGURATION>,
			middleName <ADD YOUR CONFIGURATION>,
			suffix <ADD YOUR CONFIGURATION>,
			address <ADD YOUR CONFIGURATION>,
			medicalBackground <ADD YOUR CONFIGURATION>,
			birthDate <ADD YOUR CONFIGURATION>,
			gender <ADD YOUR CONFIGURATION>
		');
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
	}

	public function getInsurance() {
		return $this->insurance;
	}

	public function setInsurance($insurance) {
		$this->insurance = $insurance;
	}

	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	public function getMiddleName() {
		return $this->middleName;
	}

	public function setMiddleName($middleName) {
		$this->middleName = $middleName;
	}

	public function getSuffix() {
		return $this->suffix;
	}

	public function setSuffix($suffix) {
		$this->suffix = $suffix;
	}

	public function getAddress() {
		return $this->address;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getBirthDate() {
		return $this->birthDate;
	}

	public function setBirthDate($birthDate) {
		$this->birthDate = $birthDate;
	}

	public function getGender() {
		return $this->gender;
	}

	public function setGender($gender) {
		$this->gender = $gender;
	}

}