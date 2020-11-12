<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 0);

require 'config.php';
require './libs/Bootstrap.php';
require './libs/Controller.php';
require './libs/Model.php';
require './libs/View.php';

// ===========================
require './libs/Database.php';
require './libs/Validation.php';
require './libs/Upload.php';
require './libs/Helper.php';
require './libs/Session.php';
require './libs/Mail.php';

$bootstrap = new Bootstrap();
$bootstrap->init();