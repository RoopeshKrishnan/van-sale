<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    // to load Area page
    public function index()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'stock_creation';
            $data['page_title'] = ' Area';
            $where = [
                'deleted' => 0,
                'status' => 1,
            ];
            $data['user'] =  $this->admin_model->stock_user()->result();
            $data['driver'] =  $this->crud->fetch_data_asc('driver', $where, 'driver_id')->result();
            $data['vehicle'] =  $this->crud->fetch_data_asc('vehicle', $where, 'vehicle_id')->result();

            $this->load->view('include/header', $data);
            $this->load->view('Admin/stock/stock_id_add', $data);
            $this->load->view('include/footer');
        }
    }

    public function create_stock_id()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                'stock_date',
                'date',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'user_id',
                'Executive',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'driver_id',
                'Driver',
                'trim|required'
            );
            $this->form_validation->set_rules(
                'vehicle_id',
                'Vehicle',
                'trim|required'
            );

            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
            } else {
                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                $date = date('Y-m-d H:i:s');

                $stock_record = [
                    "executive_id" => $this->input->post('user_id', true),
                    "driver_id" => $this->input->post('driver_id', true),
                    "vehicle_id" => $this->input->post('vehicle_id', true),
                    "stock_date" =>  $this->input->post('stock_date', true),
                    "status" => 1,
                    "created_date" => $date
                ];
                $inserted_stock_id =  $this->crud->insert('stock', $stock_record);
                if ($inserted_stock_id) {
                    $this->session->set_userdata('current_stock_id', $inserted_stock_id);
                    $message = array('response' => 'success');
                } else {
                    $message = array('response' => 'error', 'message' => 'Failed to add');
                }
            }
            echo json_encode($message);
        } else {
            redirect('login');
        }
    }

    public function add_stock()
    {
        if ((!$this->session->userdata('user_logged_in'))) {
            redirect('login');
        } else {
            $data['active'] = 'stock_add';
            $data['page_title'] = ' Add Stock';
            if ($this->session->userdata('current_stock_id')) {
                $stock_id = $this->session->userdata('current_stock_id');
                $data['fetch_stock'] =  $this->admin_model->fetch_stock($stock_id)->row();
                $where = [
                    'deleted' => 0,
                    'status' => 1,
                ];
                $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id')->result();
                $data['item'] =  $this->crud->fetch_data_asc('item', $where, 'item_id')->result();

                $this->load->view('include/header', $data);
                $this->load->view('Admin/stock/stock_open', $data);
                $this->load->view('include/footer');
            } else {
                redirect('login');
            }
        }
    }
    // fetch subcategory according to category
    public function fetch_sub_category()
    {
        $category_id = $this->input->post('category_id');
        $where = [
            'deleted' => 0,
            'status' => 1,
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
    public function fetch_category_type()
    {
        $sub_category_id = $this->input->post('sub_category_id');
        $category_id = $this->input->post('category_id');

        $where = [
            'deleted' => 0,
            'status' => 1,
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

    public function item_filter()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules(
                's_category_id',
                'Category',
                'trim|required'
            );
            if ($this->form_validation->run() == FALSE) {
                $message = array('response' => 'error', 'message' => validation_errors());
                echo json_encode($message);
            } else {
                $stock_id = $this->input->post('stock_id', true);
                $category_id = $this->input->post('s_category_id', true);
                $sub_category_id = $this->input->post('s_sub_category_id', true);
                $category_type_id = $this->input->post('s_category_type_id', true);
                $query =  $this->admin_model->filter_items($category_id, $sub_category_id, $category_type_id);
                // Initialize an empty string to store the HTML
                $sl_no = 0;
                $table_html = '';
                foreach ($query as $row) {
                    $sl_no++;
                    $table_html .= '
                <tr>
                    <td><p class="text-xs font-weight-bold mb-0">' . $sl_no . '</p></td>
                    <td><h6 class="mb-0 text-md">' . $row->item_name . '</h6></td>
                    <td>
                        <div class="input-group input-group-outline">
                            <label class="form-label">Add of stock</label>
                            <input type="number" name="number_of_stock[]" class="form-control">
                            <input type="hidden" name="item_id[]" value="' . $row->item_id . '">
                            <input type="hidden" name="stock_id[]" value="' . $stock_id . '">
                        </div>
                     </td>
                </tr>
                ';
                }

                $message = array('response' => 'success', 'message' => $table_html);
                echo json_encode($message);
                // echo json_encode($query);
            }
        } else {
            redirect('login');
        }
    }
    public function item_stock()
    {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Define validation rules for the form fields
            $this->form_validation->set_rules('number_of_stock[]', 'Stock Quantity', 'numeric');
            // Run form validation
            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
            } else {
                // Retrieve and process the data sent from the client-side
                $stock_quantities = $this->input->post('number_of_stock');
                $item_ids = $this->input->post('item_id');
                $stock_ids = $this->input->post('stock_id');

                // Check if all stock quantities are empty
                if (array_sum($stock_quantities) == 0) {
                    $response = array('success' => false, 'message' => 'All stock quantities are empty.');
                } else {
                    // Insert data into the database (you should implement your database logic here)
                    foreach ($stock_quantities as $key => $stock_quantity) {
                        $item_id = $item_ids[$key];
                        $item_net_weight =  $this->admin_model->item_net_weight($item_id)->row();
                        $net_weight = $item_net_weight->net_weight;
                        $stock_id = $stock_ids[$key];
                        if ($stock_quantity > 0) {

                            $item_stock_validation =  $this->admin_model->item_stock_validation($item_id, $stock_id);
                            if ($item_stock_validation == 0) {
                                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                                $date = date('Y-m-d H:i:s');
                                $record = [
                                    "stock_id" => $stock_id,
                                    "item_id" => $item_id,
                                    "number_of_stock" => $stock_quantity,
                                    "net_weight" => $net_weight * $stock_quantity,
                                    "created_date" => $date
                                ];
                                $check_insertion =  $this->crud->insert('add_stock_temp', $record);
                                if ($check_insertion) {
                                    $stock_temp_data =  $this->admin_model->stock_temp_data($stock_id)->result();
                                    $response = array('success' => true, 'message' => 'Data successfully inserted.', 'temp_data' => $stock_temp_data);
                                } else {
                                    $response = array('success' => true, 'message' => 'Data not inserted.');
                                }
                            } else {
                                $table = 'add_stock_temp';
                                $where = [
                                    'stock_id' => $stock_id,
                                    'item_id' => $item_id,
                                    'status' => 1
                                ];
                                $record = [
                                    "number_of_stock" => $stock_quantity,
                                    "net_weight" => $net_weight * $stock_quantity,
                                ];
                                // $update_result =  $this->crud->update($table, $record, $where);

                                // if ($update_result) {
                                //     $stock_temp_data =  $this->admin_model->stock_temp_data($stock_id)->result();
                                //     $response = array('success' => true, 'message' => 'Data successfully inserted.', 'temp_data' => $stock_temp_data, 'test' => $update_result);
                                // } else {
                                //     $response = array('success' => false, 'message' => 'Data not inserted.', 'test' => $update_result);
                                // }
                                $this->crud->update($table, $record, $where);
                                $stock_temp_data =  $this->admin_model->stock_temp_data($stock_id)->result();
                                $response = array('success' => true, 'message' => 'Data successfully updated.', 'temp_data' => $stock_temp_data);
                            }
                        }
                    }
                }
            }

            // Send a JSON response back to the client
            echo json_encode($response);
        }
    }
    // delete temp stock data
    public function delete_temp_stock_data()
    {
        $del_id = $this->input->post('delete_id');
        $table = 'add_stock_temp';
        $where = [
            'add_stock_temp_id' => $del_id
        ];
        $record = [
            'status' => 0
        ];
        $delete_result =  $this->crud->update($table, $record, $where);
        if ($delete_result) {
            $message = array('response' => 'success', 'message' => 'Sub Category Deleted');
        } else {
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        echo json_encode($message);
    }

    public function stock_confirmation()
    {
        if ($this->session->userdata('current_consolidate_cstock_id')) {
            $this->session->unset_userdata('current_consolidate_cstock_id');
        }
        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        $date = date('Y-m-d H:i:s');
        $stock_data_confirmation =  $this->admin_model->stock_data_confirmation()->result();
        $insert_success = true;
        $total_net_weight = 0;
        foreach ($stock_data_confirmation as $row) {
            $stock_record = [
                'stock_id' => $row->stock_id,
                'item_id' => $row->item_id,
                'number_of_stock' => $row->number_of_stock,
                'net_weight' => $row->net_weight,
                "created_date" => $date,
                'status' => 1,
            ];
            $check_insertion =  $this->crud->insert('add_stock', $stock_record);
            if (!$check_insertion) {
                $insert_success = false;
                break;
            }
            $total_net_weight = $total_net_weight + $row->net_weight;
            $current_stock_id = $row->stock_id;
        }
        if ($insert_success) {
            $truncate_temp_table = $this->admin_model->truncateTable('add_stock_temp');

            if ($truncate_temp_table) {

                $update_record = [
                    'stock_total_net_weight' => $total_net_weight
                ];
                $where = [
                    'stock_id' => $current_stock_id
                ];
                $this->crud->update('stock', $update_record, $where);

                // Send a JSON response indicating success and truncation
                $message = array('response' => 'success', 'message' => 'Stock Added');
            } else {
                // Send a JSON response indicating success but truncation failure
                $message = array('response' => 'error', 'message' => 'something went wrong ');
            }
        } else {
            // Send a JSON response indicating failure
            $message = array('response' => 'error', 'message' => 'Stock Failed to Add');
        }
        echo json_encode($message);
        // $message = array('response' => 'error', 'message' => $stock_data_confirmation);
        // echo json_encode($message);
    }

    public function all_stock()
    {
        $data['active'] = 'all_stock';
        $data['page_title'] = ' All Stock';

        $data['all_stock'] =  $this->admin_model->all_stock();
        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/stock_all_view', $data);
        $this->load->view('include/footer');
    }
    public function edit_stock($stock_id)
    {
        $data['page_title'] = ' Stock edit';
        $data['active'] = 'all_stock';

        $where = [
            'deleted' => 0,
            'status' => 1
        ];
        $data['stock'] =  $this->admin_model->fetch_stock_by_id($stock_id)->row();
        $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id ')->result();
        $data['stock_item_data'] =  $this->admin_model->stock_item_data($stock_id)->result();

        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/stock_edit', $data);
        $this->load->view('include/footer');
    }
    public function view_stock($stock_id)
    {
        $data['page_title'] = ' Stock edit';
        $data['active'] = 'all_stock';

        $where = [
            'deleted' => 0,
            'status' => 1
        ];

        $where1 = [
            'deleted' => 0,
            'status' => 1,
            'stock_id' > $stock_id
        ];
        $data['stock'] =  $this->admin_model->fetch_stock_by_id($stock_id)->row();
        $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id ')->result();
        $data['stock_item_data'] =  $this->admin_model->stock_item_data($stock_id)->result();

        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/stock_view', $data);
        $this->load->view('include/footer');
    }
    //update item stock
    public function update_item_stock()
    {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Define validation rules for the form fields
            $this->form_validation->set_rules('number_of_stock[]', 'Stock Quantity', 'numeric');
            // Run form validation
            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
            } else {

                // Retrieve and process the data sent from the client-side
                $stock_quantities = $this->input->post('number_of_stock');
                $add_stock_ids = $this->input->post('add_stock_id');
                // Check if all stock quantities are empty
                if (array_sum($stock_quantities) == 0) {
                    $response = array('success' => false, 'message' => 'All stock quantities are empty.');
                } else {
                    // Insert data into the database (you should implement your database logic here)
                    foreach ($stock_quantities as $key => $stock_quantity) {
                        $add_stock_id = $add_stock_ids[$key];
                        $where = [
                            'add_stock_id' => $add_stock_id
                        ];
                        if ($stock_quantity > 0) {
                            date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                            $date = date('Y-m-d H:i:s');
                            $record = [
                                "number_of_stock" => $stock_quantity,
                            ];
                            $is_updated =  $this->crud->update('add_stock', $record, $where);
                        }
                    }
                    if ($is_updated) {
                        $message = array('response' => 'success', 'message' => 'Stock updated');
                    } else {
                        $message = array('response' => 'error', 'message' => 'Please Change something and Submit');
                    }
                }
            }
            // Send a JSON response back to the client
            echo json_encode($message);
        }
    }
    //load close stock view page
    public function stock_close($stock_id)
    {
        $data['active'] = 'all_stock';
        $data['page_title'] = ' All Stock';

        $where = [
            'deleted' => 0,
            'status' => 1
        ];

        $where1 = [
            'deleted' => 0,
            'status' => 1,
            'stock_id' > $stock_id
        ];
        $data['stock'] =  $this->admin_model->fetch_stock_by_id($stock_id)->row();
        $data['category'] =  $this->crud->fetch_data_asc('category', $where, 'category_id ')->result();
        $data['stock_item_data'] =  $this->admin_model->stock_item_data($stock_id)->result();
        // $data['all_stock'] =  $this->admin_model->all_stock();
        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/stock_close', $data);
        $this->load->view('include/footer');
    }

    public function item_close_stock()
    {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Define validation rules for the form fields
            $this->form_validation->set_rules('close_stock_input[]', 'Close Stock Quantity', 'numeric');
            // Run form validation
            if ($this->form_validation->run() === FALSE) {
                $response = array('success' => false, 'message' => validation_errors());
            } else {
                // Retrieve and process the data sent from the client-side
                $stock_close_quantities = $this->input->post('close_stock_input');
                $item_ids = $this->input->post('item_id');
                $stock_ids = $this->input->post('stock_id');

                // Check if all stock quantities are empty
                if (array_sum($stock_close_quantities) == 0) {
                    $response = array('success' => false, 'message' => 'All stock close quantities are empty.');
                } else {
                    // Insert data into the database (you should implement your database logic here)
                    foreach ($stock_close_quantities as $key => $stock_close_quantity) {
                        $item_id = $item_ids[$key];

                        $stock_id = $stock_ids[$key];
                        $item_no_stock =  $this->admin_model->item_no_stock($item_id, $stock_id)->row();
                        $no_stock = $item_no_stock->number_of_stock;
                        if ($stock_close_quantity > 0) {
                            date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                            $date = date('Y-m-d H:i:s');
                            $record = [
                                "stock_id" => $stock_id,
                                "item_id" => $item_id,
                                "number_of_stock" => $no_stock,
                                "close_stock" => $stock_close_quantity,
                                "balance_stock" => $no_stock - $stock_close_quantity,
                                "status" => 1,
                                "created_date" => $date
                            ];
                            $check_insertion =  $this->crud->insert('close_stock_temp', $record);
                            if ($check_insertion) {
                                $stock_close_temp_data =  $this->admin_model->stock_close_temp_data($stock_id)->result();
                                $response = array('success' => true, 'message' => 'Data successfully inserted.', 'temp_data' => $stock_close_temp_data);
                                // $response = array('success' => true, 'message' => 'Data successfully inserted.');

                            } else {
                                $response = array('false' => true, 'message' => 'Data not inserted.');
                            }
                        }
                    }
                }
            }

            // Send a JSON response back to the client
            echo json_encode($response);
        }
    }

    public function delete_temp_close_stock_data()
    {
        $del_id = $this->input->post('delete_id');
        $table = 'close_stock_temp';
        $where = [
            'close_stock_temp_id' => $del_id
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

    public function close_stock_confirmation()
    {
        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
        $date = date('Y-m-d H:i:s');
        $close_stock_data_confirmation =  $this->admin_model->close_stock_data_confirmation()->result();
        $insert_success = true;
        foreach ($close_stock_data_confirmation as $row) {
            $close_stock_record = [
                'stock_id' => $row->stock_id,
                'item_id' => $row->item_id,
                'number_of_stock' => $row->number_of_stock,
                'close_stock' => $row->close_stock,
                'balance_stock' => $row->balance_stock,
                "created_date" => $date,
                'status' => 1,
            ];
            $check_insertion =  $this->crud->insert('close_stock', $close_stock_record);
            if (!$check_insertion) {
                $insert_success = false;
                break;
            }
        }
        if ($insert_success) {
            $truncate_temp_table = $this->admin_model->truncateTable('close_stock_temp');

            if ($truncate_temp_table) {

                // Send a JSON response indicating success and truncation
                $message = array('response' => 'success', 'message' => 'Close Stock Added');
            } else {
                // Send a JSON response indicating success but truncation failure
                $message = array('response' => 'error', 'message' => 'something went wrong ');
            }
        } else {
            // Send a JSON response indicating failure
            $message = array('response' => 'error', 'message' => 'Close Stock Failed to Add');
        }
        echo json_encode($message);
        // $message = array('response' => 'error', 'message' => $stock_data_confirmation);
        // echo json_encode($message);
    }

    public function consolidated_stokes()
    {
        $data['active'] = 'all_consolidated_stock';
        $data['page_title'] = ' All Consolidated Stock';

        $data['all_consolidated_orders'] =  $this->admin_model->all_consolidated_orders();
        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/consolidated_stock', $data);
        $this->load->view('include/footer');
    }


    public function view_consolidated_stock($consolidate_orders_id, $area)
    {
        $data['active'] = 'all_consolidated_stock';
        $data['page_title'] = ' All Consolidated Stock';
        $where = [
            'deleted' => 0,
            'status' => 1,
        ];
        $data['area_name'] = $area;
        $consolidate_orders_id_get = $consolidate_orders_id;
        $data['user'] =  $this->admin_model->stock_user()->result();
        $data['driver'] =  $this->crud->fetch_data_asc('driver', $where, 'driver_id')->result();
        $data['vehicle'] =  $this->crud->fetch_data_asc('vehicle', $where, 'vehicle_id')->result();
        $items =  $this->crud->fetch_data_asc('item', $where, 'item_id')->result();
        $item_rows = '';

        $i = 0;
        foreach ($items as $row) {
            $i++;
            $item_id = $row->item_id;

            $total_order_count =  $this->admin_model->fetch_consolidated_item_order_count_by_item_id($consolidate_orders_id_get, $item_id)->row();
            // var_dump($total_order_count);
            // die();
            // Create HTML for each item
            $item_rows .= '<input type="hidden" name="item_ids[]"  value="' . $item_id . '">';
            $item_rows .= '<tr>';
            $item_rows .= '<td><p class="text-xs font-weight-bold mb-0">' . $i . '</p></td>';
            $item_rows .= '<td><h6 class="mb-0 text-md">' . $row->item_name . '</h6></td>';
            $item_rows .= '<td><h6 class="mb-0 text-md">' . $total_order_count->total_item_count . '</h6><p class="text-xs text-secondary mb-0">unit</p></td>';
            $item_rows .= '<td id="extra_stock' . $i . '"><h6 class="mb-0 text-md">0</h6><p class="text-xs text-secondary mb-0">unit</p></td>';
            $item_rows .= '<td id="total_count' . $i . '"><h6 class="mb-0 text-md">' . $total_order_count->total_item_count . '</h6><p class="text-xs text-secondary mb-0">unit</p></td>';
            $item_rows .= '<td>';

            $item_rows .= '<a class="mx-3 add-item-btn" type="button" data-bs-toggle="modal" data-bs-target="#add-item-stock" data-bs-original-title="Edit item stock" data-item-name="' . $row->item_name . '" data-item-stock="' . $total_order_count->total_item_count . '" data-item-index="' . $i . '">';
            $item_rows .= '<i class="material-icons text-success position-relative text-lg font-weight-bold">add</i></a>';
            $item_rows .= '<a href="javascript:;" id="delete_consolidate_item" value="' . $row->item_id . '"  data-bs-toggle="tooltip" data-bs-original-title="Delete item stock">';
            $item_rows .= '<i class="material-icons text-danger position-relative text-lg">delete</i></a>';
            $item_rows .= '</td>';
            $item_rows .= '</tr>';
        }
        $item_rows .= '</tbody>';

        //     $item_rows .= ' <tfoot>
        //     <tr>
        //         <td>

        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">Total</h6>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //         <td>
        //             <h6 class="mb-0 text-md">000</h6>
        //             <p class="text-xs text-secondary mb-0">unit</p>
        //         </td>
        //     </tr>
        // </tfoot>';

        $data['item_rows'] = $item_rows;

        $this->load->view('include/header', $data);
        $this->load->view('Admin/stock/consolidate_id_add', $data);
        $this->load->view('include/footer');
    }

    public function consolidate_to_vanstock()
    {

        if ($this->input->is_ajax_request()) {


            $serializedData = $this->input->post('serialized_data');
            // Access additional data
            $additionalData = $this->input->post('additional_data');
            $totalCounts = $additionalData['total_counts'];
            // Access driver_id from $serializedData
            parse_str($serializedData, $serializedArray);
            $insert_success = true;
            $total_net_weight = 0;

            if ($this->session->userdata('current_consolidate_cstock_id')) {

                $item_ids =  $serializedArray['item_ids'];
                for ($i = 0; $i < count($item_ids); $i++) {
                    if (isset($totalCounts[$i]) && $totalCounts[$i] > 0) {
                        $item_id = $item_ids[$i];
                        $item_net_weight =  $this->admin_model->item_net_weight($item_id)->row();
                        $net_weight = $item_net_weight->net_weight;

                        date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                        $date = date('Y-m-d H:i:s');

                        $item_stock_validation =  $this->admin_model->item_stock_validation($item_id, $this->session->userdata('current_consolidate_cstock_id'));
                        if ($item_stock_validation == 0) {

                            $record = [
                                "stock_id" => $this->session->userdata('current_consolidate_cstock_id'),
                                "item_id" => $item_id,
                                "number_of_stock" => $totalCounts[$i],
                                "net_weight" => $net_weight * $totalCounts[$i],
                                "created_date" => $date
                            ];
                            $this->crud->insert('add_stock_temp', $record);
                        } else {

                            $table = 'add_stock_temp';
                            $where = [
                                'stock_id' => $this->session->userdata('current_consolidate_cstock_id'),
                                'item_id' => $item_id,
                                'status' => 1
                            ];
                            $record = [
                                "number_of_stock" => $totalCounts[$i],
                                "net_weight" => $net_weight * $totalCounts[$i],
                            ];

                            $this->crud->update($table, $record, $where);
                        }
                    }
                }

                $stock_temp_data =  $this->admin_model->stock_temp_data($this->session->userdata('current_consolidate_cstock_id'))->result();
                $response = array('success' => true, 'message' => 'Data successfully updated.', 'temp_data' => $stock_temp_data);
            } else {

                if (!empty($serializedArray['user_id']) && !empty($serializedArray['consolidate_stock_date']) && !empty($serializedArray['driver_id']) && !empty($serializedArray['vehicle_id'])) {
                    date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                    $date = date('Y-m-d H:i:s');

                    $cstock_record = [
                        "executive_id" => $serializedArray['user_id'],
                        "driver_id" => $serializedArray['driver_id'],
                        "vehicle_id" => $serializedArray['vehicle_id'],
                        "stock_date" => $serializedArray['consolidate_stock_date'],
                        "status" => 1,
                        "created_date" => $date
                    ];
                    $inserted_cstock_id =  $this->crud->insert('stock', $cstock_record);
                    $this->session->set_userdata('current_consolidate_cstock_id', $inserted_cstock_id);
                    if ($inserted_cstock_id) {

                        $item_ids =  $serializedArray['item_ids'];
                        // Loop through item IDs and insert data into the stock table
                        for ($i = 0; $i < count($item_ids); $i++) {
                            if (isset($totalCounts[$i]) && $totalCounts[$i] > 0) {
                                $item_id = $item_ids[$i];
                                $item_net_weight =  $this->admin_model->item_net_weight($item_id)->row();
                                $net_weight = $item_net_weight->net_weight;

                                date_default_timezone_set('Asia/Kolkata'); # add your city to set local time zone
                                $date = date('Y-m-d H:i:s');
                                $record = [
                                    "stock_id" => $inserted_cstock_id,
                                    "item_id" => $item_id,
                                    "number_of_stock" => $totalCounts[$i],
                                    "net_weight" => $net_weight * $totalCounts[$i],
                                    "created_date" => $date,
                                    'status' => 1,

                                ];
                                $check_insertion =  $this->crud->insert('add_stock_temp', $record);
                                if (!$check_insertion) {
                                    $insert_success = false;
                                    break;
                                }
                            }
                        }
                        if ($insert_success) {
                            $stock_temp_data =  $this->admin_model->stock_temp_data($inserted_cstock_id)->result();
                            $response = array('success' => true, 'message' => 'Data successfully inserted.', 'temp_data' => $stock_temp_data);
                        } else {
                            $response = array('success' => false, 'message' => 'something went wrong');
                        }
                    } else {
                        $response = array('success' => false, 'message' => 'Failed to add');
                    }
                } else {
                    $response = array('success' => false, 'message' => 'Please fill everything');
                }
            }
            echo json_encode($response);
        }
        //end of function


    }


    public function delete_consolidate_temp_stock_data()
    {
        if ($this->session->userdata('current_consolidate_cstock_id')) {

        }else{
            $message = array('response' => 'error', 'message' => 'Failed ');
        }
        // $del_id = $this->input->post('delete_id');
        // $table = 'add_stock_temp';
        // $where = [
        //     'add_stock_temp_id' => $del_id
        // ];
        // $record = [
        //     'status' => 0
        // ];
        // $delete_result =  $this->crud->update($table, $record, $where);
        // if ($delete_result) {
        //     $message = array('response' => 'success', 'message' => 'Sub Category Deleted');
        // } else {
        //     $message = array('response' => 'error', 'message' => 'Failed ');
        // }
        // echo json_encode($message);
    }
    // end of class
}
