<?php

$host = "localhost";
$username = "root";
$pw = "root";
$db_name = "webco_test";
$profile_images_path = "pictures/";

$conn = new mysqli($host, $username, $pw, $db_name);

if(!$conn){
    die("Database Connection Failed");
}