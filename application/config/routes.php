<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home/index";
$route['trang-chu'] = "home/home/index";
$route['san-pham'] = "home/product/list_product";
$route['san-pham/page/(:any)'] = "home/product/list_product";
$route['ref/(:any)'] = "home/home/index";

$route['san-pham/(:any)-(:any)'] = "home/product/detail/$1";
$route['san-pham/(:any)-(:any)/ref/(:any)'] = "home/product/detail/$1";

$route['p_c-(:any)-(:any)/p_p-(:any)-(:any)'] = "home/product/detail/$3";
$route['p_c-(:any)-(:any)'] = "home/product/list_product/$1";
$route['p_c-(:any)-(:any)/page/(:any)'] = "home/product/list_product/$1";
$route['cong-tac-vien'] = "ctv/productctv/index";
$route['cong-tac-vien/login'] = "ctv/homectv/login";
$route['cong-tac-vien/register'] = "home/home/register";
$route['404_override'] = '';
$route['hoi-dap']='home/product/faq_list';
$route['gioi-thieu']='home/home/about';
$route['gui-cau-hoi']='home/product/send_faq';
$route['tin-tuc']='home/news/list_news';
$route['tin-tuc-(:any)-(:any)']='home/news/detail/$1';
$route['hoi-dap-(:any)-(:any)'] = 'home/product/detail_faq/$1';
$route['active-user/(:any)/(:any)']='home/home/activate';
$route['lien-he'] = 'home/home/contact';
$route['quan-tri'] = "admin/login/index";
$route['quan-tri-vien'] = "admin/productadmin/index";
$route['quen-mat-khau'] = "ctv/homectv/reset_pass";
$route['active-pass/(:any)/(:any)'] = "ctv/homectv/active_pass";
/* End of file routes.php */
/* Location: ./application/config/routes.php */