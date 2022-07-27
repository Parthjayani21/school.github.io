<?php

include '../connection.php';

if (isset($_POST['submit'])) {

    $class = $_POST['class'];
    $status = $_POST['status'];
    $ClassInsert = "INSERT INTO class (`class`,`status`) VALUES  ('" . $class . "','" . $status . "')";
    $ClassQuery =  mysqli_query($con, $ClassInsert);
    if ($ClassQuery) {
        header('location:classtable.php');
    } else {
        echo "not insert";
    }
}


?>





<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }

        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        /* Overwrite default styles of hr */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for the submit button */
        .submitbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <div class="container">
            <h1>Class</h1>

            <hr>

            <label><b>Class :</b></label>
            <input type="text" placeholder="Enter Class" name="class" required>
            <label><b>Select Status :</b></label>
            <select name="status" id="status" required>
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <br><br>

            <hr>

            <button type="submit" name="submit" class="submitbtn">submit</button>
        </div>
    </form>

</body>

</html>