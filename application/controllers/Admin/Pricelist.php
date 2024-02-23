<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pricelist extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'all_price_list';
            $data['page_title'] = ' Price List';

            $data['item_with_pricelist'] =  $this->admin_model->fetch_item_with_pricelist();

            $this->load->view('include/header', $data);
            $this->load->view('Admin/pricelist/all_price_list', $data);
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

    public function edit_price_list()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'all_price_list';
            $data['page_title'] = ' Price List';
            $where = [
                'deleted' => 0,
                'status' => 1,
            ];
            $where1 = [
                'deleted' => 0
            ];
            // $data['item'] =  $this->crud->fetch_data_asc('item', $where, 'item_id')->result();
            $data['item'] = $this->admin_model->item_with_tax()->result();
            $data['pricelist_names'] =  $this->crud->fetch_data_asc('price_list_name', $where1, 'price_list_name_id')->result();

            $this->load->view('include/header', $data);
            $this->load->view('Admin/pricelist/edit_price_list', $data);
            $this->load->view('include/footer');
        }
    }

    public function add_price_list()
    {
        parse_str($this->input->post('formData'), $formData);


        for ($i = 0; $i < 10; $i++) {
            // Check if the key exists before accessing it
            // Get the status and alias name from the form data


            $newStatus = (isset($formData['pricelist_status'][$i])) ? 1 : 0;
            $newAliasName = $formData['price_list_alias_names'][$i];
            $newPricelistTax = (isset($formData['pricelist_taxes'][$i])) ? 1 : 0;

            // Get the primary key ID of the pricelist_names item from the form data
            $pricelist_name_id = $formData['pricelist_name_ids'][$i];

            // Define the data to be updated
            $data = array(
                'status' => $newStatus,
                'pricelist_alias_name' => $newAliasName,
                'tax_included' => $newPricelistTax
            );

            // Update the 'pricelist_names' table
            $this->db->where('price_list_name_id', $pricelist_name_id);
            $this->db->update('price_list_name', $data);
        }




        if (isset($formData['item_id'])) {
            // Loop through item_ids
            $item_ids = $formData['item_id'];

            // echo json_encode($item_ids);

            for ($i = 0; $i < count($item_ids); $i++) {
                $item_id = $item_ids[$i];

                $pricelist_update_or_insert =  $this->admin_model->pricelist_update_or_insert($item_id);
                $find_item_tax =  $this->admin_model->find_item_tax($item_id);
                $item_tax = $find_item_tax->tax;
                if ($pricelist_update_or_insert == 0) {

                    // Check if all price_list fields are empty for the current item
                    $allPriceListFieldsEmpty = empty($formData["price_list_a"][$i]) &&
                        empty($formData["price_list_b"][$i]) &&
                        empty($formData["price_list_c"][$i]) &&
                        empty($formData["price_list_d"][$i]) &&
                        empty($formData["price_list_e"][$i]) &&
                        empty($formData["price_list_f"][$i]) &&
                        empty($formData["price_list_g"][$i]) &&
                        empty($formData["price_list_h"][$i]) &&
                        empty($formData["price_list_i"][$i]) &&
                        empty($formData["price_list_j"][$i]);

                        if(!empty($formData['price_list_a'][$i])){
                            $pricelist_id = 1;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_a'][$i];
                                $tax = $item_tax;
                                $pricelist_a_tax_included_rate = $formData['price_list_a'][$i];
                                $pricelist_a_tax_excluded_rate = number_format($price/(100+$tax)*100,4) ;
                            }else{
                                $price = $formData['price_list_a'][$i];
                                $tax = $item_tax;
                                $pricelist_a_tax_included_rate =number_format($price*(100+$tax)/100,4) ;
                                $pricelist_a_tax_excluded_rate = $formData['price_list_a'][$i];
                            }

                        }else{
                            $pricelist_a_tax_included_rate = '';
                            $pricelist_a_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_b'][$i])){
                            $pricelist_id = 2;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_b'][$i];
                                $tax = $item_tax;
                                $pricelist_b_tax_included_rate = $formData['price_list_b'][$i];
                                $pricelist_b_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_b'][$i];
                                $tax = $item_tax;
                                $pricelist_b_tax_included_rate =number_format($price*(100+$tax)/100,4) ;
                                $pricelist_b_tax_excluded_rate = $formData['price_list_b'][$i];
                            }

                        }else{
                            $pricelist_b_tax_included_rate = '';
                            $pricelist_b_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_c'][$i])){
                            $pricelist_id = 3;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_c'][$i];
                                $tax = $item_tax;
                                $pricelist_c_tax_included_rate = $formData['price_list_c'][$i];
                                $pricelist_c_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_c'][$i];
                                $tax = $item_tax;
                                $pricelist_c_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_c_tax_excluded_rate = $formData['price_list_c'][$i];
                            }

                        }else{
                            $pricelist_c_tax_included_rate = '';
                            $pricelist_c_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_d'][$i])){
                            $pricelist_id = 4;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_d'][$i];
                                $tax = $item_tax;
                                $pricelist_d_tax_included_rate = $formData['price_list_d'][$i];
                                $pricelist_d_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_d'][$i];
                                $tax = $item_tax;
                                $pricelist_d_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_d_tax_excluded_rate = $formData['price_list_d'][$i];
                            }

                        }else{
                            $pricelist_d_tax_included_rate = '';
                            $pricelist_d_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_e'][$i])){
                            $pricelist_id = 5;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_e'][$i];
                                $tax = $item_tax;
                                $pricelist_e_tax_included_rate = $formData['price_list_e'][$i];
                                $pricelist_e_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_e'][$i];
                                $tax = $item_tax;
                                $pricelist_e_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_e_tax_excluded_rate = $formData['price_list_e'][$i];
                            }

                        }else{
                            $pricelist_e_tax_included_rate = '';
                            $pricelist_e_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_f'][$i])){
                            $pricelist_id = 6;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_f'][$i];
                                $tax = $item_tax;
                                $pricelist_f_tax_included_rate = $formData['price_list_f'][$i];
                                $pricelist_f_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_f'][$i];
                                $tax = $item_tax;
                                $pricelist_f_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_f_tax_excluded_rate = $formData['price_list_f'][$i];
                            }

                        }else{
                            $pricelist_f_tax_included_rate = '';
                            $pricelist_f_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_g'][$i])){
                            $pricelist_id = 7;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_g'][$i];
                                $tax = $item_tax;
                                $pricelist_g_tax_included_rate = $formData['price_list_g'][$i];
                                $pricelist_g_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_g'][$i];
                                $tax = $item_tax;
                                $pricelist_g_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_g_tax_excluded_rate = $formData['price_list_g'][$i];
                            }

                        }else{
                            $pricelist_g_tax_included_rate = '';
                            $pricelist_g_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_h'][$i])){
                            $pricelist_id = 8;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_h'][$i];
                                $tax = $item_tax;
                                $pricelist_h_tax_included_rate = $formData['price_list_h'][$i];
                                $pricelist_h_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_h'][$i];
                                $tax = $item_tax;
                                $pricelist_h_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_h_tax_excluded_rate = $formData['price_list_h'][$i];
                            }

                        }else{
                            $pricelist_h_tax_included_rate = '';
                            $pricelist_h_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_i'][$i])){
                            $pricelist_id = 9;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_i'][$i];
                                $tax = $item_tax;
                                $pricelist_i_tax_included_rate = $formData['price_list_i'][$i];
                                $pricelist_i_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_i'][$i];
                                $tax = $item_tax;
                                $pricelist_i_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_i_tax_excluded_rate = $formData['price_list_i'][$i];
                            }

                        }else{
                            $pricelist_i_tax_included_rate = '';
                            $pricelist_i_tax_excluded_rate = '';
                        }

                        if(!empty($formData['price_list_j'][$i])){
                            $pricelist_id = 10;
                            $price_list_tax =  $this->admin_model->find_price_list_tax($pricelist_id);
                            $pricelist_have_tax = $price_list_tax->tax_included;
                            if($pricelist_have_tax == 1){
                                $price = $formData['price_list_j'][$i];
                                $tax = $item_tax;
                                $pricelist_j_tax_included_rate = $formData['price_list_j'][$i];
                                $pricelist_j_tax_excluded_rate = round($price/(100+$tax)*100) ;
                            }else{
                                $price = $formData['price_list_j'][$i];
                                $tax = $item_tax;
                                $pricelist_j_tax_included_rate = $price*(100+$tax)/100 ;
                                $pricelist_j_tax_excluded_rate = $formData['price_list_j'][$i];
                            }

                        }else{
                            $pricelist_j_tax_included_rate = '';
                            $pricelist_j_tax_excluded_rate = '';
                        }


                    // If all price_list fields are empty, skip inserting the record
                    if (!$allPriceListFieldsEmpty) {

                        $record = [
                            'item_id' => $item_id,
                            'pricelist_a_id' => 1,
                            'pricelist_a_amount' => $formData["price_list_a"][$i],
                            'price_list_a_tax_included' => $pricelist_a_tax_included_rate,
                            'price_list_a_tax_excluded' => $pricelist_a_tax_excluded_rate,


                            'pricelist_b_id' => 2,
                            'pricelist_b_amount' => $formData["price_list_b"][$i],
                            'price_list_b_tax_included' => $pricelist_b_tax_included_rate,
                            'price_list_b_tax_excluded' => $pricelist_b_tax_excluded_rate,

                            'pricelist_c_id' => 3,
                            'pricelist_c_amount' => $formData["price_list_c"][$i],
                            'price_list_c_tax_included' => $pricelist_c_tax_included_rate,
                            'price_list_c_tax_excluded' => $pricelist_c_tax_excluded_rate,


                            'pricelist_d_id' => 4,
                            'pricelist_d_amount' => $formData["price_list_d"][$i],
                            'price_list_d_tax_included' => $pricelist_d_tax_included_rate,
                            'price_list_d_tax_excluded' => $pricelist_d_tax_excluded_rate,


                            'pricelist_e_id' => 5,
                            'pricelist_e_amount' => $formData["price_list_e"][$i],
                            'price_list_e_tax_included' => $pricelist_e_tax_included_rate,
                            'price_list_e_tax_excluded' => $pricelist_e_tax_excluded_rate,

                            'pricelist_f_id' => 6,
                            'pricelist_f_amount' => $formData["price_list_f"][$i],
                            'price_list_f_tax_included' => $pricelist_f_tax_included_rate,
                            'price_list_f_tax_excluded' => $pricelist_f_tax_excluded_rate,

                            'pricelist_g_id' => 7,
                            'pricelist_g_amount' => $formData["price_list_g"][$i],
                            'price_list_g_tax_included' => $pricelist_g_tax_included_rate,
                            'price_list_g_tax_excluded' => $pricelist_g_tax_excluded_rate,


                            'pricelist_h_id' => 8,
                            'pricelist_h_amount' => $formData["price_list_h"][$i],
                            'price_list_h_tax_included' => $pricelist_h_tax_included_rate,
                            'price_list_h_tax_excluded' => $pricelist_h_tax_excluded_rate,


                            'pricelist_i_id' => 9,
                            'pricelist_i_amount' => $formData["price_list_i"][$i],
                            'price_list_i_tax_included' => $pricelist_i_tax_included_rate,
                            'price_list_i_tax_excluded' => $pricelist_i_tax_excluded_rate,

                            'pricelist_j_id' => 10,
                            'pricelist_j_amount' => $formData["price_list_j"][$i],
                            'price_list_j_tax_included' => $pricelist_j_tax_included_rate,
                            'price_list_j_tax_excluded' => $pricelist_j_tax_excluded_rate,
                        ];
                        $this->crud->insert('pricelist_item', $record);
                    }
                }else{
                    $where = [
                        'item_id' => $item_id
                    ];
                    $record = [
                        'pricelist_a_amount' => $formData["price_list_a"][$i],
                        'pricelist_b_amount' => $formData["price_list_b"][$i],
                        'pricelist_c_amount' => $formData["price_list_c"][$i],
                        'pricelist_d_amount' => $formData["price_list_d"][$i],
                        'pricelist_e_amount' => $formData["price_list_e"][$i],
                        'pricelist_f_amount' => $formData["price_list_f"][$i],
                        'pricelist_g_amount' => $formData["price_list_g"][$i],
                        'pricelist_h_amount' => $formData["price_list_h"][$i],
                        'pricelist_i_amount' => $formData["price_list_i"][$i],
                        'pricelist_j_amount' => $formData["price_list_j"][$i],
                    ];

                 $this->crud->update('pricelist_item',$record,$where);

                }
            }
            // $this->crud->insert('pricelist_item', $record);
            // echo json_encode($item_id);

        } else {
            // Handle the case where 'item_id' doesn't exist in formData
            // You might want to log an error or take appropriate action.
        }
    }

    // end of class
}
