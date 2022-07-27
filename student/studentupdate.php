<?php

include '../connection.php';
// exit;
if ($_GET['type'] == 'getupdate') {

    $SelectStudent = "select * from students where id =" . $_GET['id'];
    $SelectQuery = mysqli_query($con, $SelectStudent);
    $RowData = mysqli_fetch_array($SelectQuery);
    // print_r($RowData);
    // exit;
} else
    //     print_r($_POST);
    // exit;

    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $student = $_POST['student'];
        $class = $_POST['class_id'];
        $division = $_POST['division_id'];
        $hobbies = $_POST['hobbies'];
        $status = $_POST['status'];

        $file_name = $_FILES['fileupload']['name'];

        if ($file_name) {
            $newfilename = uniqid() . $file_name;
            $file_size = $_FILES['fileupload']['size'];
            $file_tmp = $_FILES['fileupload']['tmp_name'];
            $file_type = $_FILES['fileupload']['type'];
            $file_ext = explode('.', $newfilename);
            $file_ext_check = strtolower(end($file_ext));
            $valid_ext = array('jpg', 'jpeg', 'png');

            $getData = 'select *  from students where id=' . $id;
            $getQuery = mysqli_query($con, $getData);
            $fetcData = mysqli_fetch_assoc($getQuery);
            // print_r($fetcData['profile']);
            unlink('../image/' . $fetcData['profile']);

            move_uploaded_file($file_tmp, '../image/' . $newfilename);
            $studentUpdate = "UPDATE `students` SET `profile`= '$newfilename' WHERE id =" . $id;
            $StudentQuery = mysqli_query($con, $studentUpdate);
        }

        $studentUpdate = "UPDATE `students` SET `student`='$student',
        `class_id`='$class',
        `division_id`='$division',
        `hobby`='$hobbies',
        `status`='$status' WHERE id =" . $id;
        $StudentQuery = mysqli_query($con, $studentUpdate);

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
    <form action="studentupdate.php?id=<?= $_GET['id'] ?>&type=updatedata" method="post" enctype="multipart/form-data">
        <div class="container">
            <h1>Update Student</h1>
            <hr>
            <label><b>Student :</b></label>
            <input type="text" name="student" value="<?= $RowData['student'] ?>">
            <label><b>Select Class :</b></label>
            <select name="class_id" id="class_id">
                <option value="">Select</option>
                <?php
                $SelectClass = "select * from class";
                $SelectQuery = mysqli_query($con, $SelectClass);
                while ($ClassData = mysqli_fetch_assoc($SelectQuery)) {
                ?>
                    <option value="<?= $ClassData['id'] ?>" <?php if ($ClassData['id'] == $RowData['class_id']) {
                                                                echo "selected";
                                                            } ?>><?= $ClassData['class']  ?></option>
                <?php
                }
                ?>
            </select>
            <br><br>
            <label><b>Select Division :</b></label>
            <select name="division_id" id="division_id">
                <option value="">Select</option>
            </select>
            <br><br>
            <label><b>Select Hobbies :</b></label>
            <input type="checkbox" name="hobbies" value="travel" <?php echo ($RowData['hobby'] == 'travel') ? 'checked' : '' ?>>
            <label>Travel</label>
            <input type="checkbox" name="hobbies" value="song" <?php echo ($RowData['hobby'] == 'song') ? 'checked' : '' ?>>
            <label>Song</label>
            <input type="checkbox" name="hobbies" value="game" <?php echo ($RowData['hobby'] == 'game') ? 'checked' : '' ?>>
            <label>Games</label>
            <input type="checkbox" name="hobbies" value="learning" <?php echo ($RowData['hobby'] == 'learning') ? 'checked' : '' ?>>
            <label>Learning</label>
            <br><br>
            <label><b>Select Status :</b></label>
            <!-- <select name="status" id="status" required>
                <option value="">Select</option>
                <option value="true" ['status'] == 'true' ? ' selected="selected"' : ''; ?>>Yes</option>
                <option value="false" ['status'] == 'false' ? ' selected="selected"' : ''; ?>>No</option>
            </select> -->

            <input type="radio" name="status" id="status" value="true" <?php echo ($RowData['status'] == 'true') ? 'checked' : '' ?>>Yes
            <input type="radio" name="status" id="status" value="false" <?php echo ($RowData['status'] == 'false') ? 'checked' : '' ?>>No
            <br><br>
            <label><b>Select Image :</b></label>
            <input type="file" name="fileupload" id="fileupload"><br><br>
            <?php
            if ($RowData['profile']) {
                $path = "../image/" . $RowData['profile'];
            } else {
                $path = "../default-image/default(1).jpg";
            }
            ?>
            <img src="<?= $path ?>" height="75" width="75">
            <hr>
            <button type="submit" name="submit" class="submitbtn">Submit</button>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            function loadDivsion() {
                var classid = $("#class_id").val();
                // alert(classid)
                $.ajax({
                    url: "../ajax.php",
                    type: "POST",
                    data: {
                        actionType: 'getdivisionOnClass',
                        class_id: classid
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#division_id ").html(data);
                    }
                });
            }
            loadDivsion();
            $("#class_id").on("change", function() {
                loadDivsion();
            });
        });
    </script>
</body>

</html>