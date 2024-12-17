<?php

class Room extends Model
{
	private $roomId, $roomNumber, $roomType;

	public function __construct($roomId = null, $roomNumber = null, $roomType = null)
	{

		$this->roomId = $roomId;
		$this->roomNumber = $roomNumber;
		$this->roomType = $roomType;
	}

	public static function initRoom()
	{
		self::migrateModel("
			roomId  DEFAULT (UUID()) PRIMARY KEY NOT NULL,
			patientId CHAR(36),
			roomNumber VARCHAR(10) NOT NULL,
			roomType ENUM('ICU', 'General', 'Private', 'Semi-Private') NOT NULL,
			status ENUM('occupied', 'available) DEFAULT ('available') NOT NULL
		");
	}
}
