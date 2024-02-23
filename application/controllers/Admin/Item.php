<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
     // fetch subcategory according to category
     public function fetch_sub_category(){
        $category_id = $this->input->post('category_id');
        $where = [
            'deleted' => 0,
            'status'=>1,
            'category_id' => $category_id
        ];
        $order = 'sub_category_id ';
        $sub_category =  $this->crud->fetch_data_asc('sub_category', $where, $order)->result();
        echo '<option value="" selected disabled>Sub category</option>';
        foreach ($sub_category as $row) {
            echo '<option value="' . $row->sub_category_id . '">' . $row->sub_category . '</option>';
        }
    }

    // fetch category type when clicking sub category
    public function fetch_category_type(){
        $sub_category_id = $this->input->post('sub_category_id');
        $category_id = $this->input->post('category_id');

        $where = [
            'deleted' => 0,
            'status'=>1,
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
        ];
        $order = 'category_type_id ';
        $category_type =  $this->crud->fetch_data_asc('category_type', $where, $order)->result();
        echo '<option value="" selected disabled>Category type</option>';
        foreach ($category_type as $row) {
            echo '<option value="' . $row->category_type_id . '">' . $row->category_type . '</option>';
        }
    }
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'item_creation';
            $data['page_title'] = 'Item creation';
            $where1 = [
                'deleted' => 0,
            ];
            $where = [
                'deleted' => 0,
                'status' =>1,
            ];
            $data['tax'] =  $this->crud->fetch_data_asc('tax', $where, 'tax_id')->result();
            $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id')->result();
            $data['item_unit'] =  $this->crud->fetch_data_asc('item_unit', $where1, 'item_unit_id')->result();
            // $data['fetch_area'] = $this->crud->fetch_data_asc('area', $where, 'area_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/item/item', $data);
            $this->load->view('include/footer');
       }
    }

    public function item_unit(){
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'item_unit';
            $data['page_title'] = 'Item unit';
            $where = [
                'deleted' => 0
            ];
            $data['fetch_item_unit'] = $this->crud->fetch_data_asc('item_unit', $where, 'item_unit_id');
            $this->load->view('include/header', $data);
            $this->load->view('Admin/item/item_unit', $data);
            $this->load->view('include/footer');
       }
    }
   
    public function add_item_unit(){
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'item_unit',
                'Item unit ',
                'trim|required|is_unique[item_unit.item_unit]',
                array('is_unique' => 'This Item unit is already added')
            );
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $record = [
                    "item_unit" => $this->input->post('item_unit', true),
                    "created_date" => $date
                ];
                $check_insertion =  $this->crud->insert('item_unit', $record);
                if ($check_insertion) {
                    $message = array('response' => 'success', 'message' => 'Item unit  added');
                } else {
                    $message = array('response' => 'error', 'message' => 'Failed to add');
                }
            }
            echo json_encode($message);
        } else {

            redirect('login');
        }
    }

    // item creation
    public function add_item()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'item_code',
                'Item Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_name',
                'Item Name',
                'trim|required'
            );
       
            $this->form_validation->set_rules(
                'barcode',
                'Barcode',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'hsn_code',
                'HSN Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'have_tax',
                'Have Tax',
                'trim|required'
            );
            if( $this->input->post('have_tax') == 'yes'){
                $this->form_validation->set_rules(
                    'tax_id',
                    ' Tax percentage',
                    'trim|required'
                );
            }
            $this->form_validation->set_rules(
                'i_category_id',
                'Category',
                'trim|required'
            );
            // $this->form_validation->set_rules(
            //     'i_sub_category_id',
            //     'Sub category',
            //     'trim|required'
            // );
            // $this->form_validation->set_rules(
            //     'i_category_type_id',
            //     'Category type',
            //     'trim|required'
            // );
     
            $this->form_validation->set_rules(
                'alias_code',
                'Alias code ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'alias_name',
                'Alias Name',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_value',
                'Minimum Sale unit value ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_unit_id',
                'Minimum Sale Unit ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'net_weight',
                'Net weight ',
                'trim|required'
            );
               if($this->input->post('have_box',true)){

                $this->form_validation->set_rules(
                    'box_item_code',
                    'Box item Code',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_item_name',
                    'Box item Name',
                    'trim|required'
                );
           
                $this->form_validation->set_rules(
                    'box_barcode',
                    'Box Barcode',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_alias_code',
                    'Box Alias code',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_alias_name',
                    'Box Alias name',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_item_unit_id',
                    'Box item unit',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_number_of_items',
                    'Number of items ',
                    'trim|required'
                );
                $this->form_validation->set_rules(
                    'box_net_weight',
                    'Box net weight ',
                    'trim|required'
                );
             }

            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                if($this->input->post('have_box',true)){
                    $has_box =1; // means item have another box item,(1==yes)
                    $batch_code = random_string('alnum', 25);
                }else{
                    $has_box =0;// means item have no box item,(0==no)
                    $batch_code = null;
                }

                if( $this->input->post('have_tax') == 'yes'){
                   $tax_id_is = $this->input->post('tax_id', true);
                   $have_tax = 1;
                }else{
                    $tax_id_is = 0;
                    $have_tax = 0;

                }

                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $item_record = [
                    "item_name" => $this->input->post('item_name', true),
                    "item_code" => $this->input->post('item_code', true),
                    "bar_code" => $this->input->post('barcode', true),
                    "hsn_code" => $this->input->post('hsn_code', true),
                    "have_tax" => $have_tax,
                    "tax_id" => $tax_id_is,
                    "category_id" => $this->input->post('i_category_id', true),
                    "sub_category_id" => $this->input->post('i_sub_category_id', true),
                    "category_type_id" => $this->input->post('i_category_type_id', true),
                    "alias_item_code" => $this->input->post('alias_code', true),
                    "alias_name" => $this->input->post('alias_name', true),
                    "minimum_sale_unit_value" => $this->input->post('item_value', true),
                    "minimum_sale_unit_id" => $this->input->post('item_unit_id', true),
                    "net_weight" => $this->input->post('net_weight', true),
                    "has_box" => $has_box,
                    "is_box_item" => 'No',
                    "batch_code" => $batch_code,
                    "status" => $this->input->post('status', true) ? 1 : 0,
                    "created_date" => $date
                ];
                $inserted_item_id =  $this->crud->insert('item', $item_record);
                $result = '';

                if($this->input->post('have_box',true)){
                    $box_item_record = [
                        "item_name" => $this->input->post('box_item_name', true),
                        "item_code" => $this->input->post('box_item_code', true),
                        "bar_code" => $this->input->post('box_barcode', true),
                        "hsn_code" => $this->input->post('hsn_code', true),
                        "tax_id" => $this->input->post('tax_id', true),
                        "category_id" => $this->input->post('i_category_id', true),
                        "sub_category_id" => $this->input->post('i_sub_category_id', true),
                        "category_type_id" => $this->input->post('i_category_type_id', true),
                        "alias_item_code" => $this->input->post('box_alias_code', true),
                        "alias_name" => $this->input->post('box_alias_name', true),
                        "minimum_sale_unit_value" => $this->input->post('item_box_value', true),
                        "minimum_sale_unit_id" => $this->input->post('box_item_unit_id', true),
                        "number_of_item_in_box" => $this->input->post('box_number_of_items', true),
                        "net_weight" => $this->input->post('box_net_weight', true),
                        "box_total_packed_weight" => $this->input->post('box_total_packed_weight', true),
                        "has_box" => 0,
                        "is_box_item" => 'Yes',
                        "batch_code" => $batch_code,
                        "status" => $this->input->post('box_status', true) ? 1 : 0,
                        "created_date" => $date
                    ];
                    $result = $this->crud->insert('item', $box_item_record);
                } 
                if($result !== ''){
                    if($inserted_item_id && $result){
                        $message = array('response' => 'success', 'message' => 'Items  added');
                    }else{
                        $message = array('response' => 'error', 'message' => 'Something is wrong,check all Item list to make sure wether item added or not');
                    }
                }else{
                    if($inserted_item_id){
                        $message = array('response' => 'success', 'message' => 'Item  added');
                    }else{
                        $message = array('response' => 'error', 'message' => 'Failed to add');
                    }
                }
            }
            echo json_encode($message);
        } else {

            redirect('login');
        }

    }
    public function all_items(){

        $data['active'] = 'all_items';
        $data['page_title'] = ' All Items';

        $data['all_items'] =  $this->admin_model->all_items();
        $this->load->view('include/header',$data);
		$this->load->view('Admin/item/all_item',$data);
		$this->load->view('include/footer');
    }
    public function edit_item($item_id){
        $data['page_title'] = ' Item edit';
        $data['active'] = 'all_items';
        $where1 = [
            'deleted' => 0,
            'item_id' => $item_id
        ];
        $data['item'] =  $this->crud->fetch_single_row('item', $where1);
        $category_id = $data['item']->category_id;
        $sub_category_id = $data['item']->sub_category_id;

        $where = [
            'deleted' => 0,
            'status' => 1
        ];

        $where2 = [
            'deleted' => 0
        ];
        $subcatwhere = [
            'deleted' => 0,
            'status' =>1,
            'category_id' => $category_id
        ];
        $categoryTypeWhere = [
            'deleted' => 0,
            'status' =>1,
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id
        ];

        $data['tax'] =  $this->crud->fetch_data_asc('tax', $where, 'tax_id')->result();
        $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id ')->result();
        $data['sub_category'] =  $this->crud->fetch_data_asc('sub_category', $subcatwhere, 'sub_category_id ')->result();
        $data['category_type'] =  $this->crud->fetch_data_asc('category_type', $categoryTypeWhere, 'category_type_id ')->result();
        $data['item_unit'] =  $this->crud->fetch_data_asc('item_unit', $where2, 'item_unit_id ')->result();
        $data['item'] =  $this->crud->fetch_single_row('item', $where1);
        $this->load->view('include/header',$data);
        $this->load->view('Admin/item/edit_item',$data);
      $this->load->view('include/footer');
    }

    // item update
    public function update_item(){
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'item_code',
                'Item Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_name',
                'Item Name',
                'trim|required'
            );
       
            $this->form_validation->set_rules(
                'barcode',
                'Barcode',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'hsn_code',
                'HSN Code',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'tax_id',
                'Tax percentage ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'i_category_id',
                'Category',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'alias_code',
                'Alias code ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'alias_name',
                'Alias Name',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_value',
                'Minimum Sale unit value ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'item_unit_id',
                'Minimum Sale Unit ',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'net_weight',
                'Net weight ',
                'trim|required'
            );
               if($this->input->post('is_box_item')=='Yes'){
                $this->form_validation->set_rules(
                    'box_number_of_items',
                    'Number of items in box',
                    'trim|required'
                );
             }
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                $where = [
                    'item_id' => $this->input->post('selected_item_id')
                ];
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');
                $item_record = [
                    "item_name" => $this->input->post('item_name', true),
                    "item_code" => $this->input->post('item_code', true),
                    "bar_code" => $this->input->post('barcode', true),
                    "hsn_code" => $this->input->post('hsn_code', true),
                    "tax_id" => $this->input->post('tax_id', true),
                    "category_id" => $this->input->post('i_category_id', true),
                    "sub_category_id" => $this->input->post('i_sub_category_id', true),
                    "category_type_id" => $this->input->post('i_category_type_id', true),
                    "alias_item_code" => $this->input->post('alias_code', true),
                    "alias_name" => $this->input->post('alias_name', true),
                    "minimum_sale_unit_value" => $this->input->post('item_value', true),
                    "minimum_sale_unit_id" => $this->input->post('item_unit_id', true),
                    "net_weight" => $this->input->post('net_weight', true),
                    "number_of_item_in_box" => $this->input->post('box_number_of_items', true),
                    "box_total_packed_weight" => $this->input->post('box_total_packed_weight', true),
                    "status" => $this->input->post('status', true) ? 1 : 0,
                    "created_date" => $date
                ];
                $is_updated =  $this->crud->update('item', $item_record,$where);
                $message = array('response' => 'error', 'message' => $is_updated);
                if($is_updated){
                    $message = array('response' => 'success', 'message' => 'Item updated');
                }else{
                    $message = array('response' => 'error', 'message' => 'Please Change something and Submit');
                }
            }
            echo json_encode($message);
        } else {
            redirect('login');
        }
    }
    // end of class
}
