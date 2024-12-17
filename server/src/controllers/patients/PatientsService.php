<?php

class PatientsService
{
	static function getPatients(Request $request) {}

	static function registerPatient(Request $request) {}

	static function getPatientById(Request $request) {}

	static function updatePatient(Request $request) {}

	static function archivePatient(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$patient = Patient::find(['patientId' => $id]);

			$archivedPatient = new ArchivedPatient($patient);

			$archivedPatient->save();

			$patient->delete();

			http_response_code(200);
			return json([
				'message' => 'Patient moved to archives.',
				'patient' => $archivedPatient
			]);
		} catch (PDOException $e) {

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function deletePatientArchive(Request $request)
	{
		try {
		} catch (PDOException $e) {
		}
	}
}
