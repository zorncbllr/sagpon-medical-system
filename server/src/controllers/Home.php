<?php


class Home extends Controller
{
	#[Route(method: 'GET')]
	public function index(Request $request)
	{
		return json(['msg' => 'Initial set-up done.']);
	}
}
#[Route(method: 'GET', path: '/home')]
public function landingPage(Request $request)
{
	return view('home', [
		'title' => 'Clinic Management System',
		'welcomeMessage' => 'Welcome to the Clinic Management System',
		'features' => [
			'Patient Management',
			'Appointment Scheduling',
			'Billing and Invoicing',
			'Medical Records',
			'Reporting and Analytics'
		]
	]);
}