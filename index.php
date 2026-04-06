<?php
session_start();
define('BASEPATH', __DIR__ . '/system/');
define('APPPATH', __DIR__ . '/application/');
define('FCPATH', __DIR__ . '/');
define('ENVIRONMENT', 'development');
require BASEPATH . 'core/Common.php';
require BASEPATH . 'core/CodeIgniter.php';
