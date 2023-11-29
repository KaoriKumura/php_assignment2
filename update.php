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
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    
    if ($_FILES["image"]["error"] == 4) {
        echo '<script> alert("Image does not exist") </script>';
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if (!in_array($imageExtension, $validImageExtension)) {
            echo '<script>alert("Invalid Image Extension") </script>';
        } else if ($fileSize > 10000000) {
            echo '<script>alert("Image Size is too large") </script>';
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, './img/' . $newImageName);

            // Prepare and execute the SQL statement
            $sql = "UPDATE student_tb SET fname = ?, lname = ?, phone = ?, email = ?, image = ?, role = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $fname, $lname, $phone, $email, $newImageName, $role, $id);

            if ($stmt->execute()) {
                echo '<section class="row success-back-row">';
                echo '<script>alert("Updated!"); document.location.href = "display-person.php";</script>';
                exit(); // Always exit after a header redirect
            } else {
                echo '<script>alert("Cannot updated!");  document.location.href = "display-person.php";</script>';
                $stmt->error;
            }

            $stmt->close(); // Close the prepared statement
        }
    }
} else {
    echo "Error updating";
}
?>
