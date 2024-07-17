<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$db_name="expense";
$con=new mysqli($servername,$username,$password,$db_name,3307);
if($con->connect_error){
    die("Connection Failed".$con->connect_error);
}
echo "";
?>