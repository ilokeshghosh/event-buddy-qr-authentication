<?php
$server ="localhost";
$username="root";
$password="No";
$dbname="event_qr_authy";

$conn = new mysqli($server, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}

?>