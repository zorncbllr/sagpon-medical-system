<?php

class NursesService
{
	static function getNurses(Request $request)
	{
		http_response_code(200);
		return json([
			'nurses' => [...Nurse::find()]
		]);
	}

	static function getNurseById(Request $request)
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

		$nurse = Nurse::find(['nurseId' => $id]);

		if (empty($nurse)) {
			http_response_code(400);
			return json([
				'errors' => [
					'id' => ["Nurse with id = {$id} does not exists."]
				]
			]);
		}

		http_response_code(200);
		return json([
			'nurse' => $nurse
		]);
	}

	static function registerNurse(Request $request) {}

	static function updateNurse(Request $request) {}

	static function deleteNurse(Request $request) {}
}
