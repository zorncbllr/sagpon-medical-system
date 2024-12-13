<?php

class Doctors extends Controller
{
	#[Post()]
	public function getDoctors(Request $request)
	{
		return DoctorsService::getDoctors($request);
	}

	#[Post('/register')]
	#[Middleware(
		new MedicalPersonValidator,
		new DoctorValidator
	)]
	public function registerDoctor(Request $request)
	{
		return DoctorsService::registerDoctor($request);
	}

	#[Post('/:doctorId')]
	public function getDoctorById(Request $request)
	{
		return DoctorsService::getDoctorById($request);
	}

	#[Patch('/:doctorId')]
	public function updateDoctor(Request $request)
	{
		return DoctorsService::updateDoctor($request);
	}

	#[Delete('/:doctorId')]
	public function deleteDoctor(Request $request)
	{
		return DoctorsService::deleteDoctor($request);
	}
}
