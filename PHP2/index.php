<?php

require_once "vendor\autoload.php";
session_start();
ob_start();

define("ROOT_URL", "http://PHP2/");
const APP_URL = 'http://PHP2/';

use App\Mail\Mailer;
use App\Models\Database;
use App\Models\UserModel;
// $data = new UserModel();
// var_dump($data->create(1));
// var_dump($user->checkUserExist('tinhpv10@fpt.edu.vn'));

use App\Models\StudentModel;
// $data = new StudentModel();
// var_dump($data->getAllUser());



// var_dump(password_hash("123456", 1));

use App\Core\Route;

new Route;