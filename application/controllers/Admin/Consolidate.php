<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Consolidate extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'consolidate';
            $data['page_title'] = ' Consolidate';
            $where = [
                'deleted' => 0,
                'status' => 1
            ];

            $data['area'] =  $this->crud->fetch_data_asc('area', $where, 'area_id')->result();
            $data['items'] =  $this->crud->fetch_data_asc('item', $where, 'item_id')->result();


            $this->load->view('include/header', $data);
            $this->load->view('Admin/consolidate/consolidate', $data);
            $this->load->view('include/footer');
        }
    }
    // public function fetch_customer_orders()
    // {
    //     if ($this->input->is_ajax_request()) {
    //         $this->form_validation->set_rules(
    //             'consolidate_area_id',
    //             'Area',
    //             'trim|required'
    //         );
    //         if ($this->form_validation->run() == FALSE) {
    //             $message = array('response' => 'error', 'message' => validation_errors());
    //         } else {
    //             $from_date = $this->input->post('consolidate_from_date');
    //             $to_date = $this->input->post('consolidate_to_date');
    //             $area_id = $this->input->post('consolidate_area_id');
    //             $customer_order_by_area = $this->admin_model->customer_order_by_area($from_date, $to_date, $area_id)->result();
    //             // $message = array('response' => 'error', 'message' => $customer_order_by_area);

    //             // Initialize an empty string to store the HTML
    //             $sl_no = 0;
    //             $table_html = '';
    //             foreach ($customer_order_by_area as $row) {
    //                 $where1 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 10,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item1_count =  $this->crud->fetch_data_without_order('customer_item_order', $where1);
    //                 if ($customer_order_item1_count->num_rows() > 0) {
    //                     $query = $customer_order_item1_count->row();
    //                     $item1_count = $query->item_order_count;
    //                 } else {
    //                     $item1_count = 0;
    //                 }


    //                 $where2 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 11,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item2_count =  $this->crud->fetch_data_without_order('customer_item_order', $where2);
    //                 if ($customer_order_item2_count->num_rows() > 0) {
    //                     $query = $customer_order_item2_count->row();
    //                     $item2_count = $query->item_order_count;
    //                 } else {
    //                     $item2_count = 0;
    //                 }


    //                 $where3 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 13,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item3_count =  $this->crud->fetch_data_without_order('customer_item_order', $where3);
    //                 if ($customer_order_item3_count->num_rows() > 0) {
    //                     $query = $customer_order_item3_count->row();
    //                     $item3_count = $query->item_order_count;
    //                 } else {
    //                     $item3_count = 0;
    //                 }

    //                 $where4 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 16,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item4_count =  $this->crud->fetch_data_without_order('customer_item_order', $where4);
    //                 if ($customer_order_item4_count->num_rows() > 0) {
    //                     $query = $customer_order_item4_count->row();
    //                     $item4_count = $query->item_order_count;
    //                 } else {
    //                     $item4_count = 0;
    //                 }

    //                 $where5 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 17,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item5_count =  $this->crud->fetch_data_without_order('customer_item_order', $where5);
    //                 if ($customer_order_item5_count->num_rows() > 0) {
    //                     $query = $customer_order_item5_count->row();
    //                     $item5_count = $query->item_order_count;
    //                 } else {
    //                     $item5_count = 0;
    //                 }

    //                 $where6 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 17,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item6_count =  $this->crud->fetch_data_without_order('customer_item_order', $where6);
    //                 if ($customer_order_item6_count->num_rows() > 0) {
    //                     $query = $customer_order_item6_count->row();
    //                     $item6_count = $query->item_order_count;
    //                 } else {
    //                     $item6_count = 0;
    //                 }


    //                 $where7 = [
    //                     'customer_order_id' => $row->customer_order_id,
    //                     'item_id' => 18,
    //                     'status => 1'
    //                 ];
    //                 $customer_order_item7_count =  $this->crud->fetch_data_without_order('customer_item_order', $where7);
    //                 if ($customer_order_item7_count->num_rows() > 0) {
    //                     $query = $customer_order_item7_count->row();
    //                     $item7_count = $query->item_order_count;
    //                 } else {
    //                     $item7_count = 0;
    //                 }

    //                 $sl_no++;
    //                 $table_html .= '

    //                  <tr>
    //                     <td>
    //                     <h6 class="mb-0 text-md">' . $sl_no . '</h6>
    //                     </td>     
    //                     <td><h6 class="mb-0 text-md">' . $row->customer_name . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $row->ob . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item1_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item2_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item3_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item4_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item5_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item6_count . '</h6></td>
    //                     <td><h6 class="mb-0 text-md">' . $item7_count . '</h6></td>

    //                     ';

    //                 // if (isset($customer_order_items_count[0]) && $customer_order_items_count[0]->item_id == 10) {
    //                 //     // Display item_order_count
    //                 //     $table_html .= '
    //                 //     <td>
    //                 //         <h6 class="mb-0 text-md">' . $customer_order_items_count[0]->item_order_count . '</h6>
    //                 //     </td>';
    //                 // } else {
    //                 //     // Display 0
    //                 //     $table_html .= '
    //                 //     <td>
    //                 //         <h6 class="mb-0 text-md">0</h6>
    //                 //     </td>';
    //                 // }


    //                 $table_html .=  '
    //                  </tr>
    //                  ';
    //             }

    //             $message = array('response' => 'success', 'message' => $table_html);
    //         }
    //         echo json_encode($message);
    //     }
    // }

    public function fetch_customer_orders()
{
    if ($this->input->is_ajax_request()) {
        $this->form_validation->set_rules(
            'consolidate_area_id',
            'Area',
            'trim|required'
        );

        if ($this->form_validation->run() == FALSE) {
            $message = array('response' => 'error', 'message' => validation_errors());
        } else {
            $from_date = $this->input->post('consolidate_from_date');
            $to_date = $this->input->post('consolidate_to_date');
            $area_id = $this->input->post('consolidate_area_id');
            $this->session->set_userdata('current_active_consolidate_area_id', $area_id);

            $customer_order_by_area = $this->admin_model->customer_order_by_area($from_date, $to_date, $area_id)->result();

            $sl_no = 0;
            $table_html = '';

            foreach ($customer_order_by_area as $row) {
                $sl_no++;
                $table_html .= '
                <input type="hidden" name="consolidate_order_ids[]" value="'.$row->customer_order_id.'">
                <tr>
                    <td><h6 class="mb-0 text-md">' . $sl_no . '</h6></td>
                    <td><h6 class="mb-0 text-md">' . $row->customer_name . '</h6></td>
                    <td><h6 class="mb-0 text-md">' . $row->ob . '</h6></td>';

                // Define an array of item IDs you want to fetch
                $itemIds = [10, 11, 13, 16, 17, 18,23,24];
                foreach ($itemIds as $itemId) {
                    $item_count = $this->getOrderItemCount($row->customer_order_id, $itemId);
                    $table_html .= '<td><h6 class="mb-0 text-md">' . $item_count . '</h6></td>';
                }
                $table_html .= '         <td class="text-sm">
                <a href="javascript:;" value="'.$row->customer_order_id.'" id="remove_customer_order" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                    <i class="material-icons text-danger position-relative text-lg">delete</i>
                </a>
            </td>';
                $table_html .= '</tr>';
            }

            $message = array('response' => 'success', 'message' => $table_html);
        }

        echo json_encode($message);
    }
}

private function getOrderItemCount($customer_order_id, $item_id)
{
    $where = [
        'customer_order_id' => $customer_order_id,
        'item_id' => $item_id,
        'status' => 1
    ];

    $customer_order_item_count = $this->crud->fetch_data_without_order('customer_item_order', $where);

    if ($customer_order_item_count->num_rows() > 0) {
        $query = $customer_order_item_count->row();
        return $query->item_order_count;
    }

    return 0;
}

public function order_convert_to_van_stock(){
    if ($this->input->is_ajax_request()) {
        $update_check = true;
      $order_ids = $this->input->post('consolidate_order_ids');
      $order_ids_array = array(); // Initialize an array to store order_ids.
      if (empty($order_ids)) {
        $message = array('response' => 'error', 'message' => 'No Data');
      }else{
      foreach ($order_ids as $order_id) {
       
        $where = ['customer_order_id' => $order_id];
        $record = ['is_order_coverted_to_van_stock' => 1];
        $update_result =  $this->crud->update('customer_order', $record, $where);
        if (!$update_result) {
            $update_check = false;
            break;
        }
        $order_ids_array[] = $order_id; 
    }
    if($update_check){
        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        $date = date('Y-m-d H:i:s');
        $order_ids_csv = implode(',', $order_ids_array);
        $consolidate_orders_record = [
            'order_ids' => $order_ids_csv,
            'area_id' => $this->session->userdata('current_active_consolidate_area_id'),
            'exicutive_id' => $this->session->userdata('user_id'),
            "created_date" => $date
        ];
      $this->crud->insert('consolidate_orders', $consolidate_orders_record);

        $message = array('response' => 'success', 'message' =>'Order converted to van stock', 'order_id_array' => $order_ids_csv);
    }else{
        $message = array('response' => 'error', 'message' =>'something went wrong,check again');
    }

      }
      echo json_encode($message);
    }
}

public function order_to_stock(){
    if ((!$this->session->userdata('user_logged_in'))) {
        redirect('login');
    } else {
        $data['active'] = 'consolidate';
        $data['page_title'] = ' Consolidate';
        $where = [
            'deleted' => 0,
            'status' => 1,
        ];
        $data['user'] =  $this->admin_model->stock_user()->result();
        $data['driver'] =  $this->crud->fetch_data_asc('driver', $where, 'driver_id')->result();
        $data['vehicle'] =  $this->crud->fetch_data_asc('vehicle', $where, 'vehicle_id')->result();

        $this->load->view('include/header', $data);
        $this->load->view('Admin/consolidate/consolidate_id_add', $data);
        $this->load->view('include/footer');
    }
}

public function remove_order(){
    if ($this->input->is_ajax_request()) {
      $delete_id = $this->input->post('delete_id');

       
        $where = ['customer_order_id' => $delete_id];
        $record = ['consolidate_status' => 0];
        $update_result =  $this->crud->update('customer_order', $record, $where);
 
    if($update_result){
        $message = array('response' => 'success', 'message' =>'Order removed ');
    }else{
        $message = array('response' => 'error', 'message' =>'something went wrong,check again');
    }


      echo json_encode($message);
    }
}
    // end of class
}
