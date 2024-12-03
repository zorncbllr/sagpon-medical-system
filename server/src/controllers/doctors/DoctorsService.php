<?php

class DoctorsService
{
	static function getDoctors(Request $request)
	{
		http_response_code(200);
		return json([
			'doctors' => [...Doctor::find()]
		]);
	}

	static function getDoctorById(Request $request)
	{
		$id = $request->param['id'];

		$result = new Validator([
			'id' => [
				'required' => true,
				'type' => 'int'
			]
		], ['id' => $id]);

		if (!$result->isValid()) {
			http_response_code(400);
			return json([
				'errors' => [...$result->getErrors()]
			]);
		}

		$doctor = Doctor::find(['doctorId' => $id]);

		if (empty($doctor)) {
			http_response_code(400);
			return json([
				'errors' => [
					'id' => ["Doctor with id = {$id} does not exists."]
				]
			]);
		}

		http_response_code(200);
		return json([
			'doctor' => $doctor
		]);
	}

	static function registerDoctor(Request $request) {}

	static function updateDoctor(Request $request) {}

	static function deleteDoctor(Request $request) {}
}
