<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

			$archivedPatient = new ArchivedPatient(...(array) $patient);

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

	static function downloadData(Request $request)
	{
		try {
			$patients =  Patient::find();

			if (!$patients) {
				throw new PDOException("Patients table is currently empty.", 400);
			}

			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->setCellValue('A1', 'First Name');
			$sheet->setCellValue('B1', 'Middle Name');
			$sheet->setCellValue('C1', 'Last Name');
			$sheet->setCellValue('D1', 'Email Address');
			$sheet->setCellValue('E1', 'Address');
			$sheet->setCellValue('F1', 'Age');
			$sheet->setCellValue('G1', 'Gender');

			$columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];

			$sheet->getRowDimension(1)->setRowHeight(25);

			foreach ($columns as $col) {
				$sheet->getColumnDimension($col)->setWidth(25);
				$sheet->getStyle("{$col}1")->getFont()->setSize(12)->setBold(true);
				$sheet->getStyle("{$col}1")
					->getAlignment()
					->setHorizontal(Alignment::HORIZONTAL_CENTER)
					->setVertical(Alignment::VERTICAL_CENTER);
			}

			foreach ($patients as $index => $details) {
				$row = $index + 2;
				$age =  ((int) date('Y')) - ((int) (explode('-', $details->birthDate)[0]));

				$sheet->getRowDimension($row)->setRowHeight(25);

				foreach ($columns as $col) {
					$sheet->getColumnDimension($col)
						->setWidth(25);
					$sheet->getStyle("{$col}{$row}")
						->getFont()
						->setSize(12);
					$sheet->getStyle("{$col}{$row}")
						->getAlignment()
						->setHorizontal(Alignment::HORIZONTAL_CENTER)
						->setVertical(Alignment::VERTICAL_CENTER);
				}

				$sheet->setCellValue("A{$row}", $details->firstName);
				$sheet->setCellValue("B{$row}", $details->middleName);
				$sheet->setCellValue("C{$row}", $details->lastName);
				$sheet->setCellValue("D{$row}", $details->email);
				$sheet->setCellValue("E{$row}", $details->address);
				$sheet->setCellValue("F{$row}", $age);
				$sheet->setCellValue("G{$row}", $details->gender);
			}

			$writer = new Xlsx($spreadsheet);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="patients.xlsx"');
			header('Cache-Control: max-age=0');
			header('Cache-Control: cache, must-revalidate');
			header('Pragma: public');

			ob_start();
			$writer->save('php://output');
			$excelOutput = ob_get_contents();
			ob_end_clean();

			http_response_code(200);
			return json([
				'message' => 'Successfully downloaded patients table data.',
				'file' => base64_encode($excelOutput)
			]);
		} catch (PDOException $e) {

			if ($e->getCode() === 400) {
				http_response_code(400);
				return json([
					'message' => $e->getMessage(),
				]);
			}

			http_response_code(500);
			return json([
				'message' => $e->getMessage(),
			]);
		}
	}
}
