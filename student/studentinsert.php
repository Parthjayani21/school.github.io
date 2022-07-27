<?php
include '../connection.php';
session_start();

if (isset($_POST['submit'])) {

    $student = $_POST['student'];
    $class = $_POST['class'];
    $division = $_POST['division'];
    $hobbies = $_POST['hobbies'];
    $status = $_POST['status'];
    $file_name = $_FILES['fileupload']['name'];
    $newfilename = uniqid() . $file_name;
    $file_size = $_FILES['fileupload']['size'];
    $file_tmp = $_FILES['fileupload']['tmp_name'];
    $file_type = $_FILES['fileupload']['type'];
    $file_ext = explode('.', $newfilename);
    $file_ext_check = strtolower(end($file_ext));
    $valid_ext = array('jpg', 'jpeg', 'png');
    if ($file_name) {
        $file_path = $newfilename;
    }
    $upload =  move_uploaded_file($file_tmp, "../image/" . $file_path);
    // $error = array();
    // // print_r($error);
    // // exit;
    // if (empty($name)) {
    //     $_SESSION['name'] = 'enter name';
    // }
    // if (empty($class)) {
    //     $_SESSION['class'] = 'enter class';
    // }
    // if (empty($division)) {
    //     $_SESSION['division'] = 'enter division';
    // }
    // if (empty($status)) {
    //     $_SESSION['status'] = 'enter status';
    // }
    $StudentInsert = "insert into students(student, class_id, division_id, hobby, status, profile)values('" . $student . "','" . $class . "','" . $division . "','" . $hobbies . "','" . $status . "','" . $file_path . "')";
    $StudentQuery = mysqli_query($con, $StudentInsert);
    // print_r($StudentInsert);
    // exit;
    if ($StudentQuery) {
        header('location:studenttable.php');
    } else {
        echo "not insert";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
    <form action="" method="post" id="signupForm" enctype="multipart/form-data">
        <div class="container">
            <h1>Student</h1>
            <hr>
            <label><b>Student :</b></label>
            <input type="text" placeholder="Enter Student" id="student" name="student" required>

            <label><b>Select Class :</b></label>
            <select name="class" id="class" required>
                <option value="">Select</option>
                <?php
                $SelectClass = "select * from class ";
                $SelectQuery = mysqli_query($con, $SelectClass);
                while ($ClassData = mysqli_fetch_array($SelectQuery)) {
                ?>
                    <option value="<?= $ClassData['id'] ?>"><?= $ClassData['class'] ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <label><b>Select Division :</b></label>
            <select name="division" id="division">
                <option>Select</option>
            </select>
            <br><br>
            <label><b>Select Hobbies :</b></label>
            <input type="checkbox" name="hobbies" value="travel">
            <label>Travel</label>
            <input type="checkbox" name="hobbies" value="song">
            <label>Song</label>
            <input type="checkbox" name="hobbies" value="game">
            <label>Games</label>
            <input type="checkbox" name="hobbies" value="learning">
            <label>Learning</label>
            <br><br>
            <label><b>Select Status :</b></label>
            <select name="status" id="status">
                <option value="">Select</option>
                <option value="true">Yes</option>
                <option value="false">No</option>
            </select>
            <br><br>

            <label><b>Select Image :</b></label>
            <input type="file" name="fileupload" id="fileupload">
            <hr>
            <button type="submit" name="submit" class="submitbtn">Submit</button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#class").on("change", function() {
                var classid = $(this).val();
                // alert(classid);
                $.ajax({

                    url: "../ajax.php",
                    type: "POST",
                    data: {
                        actionType: 'getdivisionOnClass',
                        class_id: classid
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#division").html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>