<?php
session_start(); // Start session

include "database.php";

// Check if the form is submitted with POST and 'id' is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Sanitize input data
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);

    // Prepare and execute the SQL statement
    $sql = "UPDATE student_tb SET fname = ?, lname = ?, phone = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fname, $lname, $phone, $email, $id);

    if ($stmt->execute()) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("Updated!"); document.location.href = "display-person.php";</script>';
        exit(); // Always exit after a header redirect
    } else {
        echo '<script>alert("Cannot uodated!");</script>';
        $stmt->error;
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo "Error updating";
}
?>
