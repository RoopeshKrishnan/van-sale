<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_category extends CI_Controller
{
    // to load subcategory page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'sub_category';
            $data['page_title'] = 'Sub Category';
            $where = [
                'deleted' => 0,
                'status'=>1
            ];
            $order = 'category_id ';
            $data['category'] =  $this->crud->fetch_data_asc('category', $where, $order)->result();
            $data['fetch_sub_category'] = $this->admin_model->fetch_sub_category();
            $this->load->view('include/header', $data);
            $this->load->view('Admin/sub_category', $data);
            $this->load->view('include/footer');
        }
    }
    // insert sub category into database
    public function add_sub_category()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'sub_category',
                'Sub Category ',
                'trim|required|is_unique[sub_category.sub_category]',
                array('is_unique' => 'This Sub category is already added')
            );
            $this->form_validation->set_rules(
                'category_id',
                ' Category ',
                'trim|required'
            );
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                $sub_category = $this->input->post('sub_category', true);
                $category_id = $this->input->post('category_id', true);
                $check_subcategory_validation = $this->admin_model->check_subcategory_validation($sub_category, $category_id);
                if ($check_subcategory_validation->num_rows() > 0) {
                    $message = array('response' => 'error', 'message' => 'Already Added');
                } else {
                    date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                    $date = date('Y-m-d H:i:s');
                    $record = [
                        "sub_category" => $sub_category,
                        "category_id" => $category_id,
                        "status" => $this->input->post('status', true) ? 1 : 0,
                        "created_date" => $date
                    ];
                    $check_insertion =  $this->crud->insert('sub_category', $record);
                    if ($check_insertion) {
                        $message = array('response' => 'success', 'message' => 'Sub Category  added');
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
