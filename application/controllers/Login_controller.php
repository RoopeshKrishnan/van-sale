<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{

	// to load login page
	public function index()
	{
		$this->load->view('login');
	}

	// to perform login functionality
	public function login()
	{
		if ($this->input->post('submit')) { // to check whether the login functionality perform by clicking the sign up button or not
			// if not , go back to the login page

			// form validation
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == false) {

				$this->index();
			} else {

				$username = $this->input->post('username');
				$password = $this->input->post('password');
				// checking whether the username is in the database or     not
				$check_login = $this->login_model->login_section($username);
				// if count is > 0 that means username is correct otherwise username is wrong
				if ($check_login->num_rows() > 0) {
					$result = $check_login->result();
					foreach ($result as $rows) {
						// fetch corresponding password
						$check_password = $rows->password;
						// checking the password is equal to user entered password
						// if match, that means the user entered credentials are true, otherwise false
						if ($check_password == $password) {
							date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
							$login_date_time = date('Y-m-d H:i:s');
                            $fetch_user_personal_data = $this->login_model->fetch_user_personal_data($rows->user_id);
							$user_data = [
								"user_id" => $rows->user_id,
								"user_name" => $fetch_user_personal_data->user_name,
								"user_email" => $fetch_user_personal_data->email,
								"user_phone" => $fetch_user_personal_data->phone,
                                "dob" => $fetch_user_personal_data->dob,
                                "app_username" => $fetch_user_personal_data->app_username,
                                "prefix" => $fetch_user_personal_data->prefix,
                                "created_date" => $fetch_user_personal_data->created_date,
                                "user_area" => $fetch_user_personal_data->area,
								"user_logged_in" => true,
								"login_time" => $login_date_time,
							];
							$this->session->set_userdata($user_data);

							redirect('dashboard');
						} else {
							$this->session->set_flashdata('invalid_password', 'Invalid Password...!!!');
							$this->index();
						}
					}
				} else {

					$this->session->set_flashdata('invalid_username', 'Invalid Username...!!!');
					$this->index();
				}
			}
		} else {
			redirect('login');
		}
	}

	// to find the user browser and version
	public function get_user_agent_info()
	{
		$this->load->library('user_agent');
		if ($this->agent->is_browser()) {
			$agent = $this->agent->browser() . ' ' . $this->agent->version();
		} elseif ($this->agent->is_robot()) {
			$agent = $this->agent->robot();
		} elseif ($this->agent->is_mobile()) {
			$agent = $this->agent->mobile();
		} else {
			$agent = 'Unidentified User Agent';
		}
		return $agent;
	}
	// to load dashboard page
	public function dashboard()
	{
		if ((!$this->session->userdata('user_logged_in'))) {

			redirect('login');
		} else {
		$data['active'] = 'dashboard';
		$data['page_title'] = 'Dashboard';
        $this->load->view('include/header',$data);
		$this->load->view('dashboard',$data);
		$this->load->view('include/footer');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}


	// end of login controller class
}
