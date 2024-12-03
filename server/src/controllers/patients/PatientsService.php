<?php

class PatientsService
{
	static function getPatients(Request $request)
	{
		http_response_code(200);
		return json([
			'patients' => [...Patient::find()]
		]);
	}

	static function getPatientById(Request $request)
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

		$patient = Patient::find(['patientId' => $id]);

		if (empty($patient)) {
			http_response_code(400);
			return json([
				'errors' => [
					'id' => ["Patient with id = {$id} does not exists."]
				]
			]);
		}

		http_response_code(200);
		return json([
			'patient' => $patient
		]);
	}

	static function registerPatient(Request $request) {}

	static function updatePatient(Request $request) {}

	static function deletePatient(Request $request) {}
}
