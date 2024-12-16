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

	public function getRoomId()
	{
		return $this->roomId;
	}

	public function setRoomId($roomId)
	{
		$this->roomId = $roomId;
	}

	public function getRoomNumber()
	{
		return $this->roomNumber;
	}

	public function setRoomNumber($roomNumber)
	{
		$this->roomNumber = $roomNumber;
	}

	public function getRoomType()
	{
		return $this->roomType;
	}

	public function setRoomType($roomType)
	{
		$this->roomType = $roomType;
	}
}
