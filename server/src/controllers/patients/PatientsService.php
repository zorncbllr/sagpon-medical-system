<?php

class PatientsService
{
	static function getPatients(Request $request)
	{
		try {
			$patients = Patient::find();

			http_response_code(200);
			return json([
				'patients' => [...$patients]
			]);
		} catch (PDOException $e) {

			http_response_code(500);
			return json([
				'message' => "Internal Server is having a hard time fulfilling request.",
				'errors' => [
					'server' => ["Internal Server is having a hard time fulfilling request."]
				]
			]);
		}
	}

	static function getArchives(Request $request)
	{
		try {
			$archives = ArchivedPatient::find();

			http_response_code(200);
			return json([
				'archives' => $archives
			]);
		} catch (PDOException $e) {

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function registerPatient(Request $request)
	{
		try {
			$patient = new Patient(...$request->body);

			$patient->save();

			$archived = ArchivedPatient::find(['patientId' => $patient->patientId]);

			if ($archived) {
				$archived->delete();
			}

			http_response_code(201);
			return json([
				'message' => 'New patient successfully registered.',
				'patient' => $patient
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === '23000') {
				http_response_code(400);
				return json([
					'message' => 'Duplicated patient email.'
				]);
			}

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function getPatientById(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$patient = Patient::find(['patientId' => $id]);

			if (!$patient) {
				throw new PDOException("Patient not found.", 404);
			}

			http_response_code(200);
			return json([
				'message' => "Patient with Id {$id} found.",
				'patient' => $patient
			]);
		} catch (PDOException $e) {

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function getArchiveById(Request $request) {}

	static function updatePatient(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$patient = Patient::find(['patientId' => $id]);

			if (!$patient) {
				throw new PDOException("Patient not found.", 404);
			}

			$patient->update(...$request->body);

			http_response_code(201);
			return json([
				'message' => 'Patient has been updated successfully.',
				'patient' => $patient
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 404) {
				http_response_code(404);
				return json([
					'message' => $e->getMessage(),
					'errors' => [
						'patientId' => ["Patient with Id {$id} not found."]
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function archivePatient(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$patient = Patient::find(['patientId' => $id]);

			if (!$patient) {
				throw new PDOException("Patient not found.", 404);
			}

			$archivedPatient = new ArchivedPatient($patient);

			$archivedPatient->save();

			$patient->delete();

			http_response_code(200);
			return json([
				'message' => 'Patient deleted successfully.',
				'patient' => $patient
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === '23000') {
				http_response_code(400);
				return json([
					'message' => 'Duplicated email in patient archives.'
				]);
			}

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function deletePatientArchive(Request $request) {}
}
