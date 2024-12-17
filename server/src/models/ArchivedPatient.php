<?php

class ArchivedPatient extends Patient
{
	public function __construct(Patient $patient)
	{
		$details = parent::getProperties($patient);
		parent::__construct(...$details);
	}

	#[Override()]
	public static function initArchivedPatient()
	{
		parent::initPatient();
	}
}
