
<?php

include '../connection.php';
// print_r($_GET);
// exit;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // print_r($id);
    // exit;
    $DeleteDivision = "delete from division where id = $id";
    $DeleteQuery = mysqli_query($con, $DeleteDivision);
    // print_r(mysqli_error($con));
    // exit;
    header('location:divisiontable.php');
}
