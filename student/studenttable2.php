<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<form>
    <hr>
    <label><b>Search :</b></label>
    <input type="text" placeholder="Search..." id="search_set" name="search_set" value="<?php echo isset($_GET['search_set']) ? ($_GET['search_set']) : ''; ?>">&nbsp;
    <label><b>Submit :</b></label>
    <button type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary">Subnit</button>
    <label><b>Clear :</b></label>
    <button type="submit" id="btn_clear" name="btn_clear" class="btn btn-primary">clear all</button>
</form>

<body>
    <h2>Students Table</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Student</th>
                <th>Class</th>
                <th>Division</th>
                <th>Hobbies</th>
                <th>Status</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php
            include '../connection.php';
            $search = "";
            if (isset($_GET['search_set'])) {

                $search = " where student Like '%" . $_GET['search_set'] . "%'";
            }
            $SelectStudent = "select students.*,class.class,division.division from students 
        inner join class on students.class_id = class.id 
        inner join division on students.division_id = division.id" . $search;
            // print_r($SelectStudent);
            // exit;
            $SelectQuery = mysqli_query($con, $SelectStudent);
            // print_r($SelectQuery);
            // exit;
            if (mysqli_num_rows($SelectQuery) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_array($SelectQuery)) {
            ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['student'] ?></td>
                        <td><?= $row['class'] ?></td>
                        <td><?= $row['division'] ?></td>
                        <td><?= $row['hobby'] ?></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="status form-check-input" name="status" data-toggle="modal" data-id="<?= $row['id'] ?>" type="checkbox" value="true" <?php echo ($row['status'] == 'true') ? 'checked' : '' ?>>
                            </div>
                        </td>
                        <td>
                            <?php
                            if ($row['profile']) {
                                $file_path = '../image/' . $row['profile'];
                            } else {
                                $file_path = "../default-image/default(1).jpg";
                            }
                            ?>
                            <img src="<?= $file_path ?>" height="75" width="75">
                        </td>
                        <td><a href="studentupdate.php?id=<?= $row['id'] ?>&type=getupdate">Update</a>
                            <a href="studentdelete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            } else {
                echo "<h4 class='text-danger text-center mt-3'>No data Found</h4>";
            }
            ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('.status').change(function() {
                // console.log($(this).prop('checked'));
                var id = $(this).attr("data-id");
                var status = $(this).prop('checked');
                $.ajax({
                    url: "../ajax.php",
                    type: "POST",
                    data: {
                        actionType: 'StudentUpdateStatus',
                        id: id,
                        status_id: status
                    },
                    success: function(data) {
                        // console.log(data);
                        $("data-id").html(data);
                    }
                });
            });
            // SEARCH BAR CLEAR DATA
            $('#btn_clear').click(function() {
                // alert("dgfv");
                $("#search_set").val('');
            });


            $('#btn_submit').click(function() {
                alert('change event')

                $.ajax({
                    url: "../ajax.php",
                    type: "POST",
                    data: {
                        actionType: 'StudentUpdateStatus',
                        id: id,
                        status_id: status
                    },
                    success: function(data) {
                        // console.log(data);
                        $("data-id").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>