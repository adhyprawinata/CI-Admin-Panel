<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menubar');
		$this->load->view('home/dashboard');
		$this->load->view('templates/footer');
	}

	public function my_profile()
	{
		$data['title'] = 'My Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menubar');
		$this->load->view('home/my-profile');
		$this->load->view('templates/footer');
	}

	public function edit_profile()
	{
		$data['title'] = 'Edit Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menubar');
		$this->load->view('home/edit-profile');
		$this->load->view('templates/footer');
	}

	public function change_password()
	{
		$data['title'] = 'Change Password';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menubar');
		$this->load->view('home/change-password');
		$this->load->view('templates/footer');
	}
}
