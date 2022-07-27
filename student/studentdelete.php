
<?php
include '../connection.php';
// print_r($_GET);
// exit;
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $SelectStudent = "select * from students where id = $id";
    $SelectQuery = mysqli_query($con, $SelectStudent);
    $row  = mysqli_fetch_assoc($SelectQuery);
    // print_r($row);
    // exit;
    unlink('../image/' . $row['profile']);

    $DeleteStudent = "delete from students where id = $id";
    $DeleteQuery = mysqli_query($con, $DeleteStudent);

    header('location:studenttable.php');
}
