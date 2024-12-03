<?php

class Doctors extends Controller
{
	#[Post()]
	public function getDoctors(Request $request)
	{
		return DoctorsService::getDoctors($request);
	}

	#[Post('/:id')]
	public function getDoctorById(Request $request)
	{
		return DoctorsService::getDoctorById($request);
	}

	#[Post('/register')]
	public function registerDoctor(Request $request)
	{
		return DoctorsService::registerDoctor($request);
	}

	#[Patch('/update/:id')]
	public function updateDoctor(Request $request)
	{
		return DoctorsService::updateDoctor($request);
	}

	#[Delete('/delete/:id')]
	public function deleteDoctor(Request $request)
	{
		return DoctorsService::deleteDoctor($request);
	}
}
