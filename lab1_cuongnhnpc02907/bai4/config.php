<?php
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=management;charset=utf8";
    $username = 'root';
    $password = 'mysql';

    $conn = new PDO($dburl, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>