<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
//$route['Client/(:any)'] = 'Client/index/$1';

$route['default_controller'] = 'Login';
$route['Invoice/Add/(:any)'] = 'Invoice/Add/$1';
$route['Client/grid'] = 'Client/index/grid';
$route['Client/list'] = 'Client/index/list';
$route['Client/View_page/(:any)/(:any)'] = 'Client/View_page/$1/$2';
$route['Product/grid'] = 'Product/index/grid';
$route['Product/list'] = 'Product/index/list';
$route['Archives/grid'] = 'Archives/index/grid';
$route['Archives/list'] = 'Archives/index/list';
$route['Vendor/grid'] = 'Vendor/index/grid';
$route['Vendor/list'] = 'Vendor/index/list';
$route['Expenses/grid'] = 'Expenses/index/grid';
$route['Expenses/list'] = 'Expenses/index/list';
$route['Invoice/grid'] = 'Invoice/index/grid';
$route['Invoice/list'] = 'Invoice/index/list';
$route['project/grid'] = 'project/index/grid';
$route['project/list'] = 'project/index/list';
$route['Task/InsertData'] = 'Task/InsertData/';
$route['Task/InsertData/(:any)'] = 'Task/InsertData/$1';
$route['Task/Add/(:any)'] = 'Task/Add/$1';
$route['Task/(:any)'] = 'Task/index/$1';
$route['Journals/grid'] = 'Journals/index/grid';
$route['Journals/list'] = 'Journals/index/list';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
