<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'driver';
            $data['page_title'] = ' Driver';
            $where = [
                'deleted' => 0
            ];
            $data['fetch_driver'] = $this->crud->fetch_data_asc('driver', $where, 'driver_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/driver', $data);
            $this->load->view('include/footer');
       }
    }
    // insert category into database
    public function add_driver()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'name',
                'Driver Name ',
                'trim|required|is_unique[driver.driver_name]',
                array('is_unique' => 'This Driver is already added')
            );
            $this->form_validation->set_rules(
                'd_code',
                'Driver Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'driver_expiry_date',
                'Driver Expiry Date',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'email',
                'Email ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'dob',
                'Date of Birth ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'phone',
                'Mobile Phone',
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
                'trim|required|integer'
            );

            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $record = [
                    "driver_name" => $this->input->post('name', true),
                    "driver_code" => $this->input->post('d_code', true),
                    "address" => $this->input->post('address', true),
                    "dob" => $this->input->post('dob', true),
                    "email" => $this->input->post('email', true),
                    "phone" => $this->input->post('phone', true),
                    "other_phone" => $this->input->post('o_phone', true),
                    "pincode" => $this->input->post('pincode', true),
                    "driver_expiry_date" => $this->input->post('driver_expiry_date', true),
                    "status" => $this->input->post('d_status', true) ? 1 : 0,
                    "created_date" => $date
                ];
                $check_insertion =  $this->crud->insert('driver', $record);
                if ($check_insertion) {
                    $message = array('response' => 'success', 'message' => 'Driver  added');
                } else {
                    $message = array('response' => 'error', 'message' => 'Failed to add');
                }
            }
            echo json_encode($message);
        } else {
            redirect('login');
        }
    }
    // to load the category data into model for editing
    public function edit_category()
    {
        $edit_id = $this->input->post('edit_id');
        $table = 'category';
        $where = [
            'category_id' => $edit_id,
            'deleted' => 0
        ];
        $order = 'category_id';
        $check_data =  $this->crud->fetch_data_asc($table, $where, $order);
        if ($check_data) {
            $message = array('response' => 'success', 'post' => $check_data->row());
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
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
