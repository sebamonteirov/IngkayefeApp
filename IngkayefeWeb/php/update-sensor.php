<?php
session_start();
require_once "conexion.php";

$id = $_GET['id'];
$date = $_GET['date'];
$time = $_GET['time'];
$t = $_GET['t'];
$h = $_GET['h'];
$v = $_GET['v'];

$sql = "INSERT INTO `data_sensor`(`id`, `temperature`, `humidity`, `wind`, `date`, `time`) VALUES ($id, $t, $h, $v, '$date', '$time')";
$query = mysqli_query($conn, $sql);
?>