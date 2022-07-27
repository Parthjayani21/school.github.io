<?php
include '../connection.php';

// print_r($_GET);
// exit;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // print_r($DeleteClass);
    // exit;
    $DeleteClass = "delete from `class` where id = $id";
    $DeleteQuery = mysqli_query($con, $DeleteClass);

    header('location:classtable.php');
}
