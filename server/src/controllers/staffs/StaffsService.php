<?php

class StaffsService
{
	static function getStaffs(Request $request)
	{
		http_response_code(200);
		return json([
			'staffs' => [...Staff::find()]
		]);
	}

	static function getStaffById(Request $request)
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

		$staff = Staff::find(['staffId' => $id]);

		if (empty($staff)) {
			http_response_code(400);
			return json([
				'errors' => [
					'id' => ["Staff with id = {$id} does not exists."]
				]
			]);
		}

		http_response_code(200);
		return json([
			'staff' => $staff
		]);
	}

	static function registerStaff(Request $request) {}

	static function updateStaff(Request $request) {}

	static function deleteStaff(Request $request) {}
}
