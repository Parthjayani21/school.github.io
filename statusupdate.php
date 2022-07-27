<?php
include 'connection.php';

$id = $_GET['id'];
$status = $_GET['status'];
// print_r($status);

$StatusUpdate = "update students set `status` = '$status' where id = $id";
// print_r($StatusUpdate);
$StatusQuery = mysqli_query($con, $StatusUpdate);

header('location:student/studenttable.php');
