<?php

class Patient extends Model
{
	private $id, $userId, $email, $phoneNumber;
	private $insurance;
	public $lastName, $firstName, $middleName, $suffix, $address;
	public $medicalBackground, $birthDate, $gender;

	public function __construct($id = null) {}
}
