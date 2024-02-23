<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {

            if($this->session->userdata('current_customer_order_area')){
                $this->session->unset_userdata('current_customer_order_area');
            }
            if($this->session->userdata('current_order_id')){
                $this->session->unset_userdata('current_order_id');
            }
            if($this->session->userdata('current_order_customer_id')){
                $this->session->unset_userdata('current_order_customer_id');
            }
   

            $data['active'] = 'order_creation';
            $data['page_title'] = ' Customer Order';
            $where = [
                'deleted' => 0,
                'status' => 1,
            ];
            $data['item'] =  $this->crud->fetch_data_asc('item', $where, 'item_id')->result();
            $data['order_type'] =  $this->crud->fetch_data_asc('order_type', $where, 'order_type_id')->result();
            // $data['vehicle'] =  $this->crud->fetch_data_asc('vehicle', $where, 'vehicle_id')->result();
            $where = [
                'deleted' => 0,
                'status' => 1
            ];

            $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();

            $this->load->view('include/header', $data);
            $this->load->view('Admin/ordertakeing/customer_order', $data);
            $this->load->view('include/footer');
        }
    }

    public function fetch_customer()
    {
        $area_id = $this->input->post('area_id');
        $this->session->set_userdata('current_customer_order_area', $area_id);
        $customer =  $this->admin_model->fetch_customer_based_area($area_id)->result();

        echo '<option value="" selected disabled>Customer</option>';
        foreach ($customer as $row) {
            echo '<option value="' . $row->customer_id . '">' . $row->customer_name . '</option>';
        }
    }
    public function fetch_customer_details()
    {
        $customer_id = $this->input->post('customer_id');
        $this->session->set_userdata('current_order_customer_id', $customer_id);
        $customer_details =  $this->admin_model->fetch_customer_details($customer_id)->row();

        $html_code = '';
        $html_code .= '
            <div>
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Customer Name</p>
                <h4 class="mb-2">' . $customer_details->customer_name . '</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Area</p>
                <h4 class="mb-2">' . $customer_details->area . '</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">OB</p>
                <h4 class="mb-2">&#8377; ' . $customer_details->ob . '</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Last Bill Date</p>
                <h4 class="mb-2 font-weight-normal">00/00/0000</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Bill Amount</p>
                <h4 class="mb-2">&#8377; 00000000</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Last Receipt Date</p>
                <h4 class="mb-2 font-weight-normal">00/00/0000</h4>
            </div>

            <div class="ms-lg-4">
                <p class="text-sm text-secondary font-weight-bolder opacity-6 mb-1">Receipt Amount</p>
                <h4 class="mb-2">&#8377; 00000000</h4>
            </div>
        
        ';
        $message = array('response' => 'success', 'message' => $html_code);
        echo json_encode($message);
    }

    public function create_order_id()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->session->userdata('current_order_id')) {
                $message = array('response' => 'success','rrrryy'=>'already session set');
            } else {
                $this->form_validation->set_rules(
                    'order_date',
                    'Order date',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'delivery_date',
                    'Delivery Date',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'order_type_id',
                    'Order type',
                    'trim|required'
                );

                if ($this->form_validation->run() == FALSE) {
                    $message = array('response' => 'error', 'message' => validation_errors());
                } else {
                    date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                    $date = date('Y-m-d H:i:s');

                    $record = [
                        "customer_id" => $this->session->userdata('current_order_customer_id'),
                        "area_id" => $this->session->userdata('current_customer_order_area'),
                        "order_date" => $this->input->post('order_date', true),
                        "delivery_date" => $this->input->post('delivery_date', true),
                        "order_type_id" => $this->input->post('order_type_id', true),
                        "remark" =>  $this->input->post('order_remark', true),
                        "status" => 0,
                        "created_date" => $date
                    ];
                    $inserted_id =  $this->crud->insert('customer_order', $record);
                    if ($inserted_id) {
                        $this->session->set_userdata('current_order_id', $inserted_id);
                        $message = array('response' => 'success');
                    } else {
                        $message = array('response' => 'error', 'message' => 'Failed to add');
                    }
                }
            }
            echo json_encode($message);
        }
    }

    public function customer_order_taking()
    {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Define validation rules for the form fields
            $this->form_validation->set_rules('customer_item_order[]', 'Item Order Quantity', 'numeric');
            // Run form validation
            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
            } else {
                // Retrieve and process the data sent from the client-side
                $item_order_quantities = $this->input->post('customer_item_order');
                $item_ids = $this->input->post('item_id');

                // Check if all stock quantities are empty
                if (array_sum($item_order_quantities) == 0) {
                    $response = array('success' => false, 'message' => 'All item orders are empty.');
                } else {
                    $current_order_id = $this->session->userdata('current_order_id');
                    $current_user_id = $this->session->userdata('user_id');
                    $insert_success = true;
                    // Insert data into the database (you should implement your database logic here)
                    foreach ($item_order_quantities as $key => $item_order_quantity) {
                        $item_id = $item_ids[$key];
                        if ($item_order_quantity > 0) {
                            date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                            $date = date('Y-m-d H:i:s');
                            $record = [
                                "customer_order_id" => $current_order_id,
                                "item_id" => $item_id,
                                "item_order_count" => $item_order_quantity,
                                "executive_user_id" => $current_user_id,
                                "created_date" => $date
                            ];
                            $check_insertion =  $this->crud->insert('customer_item_order', $record);
                            if (!$check_insertion) {
                                $insert_success = false;
                                break;
                            }
                        }
                    }
                    if ($insert_success) {
                        $verify_customer_order =  $this->admin_model->verify_customer_order($current_order_id)->result();

                        $response = array('response' => 'success', 'message' => 'Order successfully taken', 'order_data' => $verify_customer_order);
                    } else {
                        $response = array('response' => 'error', 'message' => 'Data not inserted.');
                    }
                }
            }

            // Send a JSON response back to the client
            echo json_encode($response);
        }

        // $response = array('false' => true, 'message' => 'hhhhhhhhhhhai');
        // echo json_encode($response);

    }
    public function delete_temp_close_stock_data()
    {
        $del_id = $this->input->post('delete_id');
        $table = 'customer_item_order';
        $where = [
            'customer_item_order_id' => $del_id
        ];
        $record = [
            'status' => 0
        ];
        $delete_result =  $this->crud->update($table, $record, $where);
        if ($delete_result) {
            $message = array('response' => 'success', 'message' => 'close  Deleted');
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
    }

    public function all_orders()
    {
        $data['active'] = 'all_orders';
        $data['page_title'] = ' All Orders';

        $data['all_orders'] =  $this->admin_model->all_orders();
        $this->load->view('include/header', $data);
        $this->load->view('Admin/ordertakeing/all_customer_order', $data);
        $this->load->view('include/footer');
    }

    public function customer_order_confirmed()
    {
        $table = 'customer_order';
        $where = [
            'customer_order_id' => $this->session->userdata('current_order_id')
        ];
        $record = [
            'status' => 1
        ];
        $make_order_confirmed =  $this->crud->update($table, $record, $where);
        if($make_order_confirmed){
            $this->session->unset_userdata('current_customer_order_area');
            $this->session->unset_userdata('current_order_id');
            $this->session->unset_userdata('current_order_customer_id');
            $message = array('response' => 'success', 'message' => 'Order Confirmed');
        }else{
            $message = array('response' => 'error', 'message' => 'An error occurred');
        }
        echo json_encode($message);
        
    }
    // end of class
}
