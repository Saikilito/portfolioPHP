<?php

require('../lib/display_errors.php');
require('../vendor/autoload.php');

session_start();

$dotenv = Dotenv\Dotenv::create(__DIR__ . '\..' );
$dotenv->load();


require('../lib/db_connection.php');
require('../lib/diactoros.php');//request

require('../lib/aura.php');

?>