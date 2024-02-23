<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'group';
            $data['page_title'] = ' Group';
            $where = [
                'deleted' => 0
            ];
            $data['fetch_group'] = $this->crud->fetch_data_asc('customer_group', $where, 'customer_group_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/group', $data);
            $this->load->view('include/footer');
       }
    }
    // insert category into database
    public function add_group()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'g_name',
                'Group Name ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'g_code',
                'Group code',
                'trim|required'
            );

            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $record = [
                    "customer_group_name" => $this->input->post('g_name', true),
                    "customer_group_code" => $this->input->post('g_code', true),
                    "status" => $this->input->post('g_status', true) ? 1 : 0,
                    "created_date" => $date
                ];
                $check_insertion =  $this->crud->insert('customer_group', $record);
                if ($check_insertion) {
                    $message = array('response' => 'success', 'message' => 'Group  added');
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
