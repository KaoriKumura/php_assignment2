<?php
// connect to db
require 'database.php';

// store the user inputs in variables and hash the password
$id = $_POST['id'];
$password = hash('sha512', $_POST['password']);

// set up and run the query using prepared statements
$sql = "SELECT id, role FROM student_tb WHERE id = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id, $password);
$stmt->execute();
$stmt->store_result();
$count = $stmt->num_rows;

if ($count > 0) {
    $stmt->bind_result($id, $role);
    $stmt->fetch();

    // Start the session
    session_start();

    $_SESSION['id'] = $id;

    if ($role == 'admin') {
        echo "<script>alert('Logged in successfully!');
            document.location.href = 'display-person.php';</script>";
    } elseif ($role == 'user') {
        echo "<script>alert('Logged in successfully!');
            document.location.href = 'display-person.php';</script>";
            // userpage
    }
} else {
    echo "<script>alert('Invalid ID or password');
        document.location.href = 'signin.php';</script>";
}

$stmt->close();
$conn->close();
?>
