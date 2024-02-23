<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'user_creation';
            $data['page_title'] = ' User Registration';
            $where = [
                'deleted' => 0,
                'status' =>1
            ];
            $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();

            // $data['fetch_area'] = $this->crud->fetch_data_asc('area', $where, 'area_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/user/user_creation', $data);
            $this->load->view('include/footer');
       }
    }
    // insert category into database
    public function add_user()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'name',
                'User Name ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'dob',
                'Date of Birth',
                'trim|required'
            );
            $this->form_validation->set_rules(
				'email',
				'Email',
				'trim|required|valid_email|is_unique[user_personal_details.email]',
				array('is_unique' => 'This Email is already added')
			);
            $this->form_validation->set_rules(
				'phone',
				'Mobile phone ',
				'trim|required|is_unique[user_personal_details.phone]',
				array('is_unique' => 'This Mobile number is already added')
			);
            $this->form_validation->set_rules(
                'address',
                'Address',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'pincode',
                'Pincode',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'e_code',
                'Executive Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'area_id',
                'Area',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'type_of_scheme',
                'Type of scheme',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'app_username',
                'App Username',
                'trim|required'
            );
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');

            $this->form_validation->set_rules(
                'prefix',
                'Prefix',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'starting_bill_no',
                'Starting bill number',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'last_bill_no',
                'Last bill number',
                'trim|required'
            );


            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $personal_record = [
                    "user_name" => $this->input->post('name', true),
                    "email" => $this->input->post('email', true),
                    "phone" => $this->input->post('phone', true),
                    "dob" => $this->input->post('dob', true),
                    "address" => $this->input->post('address', true),
                    "pincode" => $this->input->post('pincode', true),
                    "secondary_address" => $this->input->post('s_address', true),
                    "secondary_phone" => $this->input->post('o_phone', true),
                    "state" => $this->input->post('state', true),
                    "district" => $this->input->post('district', true),
                    "city" => $this->input->post('city', true),
                    "created_date" => $date
                ];
                $inserted_user_id =  $this->crud->insert('user_personal_details', $personal_record);
                $message = array('response' => 'success', 'message' => $inserted_user_id);

                if ($inserted_user_id) {
                    $company_record = [
                        "user_id" => $inserted_user_id,
                        "executive_code" => $this->input->post('e_code', true),
                        "area_id" => $this->input->post('area_id', true),
                        "type_of_scheme" => $this->input->post('type_of_scheme', true),
                        "app_username" => $this->input->post('app_username', true),
                        "password" => $this->input->post('password', true),
                        "prefix" => $this->input->post('prefix', true),
                        "starting_bill_number" => $this->input->post('starting_bill_no', true),
                        "last_bill_number" => $this->input->post('last_bill_no', true),
                        "profile_status" => $this->input->post('profile_status', true) ? 1 : 0,
                        "login_or_not" => $this->input->post('login_or_logout', true) ? 1 : 0,
                        "created_date" => $date
                    ];
                    $check_insertion =  $this->crud->insert('user_company_details', $company_record);

                    if ($check_insertion) {
                        $message = array('response' => 'success', 'message' => 'User Created');
                    } else {
                        $message = array('response' => 'error', 'message' => 'Failed to add');
                    }

                } else {
                    $message = array('response' => 'error', 'message' => 'Failed to add');
                }
            }
            echo json_encode($message);
        } else {

            redirect('login');
        }
    }


    public function all_user(){

        $data['active'] = 'all_user';
        $data['page_title'] = ' All users';

        $data['all_users'] =  $this->admin_model->all_users();
        $this->load->view('include/header',$data);
		$this->load->view('Admin/user/all_user',$data);
		$this->load->view('include/footer');
    }

 

    public function edit_user($user_id){
        $data['page_title'] = ' User edit';
        $data['active'] = 'all_user';

        $where = [
            'deleted' => 0
        ];
        $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();

        $data['edit_user'] =  $this->admin_model->edit_user($user_id);
        $this->load->view('include/header',$data);
        $this->load->view('Admin/user/edit_user',$data);
      $this->load->view('include/footer');
    }
    // to load the category data into model for editing
  public function update_user(){

    if ($this->input->is_ajax_request()) {
        $this->form_validation->set_rules(
            'name',
            'User Name ',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'dob',
            'Date of Birth',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email'
        );
        $this->form_validation->set_rules(
            'phone',
            'Mobile phone ',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'address',
            'Address',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'pincode',
            'Pincode',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'e_code',
            'Executive Code',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'area_id',
            'Area',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'type_of_scheme',
            'Type of scheme',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'app_username',
            'App Username',
            'trim|required'
        );
      
        $this->form_validation->set_rules(
            'prefix',
            'Prefix',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'starting_bill_no',
            'Starting bill number',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'last_bill_no',
            'Last bill number',
            'trim|required'
        );


        if ($this->form_validation->run() == FALSE) {
            $message = array('response' => 'error', 'message' => validation_errors());
        } else {
            $where = [
                'user_id' => $this->input->post('selected_user_id')
            ];
       
            $personal_record = [
                "user_name" => $this->input->post('name', true),
                "email" => $this->input->post('email', true),
                "phone" => $this->input->post('phone', true),
                "dob" => $this->input->post('dob', true),
                "address" => $this->input->post('address', true),
                "pincode" => $this->input->post('pincode', true),
                "secondary_address" => $this->input->post('s_address', true),
                "secondary_phone" => $this->input->post('o_phone', true),
                "state" => $this->input->post('state', true),
                "district" => $this->input->post('district', true),
                "city" => $this->input->post('city', true),
            ];
            $is_personal =  $this->crud->update('user_personal_details', $personal_record,$where);

                $company_record = [
                    "executive_code" => $this->input->post('e_code', true),
                    "area_id" => $this->input->post('area_id', true),
                    "type_of_scheme" => $this->input->post('type_of_scheme', true),
                    "app_username" => $this->input->post('app_username', true),
                    "prefix" => $this->input->post('prefix', true),
                    "starting_bill_number" => $this->input->post('starting_bill_no', true),
                    "last_bill_number" => $this->input->post('last_bill_no', true),
                    "profile_status" => $this->input->post('profile_status', true) ? 1 : 0,
                    "login_or_not" => $this->input->post('login_or_logout', true) ? 1 : 0,
                ];
                $is_company =  $this->crud->update('user_company_details', $company_record,$where);
                if($is_personal || $is_company){
                    $message = array('response' => 'success', 'message' => 'User updated');
                }else{
                    $message = array('response' => 'error', 'message' => 'Please Change something and Submit');
                }
        }
        echo json_encode($message);
    } else {
        redirect('login');
    }
  }
    // update category 
    public function update_category()
    {
        $this->form_validation->set_rules(
            'edit_data',
            'Category',
            'trim|required'
        );
        if ($this->form_validation->run() == FALSE) {
            $message = array('response' => 'form_error', 'message' => validation_errors());
        } else {
            $table = 'category';
            date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
            $date = date('Y-m-d H:i:s');
            $where = [
                'category_id' => $this->input->post('edit_id', true)
            ];
            $record = [
                'category' => $this->input->post('edit_data', true),
                'created_date' => $date
            ];
            $update_result =  $this->crud->update($table, $record, $where);
            if ($update_result) {
                $message = array('response' => 'success', 'message' => 'Category Updated');
            } else {
                $message = array('response' => 'error', 'message' => 'Failed ');
            }
        }
        echo json_encode($message);
    }
    // delete  category 
    public function delete_category()
    {
        $del_id = $this->input->post('del_id');
        $table = 'category';
        $where = [
            'category_id' => $del_id
        ];
        $record = [
            'deleted' => 1
        ];
        $delete_result =  $this->crud->update($table, $record, $where);
        if ($delete_result) {
            $message = array('response' => 'success', 'message' => 'Category Deleted');
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
    }

    // end of class
}
