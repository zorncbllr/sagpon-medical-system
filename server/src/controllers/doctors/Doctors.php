<?php

class Doctors extends Controller
{
	#[Post()]
	public function getDoctors(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Doctor');
	}

	#[Post('/register')]
	#[Middleware(new DoctorValidator)]
	public function registerDoctor(Request $request)
	{
		return CommonLogic::registerHandler($request, 'Doctor');
	}

	#[Post('/:doctorId')]
	public function getDoctorById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Doctor');
	}

	#[Patch('/:doctorId')]
	public function updateDoctor(Request $request)
	{
		return CommonLogic::updateHandler($request, 'Doctor');
	}

	#[Delete('/:doctorId')]
	public function deleteDoctor(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Doctor');
	}
}
