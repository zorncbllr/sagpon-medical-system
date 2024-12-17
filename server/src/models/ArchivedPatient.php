<?php

class ArchivedPatient extends Patient
{
	#[Override()]
	public static function initArchivedPatient()
	{
		parent::initPatient();
	}
}
