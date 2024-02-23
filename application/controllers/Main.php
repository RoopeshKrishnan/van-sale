<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function dashboard()
	{
		$data['page_title']='Dashboard';

		$this->load->view('include/header',$data);
		$this->load->view('dashboard');
		$this->load->view('include/footer');
	}

	public function user_creation()
	{
		$data['page_title']='User Creation';

		$this->load->view('include/header',$data);
		$this->load->view('user/user_creation');
		$this->load->view('include/footer');
	}

	public function all_user()
	{
		$this->load->view('include/header');
		$this->load->view('user/all_user');
		$this->load->view('include/footer');
	}

	public function customer_creation()
	{
		$this->load->view('include/header');
		$this->load->view('customer/customer_creation');
		$this->load->view('include/footer');
	}

	public function all_customer()
	{
		$this->load->view('include/header');
		$this->load->view('customer/all_customer');
		$this->load->view('include/footer');
	}

	public function add_area()
	{
		$this->load->view('include/header');
		$this->load->view('area/add_area');
		$this->load->view('include/footer');
	}

	public function add_driver()
	{
		$this->load->view('include/header');
		$this->load->view('driver/add_driver');
		$this->load->view('include/footer');
	}

	public function add_vehicle()
	{
		$this->load->view('include/header');
		$this->load->view('vehicle/add_vehicle');
		$this->load->view('include/footer');
	}

	public function add_item()
	{
		$this->load->view('include/header');
		$this->load->view('item/add_item');
		$this->load->view('include/footer');
	}

	public function all_item()
	{
		$this->load->view('include/header');
		$this->load->view('item/all_item');
		$this->load->view('include/footer');
	}

	public function all_price_list()
	{
		$this->load->view('include/header');
		$this->load->view('pricelist/all_price_list');
		$this->load->view('include/footer');
	}

	public function edit_price_list()
	{
		$this->load->view('include/header');
		$this->load->view('pricelist/edit_price_list');
		$this->load->view('include/footer');
	}

	public function stock_open()
	{
		$this->load->view('include/header');
		$this->load->view('stock/stock_open');
		$this->load->view('include/footer');
	}

	public function stock_id_add()
	{
		$this->load->view('include/header');
		$this->load->view('stock/stock_id_add');
		$this->load->view('include/footer');
	}

	public function stock_all_view()
	{
		$this->load->view('include/header');
		$this->load->view('stock/stock_all_view');
		$this->load->view('include/footer');
	}

	public function stock_close()
	{
		$this->load->view('include/header');
		$this->load->view('stock/stock_close');
		$this->load->view('include/footer');
	}

	public function stock_view()
	{
		$this->load->view('include/header');
		$this->load->view('stock/stock_view');
		$this->load->view('include/footer');
	}

	public function profile_view()
	{
		$this->load->view('include/header');
		$this->load->view('profile/profile_view');
		$this->load->view('include/footer');
	}

	public function profile_edit()
	{
		$this->load->view('include/header');
		$this->load->view('profile/profile_edit');
		$this->load->view('include/footer');
	}

	public function customer_order()
	{
		$this->load->view('include/header');
		$this->load->view('ordertakeing/customer_order');
		$this->load->view('include/footer');
	}

	public function all_customer_order()
	{
		$this->load->view('include/header');
		$this->load->view('ordertakeing/all_customer_order');
		$this->load->view('include/footer');
	}

	public function consolidate()
	{
		$this->load->view('include/header');
		$this->load->view('consolidate/consolidate');
		$this->load->view('include/footer');
	}

	public function consolidate_id_add()
	{
		$this->load->view('include/header');
		$this->load->view('consolidate/consolidate_id_add');
		$this->load->view('include/footer');
	}

	public function consolidate_stock_view()
	{
		$this->load->view('include/header');
		$this->load->view('consolidate/consolidate_stock_view');
		$this->load->view('include/footer');
	}
}
