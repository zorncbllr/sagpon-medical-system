<?php

abstract class MedicalPerson extends Model
{
    public $firstName, $lastName, $gender, $email, $birthDate, $address, $phoneNumber, $photo;

    public function __construct(
        $firstName = null,
        $lastName = null,
        $gender = null,
        $email = null,
        $birthDate = null,
        $address = null,
        $phoneNumber = null,
        $photo = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->photo = $photo;
    }

    public static function initMedicalPerson()
    {
        self::migrateModel("
			firstName VARCHAR(50) NOT NULL, 
            lastName VARCHAR(50) NOT NULL, 
            gender ENUM('male', 'female', 'other') NOT NULL, 
            email VARCHAR(100) UNIQUE NOT NULL, 
            birthDate DATE NOT NULL, 
            address VARCHAR(255) NOT NULL, 
            phoneNumber VARCHAR(20) NOT BNULL, 
            photo BLOB
		");
    }
}