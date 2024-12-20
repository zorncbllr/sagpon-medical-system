<?php

class Archives extends Controller
{
	#[Post()]
	#[Middleware(new Authentication)]
	public function getArchives(Request $request)
	{
		return ArchivesService::getArchives($request);
	}

	#[Post('/:patientId')]
	#[Middleware(new Authentication)]
	public function getArchiveById(Request $request)
	{
		return ArchivesService::getArchiveById($request);
	}

	#[Delete('/:patientId')]
	#[Middleware(new Authentication)]
	public function deletePatientArchive(Request $request)
	{
		return ArchivesService::deletePatientArchive($request);
	}

	#[Post('/undo/:patientId')]
	public function undoArchive(Request $request)
	{
		return ArchivesService::undoArchive($request);
	}
}
