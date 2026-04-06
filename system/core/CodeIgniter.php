<?php
require BASEPATH . 'core/BaseClasses.php';

$CFG = [];
$route = [];
$db = [];
$autoload = [];
$active_group = 'default';
$query_builder = true;

require APPPATH . 'config/config.php';
require APPPATH . 'config/routes.php';
require APPPATH . 'config/database.php';
require APPPATH . 'config/autoload.php';

$GLOBALS['CFG'] = $config ?? [];
$GLOBALS['ROUTES'] = $route ?? [];
$GLOBALS['DBCFG'] = $db[$active_group] ?? [];
$GLOBALS['AUTOLOAD'] = $autoload ?? [];

$CI = new CI_Super();
$GLOBALS['CI_INSTANCE'] = $CI;
$CI->bootstrap();
$CI->run();
