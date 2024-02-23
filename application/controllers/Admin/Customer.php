<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'customer_creation'; 
            $data['page_title'] = ' Customer Registration';
            $where = [
                'deleted' => 0,
                'status'=>1
            ];
            $where1 = [
                'deleted' => 0,
            ];
            $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();
            $data['days'] =  $this->crud->fetch_data_asc('week_days', $where1, 'week_day_id ')->result();
            $data['groups'] =  $this->crud->fetch_data_asc('customer_group', $where, 'customer_group_id ')->result();
            $data['pricelist'] =  $this->crud->fetch_data_asc('price_list_name', $where, 'price_list_name_id ')->result();

            // $data['fetch_area'] = $this->crud->fetch_data_asc('area', $where, 'area_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/customer/customer_creation', $data);
            $this->load->view('include/footer');
       }
    }
    // insert category into database
    public function add_customer()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'name',
                'Customer Name ',
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
				'trim|required|valid_email|is_unique[customer_personal_details.email]',
				array('is_unique' => 'This Email is already added')
			);
            $this->form_validation->set_rules(
				'phone',
				'Mobile phone ',
				'trim|required|is_unique[customer_personal_details.phone]',
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
                'c_code',
                'Customer Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'alias_code',
                'Alias Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'ob',
                'OB',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'area_id',
                'Area',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'group_id',
                'Group',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'price_list_id',
                'Price list',
                'trim|required'
            );
  
            $this->form_validation->set_rules(
                'app_customer_name',
                'App Customer Name',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'shop_opening',
                'Shop opening',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'leave_in_week[]',
                'Any Leave in week',
                'trim|required'
            );
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|matches[password]');

         

            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                if($this->input->post('leave_in_week')){
                    $leave_days = substr(implode(', ', $this->input->post('leave_in_week')), 0);	
                }else{
                    $leave_days = '';
                }
                $personal_record = [
                    "customer_name" => $this->input->post('name', true),
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
                $inserted_customer_id =  $this->crud->insert('customer_personal_details', $personal_record);
                $message = array('response' => 'success', 'message' => $inserted_customer_id);

                if ($inserted_customer_id) {
                    $company_record = [
                        "customer_id" => $inserted_customer_id,
                        "customer_other_name" => $this->input->post('o_name', true),
                        "customer_code" => $this->input->post('c_code', true),
                        "alias_code" => $this->input->post('alias_code', true),
                        "area_id" => $this->input->post('area_id', true),
                        "ob" => $this->input->post('ob', true),
                        "gst_number" => $this->input->post('gst_number', true),
                        "bill_type" => $this->input->post('bill_type', true),
                        "credit_limit" => $this->input->post('credit_limit', true),

                        "created_user_id" => $this->session->userdata('user_id'),
                        "customer_group_id" => $this->input->post('group_id', true),
                        "price_list" => $this->input->post('price_list_id', true),
                        "app_customer_name" => $this->input->post('app_customer_name', true),
                        "password" => $this->input->post('password', true),
                        "shop_opening" => $this->input->post('shop_opening', true),
                        "any_leave_in_week" => $leave_days,
                        "profile_status" => $this->input->post('profile_status', true) ? 1 : 0,
                        "login_or_not" => $this->input->post('login_or_logout', true) ? 1: 0,
                        "created_date" => $date
                    ];
                    $check_insertion =  $this->crud->insert('customer_company_details', $company_record);

                    if ($check_insertion) {
                        $message = array('response' => 'success', 'message' => 'Customer Created');
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

    public function all_customers(){

        $data['page_title'] = ' All Customers';
        $data['active'] = 'all_customer'; 
        $data['all_customers'] =  $this->admin_model->all_customers();
        $this->load->view('include/header',$data);
		$this->load->view('Admin/customer/all_customer',$data);
		$this->load->view('include/footer');
    }
    // to load the category data into model for editing
    public function edit_customer($customer_id){
        $data['page_title'] = ' Customer edit';
        $data['active'] = 'all_customer'; 
        $data['cus'] = $customer_id;

        $where = [
            'deleted' => 0
        ];
        $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();
        $data['days'] =  $this->crud->fetch_data_asc('week_days', $where, 'week_day_id ')->result();
        $data['groups'] =  $this->crud->fetch_data_asc('customer_group', $where, 'customer_group_id ')->result();
        $data['pricelist'] =  $this->crud->fetch_data_asc('price_list_name', $where, 'price_list_name_id ')->result();

        $data['edit_customer'] =  $this->admin_model->edit_customer($customer_id);
        $this->load->view('include/header',$data);
        $this->load->view('Admin/customer/edit_customer',$data);
      $this->load->view('include/footer');
    }
    // update customer
    public function update_customer(){
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'name',
                'Customer Name ',
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
                'c_code',
                'Customer Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'alias_code',
                'Alias Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'ob',
                'OB',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'area_id',
                'Area',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'group_id',
                'Group',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'price_list_id',
                'Price list',
                'trim|required'
            );
  
            $this->form_validation->set_rules(
                'app_customer_name',
                'App Customer Name',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'shop_opening',
                'Shop opening',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'leave_in_week[]',
                'Any Leave in week',
                'trim|required'
            );
           
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                $where = [
                    'customer_id' => $this->input->post('selected_customer_id')
                ];
                if($this->input->post('leave_in_week')){
                    $leave_days = substr(implode(', ', $this->input->post('leave_in_week')), 0);	
                }else{
                    $leave_days = '';
                }
                $personal_record = [
                    "customer_name" => $this->input->post('name', true),
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
                $is_personal =  $this->crud->update('customer_personal_details', $personal_record,$where);

                    $company_record = [
                        "customer_other_name" => $this->input->post('o_name', true),
                        "customer_code" => $this->input->post('c_code', true),
                        "alias_code" => $this->input->post('alias_code', true),
                        "area_id" => $this->input->post('area_id', true),
                        "ob" => $this->input->post('ob', true),
                        "gst_number" => $this->input->post('gst_number', true),
                        "bill_type" => $this->input->post('bill_type', true),
                        "credit_limit" => $this->input->post('credit_limit', true),
                        
                        "customer_group_id" => $this->input->post('group_id', true),
                        "price_list" => $this->input->post('price_list_id', true),
                        "app_customer_name" => $this->input->post('app_customer_name', true),
                        "shop_opening" => $this->input->post('shop_opening', true),
                        "any_leave_in_week" => $leave_days,
                        "profile_status" => $this->input->post('profile_status', true) ? 1 : 0,
                        "login_or_not" => $this->input->post('login_or_logout', true) ? 1 : 0,
                    ];
                    $is_company =  $this->crud->update('customer_company_details', $company_record,$where);

                    if($is_personal || $is_company){
                        $message = array('response' => 'success', 'message' => 'Customer updated');
                    }else{
                        $message = array('response' => 'error', 'message' => 'Please Change something and Submit');
                    }
            }
            echo json_encode($message);
        } else {
            redirect('login');
        }
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
