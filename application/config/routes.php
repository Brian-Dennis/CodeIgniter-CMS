<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = 'admin/dashboard';
$route['users'] = 'admin/users';
$route['pages'] = 'admin/pages';
$route['subjects'] = 'admin/subjects';
