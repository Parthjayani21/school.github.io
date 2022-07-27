<?php
// Insert Data
include 'connection.php';
// print_r($_POST['actionType']);
// exit;
// print_r('ukyjthgfd');
if ($_POST['actionType'] == 'getdivisionOnClass') {
    // print_r('division');
    $class_id = $_POST["class_id"];
    $SelectDivision = "select * from division where class_id = $class_id ORDER BY division ASC ";
    $SelectQuery = mysqli_query($con, $SelectDivision);
    echo '<option value="">Select</option>';
    while ($DivisionData = mysqli_fetch_array($SelectQuery)) {


        echo  '<option value="' . $DivisionData['id'] . '"> ' . $DivisionData['division'] . '</option>';
    }
}

// <!-- Update Data -->

// if (isset($_POST["classupdate_id"])) {
//     print_r('dfcsUIIII');
//     $classupdate_id = $_POST["classupdate_id"];
//     $DivisionUpdate = "select * from division where class_id = $classupdate_id ORDER BY division ASC ";
//     $UpdateQuery = mysqli_query($con, $DivisionUpdate);

//     while ($DivisionUpdate = mysqli_fetch_array($UpdateQuery)) {

//         echo '<option value="' . $DivisionUpdate['id'] . '">' . $DivisionUpdate['division'] . '</option>';
//     }
// }

// print_r($_POST['actionType']);
// exit;
// echo $_GET['id'];
// exit;
if ($_POST['actionType'] == 'StudentUpdateStatus') {

    // print_r('status');

    $id = $_POST['id'];
    $status = $_POST['status_id'];

    $statusUpdate = "UPDATE `students` SET `status`='$status' where id = $id ";
    $statusQuery = mysqli_query($con, $statusUpdate);

    // header('location:student/studenttable.php');
}
