<?php
require_once 'vendor/autoload.php';

use App\Core\Route;
use App\Controller\BaseController;
use App\Model\BaseModel;

$route = new Route;
echo $route->age . "<br>";
new BaseModel;
?>
