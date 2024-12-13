<?php


class StaffsService
{
	static function getStaffs(Request $request)
	{
		return CommonLogic::fetchAll($request, 'Staff');
	}

	static function getStaffById(Request $request)
	{
		return CommonLogic::fetchById($request, 'Staff');
	}

	static function registerStaff(Request $request) {}

	static function updateStaff(Request $request)
	{
		$id = (int) $request->param['id'];

		if ($id === 0) {
			http_response_code(400);
			return json([
				'msg' => 'Invalid Id params.',
				'errors' => [
					'id' => ['Id params must be integer type.']
				]
			]);
		}

		$staff = Staff::find(['staffId' => $id]);

		return json(['staff' => $staff]);
	}

	static function deleteStaff(Request $request)
	{
		return CommonLogic::deleteHandler($request, 'Staff');
	}
}
