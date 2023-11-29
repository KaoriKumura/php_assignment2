<?php require './includes/headeradmin.php';?>
<body>
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('location:signin.php');
    exit();
} else {
    require 'database.php';

    // Fetch the first name and role of the logged-in user
    $id = $_SESSION['id'];
    $sql = "SELECT fname, role FROM student_tb WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['fname'];
    $role = $row['role'];

    if ($role == 'admin') {
        echo '<section class="person-row">';
        echo '<div class="container">Hi, ' . $fname . '!<br>Your ID is ' . $id . '<br>You are in admin page now</div>';
        echo '<table class="display">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>';

        $sql = "SELECT * FROM student_tb";
        $result = mysqli_query($conn, $sql);

        foreach ($result as $row) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['fname'] . "</td>
                    <td>" . $row['lname'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['role'] . "</td>
                    <td><img src='img/{$row['image']}' width='100' title='{$row['image']}'></td>
                    <td>
                    <button class='viewpoint'><a class='viewpoint' href='edit.php?id={$row['id']}'>Edit</a></button>
                    <button class='viewpoint2'><a class='viewpoint' href='delete.php?id={$row['id']}'>Delete</a></button>
                    </td>
                  </tr>";
        }

        echo '</table>';
        echo '</section>';
    } else {
        echo '<section class="person-row2">';
        echo '<div class="container">Hi, ' . $fname . '!<br>You are in user page now</div>';
        echo '<table class="display">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>';

        $sql = "SELECT * FROM student_tb WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        foreach ($result as $row) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['fname'] . "</td>
                    <td>" . $row['lname'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td><img src='img/{$row['image']}' width='100' title='{$row['image']}'></td>
                    <td>
                        <button class='viewpoint'><a class='viewpoint' href='edit.php?id={$row['id']}'>Edit</a></button>
                    </td>
                  </tr>";
        }

        echo '</table>';
        echo '</section>';
    }

    $conn = null;
}
?>
</body>
<?php require './includes/footer.php';?>
