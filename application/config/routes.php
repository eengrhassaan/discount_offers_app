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
|	http://codeigniter.com/user_guide/general/routing.html
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


$route['auth/login']['post']           = 'auth/login';
$route['auth/logout']['post']          = 'auth/logout';
$route['book']['get']          	       = 'book';
$route['book/detail/(:num)']['get']    = 'book/detail/$1';
$route['book/create']['post']   	   = 'book/create';
$route['book/update/(:num)']['put']    = 'book/update/$1';
$route['book/delete/(:num)']['delete'] = 'book/delete/$1';

// Campus Controller Route
$route['campus']['get']          	       = 'campus';
$route['campus/detail/(:num)']['get']    = 'campus/detail/$1';
$route['campus/create']['post']   	   = 'campus/create';
$route['campus/update/(:num)']['put']    = 'campus/update/$1';
$route['campus/delete/(:num)']['delete'] = 'campus/delete/$1';

// Category Controller Route
$route['category']['get']          	       = 'category';
$route['category/detail/(:num)']['get']    = 'category/detail/$1';
$route['category/create']['post']   	   = 'category/create';
$route['category/update/(:num)']['put']    = 'category/update/$1';
$route['category/delete/(:num)']['delete'] = 'category/delete/$1';

// Coorporate Controller Route
$route['coorporate']['get']          	       = 'coorporate';
$route['coorporate/detail/(:num)']['get']    = 'coorporate/detail/$1';
$route['coorporate/create']['post']   	   = 'coorporate/create';
$route['coorporate/update/(:num)']['put']    = 'coorporate/update/$1';
$route['coorporate/delete/(:num)']['delete'] = 'coorporate/delete/$1';

// DiscountOffers Controller Route
$route['discountoffers']['get']          	       = 'discountoffers';
$route['discountoffers/detail/(:num)']['get']    = 'discountoffers/detail/$1';
$route['discountoffers/create']['post']   	   = 'discountoffers/create';
$route['discountoffers/update/(:num)']['put']    = 'discountoffers/update/$1';
$route['discountoffers/delete/(:num)']['delete'] = 'discountoffers/delete/$1';

//ImgOffers
$route['imgoffers']['get']          	       = 'imgoffers';
$route['imgoffers/detail/(:num)']['get']    = 'imgoffers/detail/$1';
$route['imgoffers/create']['post']   	   = 'imgoffers/create';
$route['imgoffers/update/(:num)']['put']    = 'imgoffers/update/$1';
$route['imgoffers/delete/(:num)']['delete'] = 'imgoffers/delete/$1';


//Users
$route['users']['get']          	       = 'users';
$route['users/detail/(:num)']['get']    = 'users/detail/$1';
$route['users/create']['post']   	   = 'users/create';
$route['users/update/(:num)']['put']    = 'users/update/$1';
$route['users/delete/(:num)']['delete'] = 'users/delete/$1';


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
