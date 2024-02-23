<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tax extends CI_Controller
{
    // to load subcategory page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'tax';
            $data['page_title'] = 'Tax ';
            $where = [
                'deleted' => 0,
                'status' => 1
            ];
            $order = 'tax_type_id ';
            $data['tax_type'] =  $this->crud->fetch_data_asc('tax_type', $where, $order)->result();
            $data['fetch_tax'] = $this->admin_model->fetch_tax();
            $this->load->view('include/header', $data);
            $this->load->view('Admin/tax', $data);
            $this->load->view('include/footer');
        }
    }
    // insert sub category into database
    public function add_tax()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'tax',
                'Tax  ',
                'trim|required'            );
            $this->form_validation->set_rules(
                'tax_type_id',
                ' Tax type ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'tax_name',
                ' Tax Name ',
                'trim|required'
            );
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                $tax = $this->input->post('tax', true);
                $tax_type_id = $this->input->post('tax_type_id', true);
                $check_tax_validation = $this->admin_model->check_tax_validation($tax, $tax_type_id);
                if ($check_tax_validation->num_rows() > 0) {
                    $message = array('response' => 'error', 'message' => 'Already Added');
                } else {
                    date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                    $date = date('Y-m-d H:i:s');
                    $record = [
                        "tax" => $tax,
                        "tax_type_id" => $tax_type_id,
                        "tax_name" => $this->input->post('tax_name', true),
                        "status" => $this->input->post('status', true) ? 1 : 0,
                        "created_date" => $date
                    ];
                    $check_insertion =  $this->crud->insert('tax', $record);
                    if ($check_insertion) {
                        $message = array('response' => 'success', 'message' => 'Tax  added');
                    } else {
                        $message = array('response' => 'error', 'message' => 'Failed to add');
                    }
                }
            }
            echo json_encode($message);
        } else {

            redirect('login');
        }
    }
    // to load the sub category data into model for editing
    public function edit_sub_category()
    {
        $edit_id = $this->input->post('edit_id');
        $table = 'sub_category';
        $where = [
            'sub_category_id' => $edit_id,
            'deleted' => 0
        ];
        $order = 'sub_category_id';
        $check_data =  $this->crud->fetch_data_asc($table, $where, $order);
        if ($check_data) {
            $message = array('response' => 'success', 'post' => $check_data->row());
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
    }
    // update sub category 
    public function update_sub_category()
    {
        $this->form_validation->set_rules(
            'edit_data',
            'Sub Category',
            'trim|required'
        );
        if ($this->form_validation->run() == FALSE) {
            $message = array('response' => 'form_error', 'message' => validation_errors());
        } else {
            $sub_category = $this->input->post('edit_data', true);
            $category_id = $this->input->post('cat_id', true);
            $check_subcategory_validation = $this->admin_model->check_subcategory_validation($sub_category, $category_id);
            if ($check_subcategory_validation->num_rows() > 0) {
                $message = array('response' => 'error', 'message' => 'Already Added');
            } else {
                $table = 'sub_category';
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $where = [
                    'sub_category_id' => $this->input->post('edit_id', true)
                ];
                $record = [
                    'sub_category' => $sub_category,
                    'category_id' => $category_id,
                    'created_date' => $date
                ];
                $update_result =  $this->crud->update($table, $record, $where);
                if ($update_result) {
                    $message = array('response' => 'success', 'message' => 'Sub Category Updated');
                } else {
                    $message = array('response' => 'error', 'message' => 'Failed ');
                }
            }
            echo json_encode($message);
        }
    }
    // delete  sub category 
    public function delete_sub_category()
    {
        $del_id = $this->input->post('del_id');
        $table = 'sub_category';
        $where = [
            'sub_category_id' => $del_id
        ];
        $record = [
            'deleted' => 1
        ];
        $delete_result =  $this->crud->update($table, $record, $where);
        if ($delete_result) {
            $message = array('response' => 'success', 'message' => 'Sub Category Deleted');
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
    }

    // end of class
}
