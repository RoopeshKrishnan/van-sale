<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'login_controller/index';
$route['login-check'] = 'login_controller/login';


$route['user_creation'] = 'main/user_creation';
$route['all_user'] = 'main/all_user';
$route['customer_creation'] = 'main/customer_creation';
$route['all_customer'] = 'main/all_customer';
$route['add_area'] = 'main/add_area';
$route['add_driver'] = 'main/add_driver';
$route['add_vehicle'] = 'main/add_vehicle';
$route['add_item'] = 'main/add_item';
$route['all_item'] = 'main/all_item';
$route['all_price_list'] = 'main/all_price_list';
$route['stock_open'] = 'main/stock_open';
$route['stock_id_add'] = 'main/stock_id_add';
$route['stock_all_view'] = 'main/stock_all_view';
$route['stock_close'] = 'main/stock_close';
$route['stock_view'] = 'main/stock_view';
$route['edit_price_list'] = 'main/edit_price_list';
$route['profile_view'] = 'main/profile_view';
$route['profile_edit'] = 'main/profile_edit';
$route['customer_order'] = 'main/customer_order';
$route['all_customer_order'] = 'main/all_customer_order';
$route['consolidate'] = 'main/consolidate';
$route['consolidate_id_add'] = 'main/consolidate_id_add';
$route['consolidate_stock_view'] = 'main/consolidate_stock_view';


$route['area'] = 'Admin/area/index';
$route['driver'] = 'Admin/driver/index';
$route['vehicle'] = 'Admin/vehicle/index';
$route['group'] = 'Admin/group/index';
$route['user-registration'] = 'Admin/user/index';
$route['All-users'] = 'Admin/user/all_user';
$route['All-user/edit/(:any)'] = 'Admin/user/edit_user/$1';
$route['customer-registration'] = 'Admin/customer/index';
$route['All-customers'] = 'Admin/customer/all_customers';
$route['All-customers/edit/(:any)'] = 'Admin/customer/edit_customer/$1';
$route['dashboard'] = 'login_controller/dashboard';

$route['category'] = 'Admin/category/index';
$route['sub-category'] = 'Admin/sub_category/index';
$route['Category-type'] = 'Admin/category_type/index';
$route['tax-type'] = 'Admin/tax_type/index';
$route['tax'] = 'Admin/tax/index';
$route['item'] = 'Admin/item/index';
$route['item-unit'] = 'Admin/item/item_unit';
$route['All-items'] = 'Admin/item/all_items';
$route['All-items/edit/(:any)'] = 'Admin/item/edit_item/$1';
$route['stock'] = 'Admin/stock/index';
$route['add-stock'] = 'Admin/stock/add_stock';
$route['all-stock'] = 'Admin/stock/all_stock';
$route['all-stock/edit/(:any)'] = 'Admin/stock/edit_stock/$1';
$route['all-stock/view/(:any)'] = 'Admin/stock/view_stock/$1';
$route['all-stock/close-stock/(:any)'] = 'Admin/stock/stock_close/$1';

$route['all-price-list'] = 'Admin/pricelist/index';
$route['edit-price-list'] = 'Admin/pricelist/edit_price_list';
$route['all-price-list/edit/(:any)'] = 'Admin/pricelist/edit/$1';
$route['order-taking'] = 'Admin/order/index';
$route['all-orders'] = 'Admin/order/all_orders';

$route['consolidate'] = 'Admin/consolidate/index';
$route['order-to-stock'] = 'Admin/consolidate/order_to_stock';
$route['all-converted-orders'] = 'Admin/stock/all_converted_orders';
$route['consolidated-stocks'] = 'Admin/stock/consolidated_stokes';
$route['consolidated-stocks/view/'] = 'Admin/stock/view_consolidated_stock';

$route['consolidated-stocks/view/(:any)/(:any)'] = 'Admin/stock/view_consolidated_stock/$1/$2';
$route['bill'] = 'Admin/bill/index';


$route['logout'] = 'login_controller/logout';
