<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['post'] = 'post/index';
// $route['social/message_board'] = 'social/message_board';
// $route['social'] = 'social/index';
// $route['user/profile'] = 'user/profile';
// $route['user/preference'] = 'user/preference';
// $route['user/upload_img'] = 'user/upload_img';
// $route['user/set_preference'] = 'user/set_preferences';
// $route['user/login'] = 'user/login';
// $route['user/logout'] = 'user/logout';
// $route['user/register'] = 'user/register';
// $route['user/(:any)'] = 'user/view/$1';
$route['default_controller'] = 'user';
// $route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
