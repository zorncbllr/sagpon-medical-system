<?php

class ArchivesService
{
	static function getArchives(Request $request)
	{
		try {
			$archives = ArchivedPatient::find();

			http_response_code(200);
			return json([
				'patients' => $archives
			]);
		} catch (PDOException $e) {

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}
	static function getArchiveById(Request $request) {}

	static function deletePatientArchive(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$archive = ArchivedPatient::find(['patientId' => $id]);

			if (!$archive) {
				throw new PDOException("Archived patient not found.", 404);
			}

			$archive->delete();

			http_response_code(205);
			return json([
				'message' => 'Patient was permanently deleted from archives.',
				'patient' => $archive
			]);
		} catch (\Throwable $e) {

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}

	static function undoArchive(Request $request)
	{
		try {
			$id = $request->param['patientId'];

			$archive = ArchivedPatient::find(['patientId' => $id]);

			if (!$archive) {
				throw new PDOException("No archived information about this patient.", 404);
			}

			$patient = new Patient(...((array) $archive));

			$patient->save();
			$archive->delete();

			http_response_code(205);
			return json([
				'message' => 'Patient has been retored from archives.',
				'patient' => $patient
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 404) {
				http_response_code(404);
				return json([
					'message' => $e->getMessage(),
					'errors' => [
						'patientId' => ["Archived patient with Id {$id} not found."]
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => $e->getMessage()
			]);
		}
	}
}
