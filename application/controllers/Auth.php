<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
	public function index()
	{
		if ($this->session->userdata('authenticated')) {
			if ($this->session->userdata('role_id') == 1) {
				redirect('admin');
			} else {
				redirect('home');
			}
		}

		$this->load->view('login');
	}

	public function dologin()
	{
		if ($_POST['username'] == "superadmin") {
			if ($_POST['password'] == "admin") {
				$session = array(
					'authenticated' => true,
					'username' => "superadmin",
					'nama' => "Admin",
					'branchid' => "WPI",
					'role_id' => "1"
				);
				$this->session->set_userdata($session);
				redirect('admin');
			} else {
				$this->session->set_flashdata('message', ' Wrong username or password!');
				redirect('auth');
			}
		} else {
			$client = new SoapClient("http://ws.megafinance.co.id:8888/index.php?r=authentication/service");
			$result = $client->Login($_POST['username'], $_POST['password']);
			$row = json_decode($result, true);

			if ($row['IsError'] == "") {
				$session = array(
					'authenticated' => true,
					'username' => $row['Records']['username'],
					'nama' => $row['Records']['display_name'],
					'branchid' => $row['Records']['branch_id'],
					'role_id' => "2"
				);

				$this->session->set_userdata($session);
				redirect('home');
			} else {
				$this->session->set_flashdata('message', ' Wrong username or password!');
				redirect('auth');
			}
		}
	}

	public function dologout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function error_404()
	{
		$this->load->view('error_404');
	}
}
