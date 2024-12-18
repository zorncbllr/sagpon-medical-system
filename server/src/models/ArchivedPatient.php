<?php

class ArchivedPatient extends Patient
{

	function __construct(Patient $patient)
	{
		$props = self::getProperties($patient);
		parent::__construct(...$props);
	}

	static function initArchivedPatient()
	{
		self::initPatient();
	}
}
