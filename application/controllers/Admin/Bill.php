<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bill extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'bill';
            $data['page_title'] = ' Bill';
    
            $this->load->view('include/header', $data);
            $this->load->view('Admin/bill/bill', $data);
            $this->load->view('include/footer');
       }
    }
  
    public function fetch_customer_by_type()
    {
        $customer_type = $this->input->post('customer_type');
        $customers =  $this->admin_model->fetch_customer_by_type($customer_type)->result();

        echo '<option value="" selected disabled>Select Customer </option>';
        foreach ($customers as $row) {
            echo '<option value="' . $row->customer_id . '">' . $row->customer_name . '</option>';
        }
    }

    public function fetch_selected_customer_details()
    {
        $customer_id = $this->input->post('customer_id');
        // $this->session->set_userdata('current_order_customer_id', $customer_id);
        $customer_details =  $this->admin_model->fetch_selected_customer_details($customer_id)->row();

        $html_code = '';
        $html_code .= '
        <div class="row mt-3">
        <div class="col-md-6">
            <p class=" text-xs m-0">Customer </p>
            <h6 class="text-uppercase  mb-4">
            ' . $customer_details->customer_name . '
            </h6>
        </div>
        <div class="col-md-6">
            <p class=" text-xs m-0">Customer Mobile </p>
            <h6 class="text-uppercase  mb-4">
            ' . $customer_details->phone . '
            </h6>
        </div>
        <div class="col-md-6">
            <p class=" text-xs m-0">Customer Price List</p>
            <h6 class="text-uppercase  mb-4">
            ' . $customer_details->price_list_name . '
                        </h6>
        </div>
        <div class="col-md-6">
            <p class=" text-xs m-0">Customer Route</p>
            <h6 class="   mb-4">
            ' . $customer_details->area . '
            </h6>
        </div>
        <div class="col-md-6">
            <p class=" text-xs m-0">Customer GST NO</p>
            <h6 class="text-uppercase  mb-4">
            ' . $customer_details->gst_number . '
            </h6>
        </div>
        <div class="col-md-6">
            <p class=" text-xs m-0">Narration</p>
            <h6 class="text-uppercase  mb-4">
                Narration
            </h6>
        </div>

    </div>
        
        ';
        $message = array('response' => 'success', 'message' => $html_code);
        echo json_encode($message);
    }
    // end of class
}
