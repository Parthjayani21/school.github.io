<!DOCTYPE html>
<html>

<head>
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

<body>

    <h2>Class Table</h2>

    <table>
        <tr>
            <th>Id</th>
            <th>Class</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        include '../connection.php';
        $SelectClass = "select * from class";
        $SelectQuery = mysqli_query($con, $SelectClass);
        $i = 1;
        while ($row = mysqli_fetch_array($SelectQuery)) {
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $row['class']; ?></td>
                <td><?= $row['status']; ?></td>
                <td><a href="classupdate.php?id=<?= $row['id'] ?>&type=getupdate">Update</a>
                    <a href="classdelete.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </table>

</body>

</html>