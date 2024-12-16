<?php

class Admin extends Model
{
    private $adminId, $userId;
    public $firstName, $lastName, $middleName, $phoneNumber;

    public function __construct(
        $adminId = null,
        $userId = null,
        $firstName = null,
        $lastName = null,
        $middleName = null,
        $phoneNumber = null
    ) {

        $this->adminId = $adminId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->phoneNumber = $phoneNumber;
        $this->userId = $userId;
    }

    public static function initAdmin()
    {
        self::migrateModel('
			adminId CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()),
            userId CHAR(36),
			firstName VARCHAR(50) NOT NULL,
			lastName VARCHAR(50) NOT NULL,
			middleName VARCHAR(50) NOT NULL,
			phoneNumber VARCHAR(50) NOT NULL,
			FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
		');
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }
}
