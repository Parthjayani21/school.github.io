<?php
include '../connection.php';

// print_r($_POST);
// exit;
if (isset($_POST['submit'])) {
    $class = $_POST['class'];
    $division = $_POST['division'];
    // print_r($_POST['division']);
    // exit;
    $DivisionInsert = "insert into division(class_id , division)values('" . $class . "','" . $division . "')";
    $DivisionQuery = mysqli_query($con, $DivisionInsert);
    // print_r($DivisionQuery);
    // exit;
    if ($DivisionQuery) {
        header('location:divisiontable.php');
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
        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
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

        .submitbtn:hover {
            opacity: 1;
        }

        /* Add a blue text color to links */
        a {
            color: dodgerblue;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <div class="container">
            <h1>Division</h1>
            <hr>
            <label>Select Class :</label>

            <select name="class">
                <?php
                $SelectClass = "select * from class ";
                $SelectQuery = mysqli_query($con, $SelectClass);
                while ($row = mysqli_fetch_array($SelectQuery)) {
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['class'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <label><b>Division :</b></label>
            <input type="text" placeholder="Enter Division" name="division" required>
            <hr>
            <button type="submit" name="submit" class="submitbtn">Submit</button>
        </div>
    </form>

</body>

</html>