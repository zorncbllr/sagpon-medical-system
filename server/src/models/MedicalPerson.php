<?php

abstract class MedicalPerson extends Model
{
    public $firstName, $middleName, $lastName, $gender, $birthDate, $address, $phoneNumber, $photo;

    public function __construct(
        $firstName = null,
        $middleName = null,
        $lastName = null,
        $gender = null,
        $birthDate = null,
        $address = null,
        $phoneNumber = null,
        $photo = null
    ) {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->photo = $photo;
    }

    public static function initMedicalPerson($additionalConfig = null)
    {
        self::migrateModel("
			firstName VARCHAR(50) NOT NULL, 
            lastName VARCHAR(50) NOT NULL, 
            middleName VARCHAR(50) NOT NULL, 
            gender ENUM('male', 'female', 'other') NOT NULL, 
            birthDate DATE NOT NULL, 
            address VARCHAR(255) NOT NULL, 
            phoneNumber VARCHAR(20) NOT NULL, 
            photo MEDIUMBLOB
		" . ($additionalConfig ? ", {$additionalConfig}" : ""));
    }
}
