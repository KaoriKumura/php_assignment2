<body>
    <?php
    require('./includes/header.php');
    require 'database.php';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    // validate inputs
    $ok = true;
    
    if (empty($fname)) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("First name required"); document.location.href = "index.php";</script>';
        $ok = false;
    }
    if (empty($lname)) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("Last name required"); document.location.href = "index.php";</script>';
        $ok = false;
    }
    if (empty($phone)) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("Phone required"); document.location.href = "index.php";</script>';
        $ok = false;
    }
    if (empty($email)) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("Email required"); document.location.href = "index.php";</script>';
        $ok = false;
    }
    if (empty($password) || ($password != $confirm)) {
        echo '<section class="row success-back-row">';
        echo '<script>alert("Invalid passwords"); document.location.href = "index.php";</script>';
        $ok = false;
    }
    
    if ($ok) {
        $password = hash('sha512', $password);

        // Handle image upload
        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $targetDir = "./img/";
        $image = $_FILES['image']['name'];
        $targetFilePath = $targetDir . $image;
        $fileExtension = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Check if the file has a valid extension
        if (!in_array($fileExtension, $validImageExtensions)) {
            echo '<section class="row success-back-row">';
            echo '<script>alert("Invalid Image Extension"); document.location.href = "index.php";</script>';
            $ok = false;
        } else {
            // Move the uploaded file to the target directory
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
        }

        if ($ok) {
            // set up the sql
            $sql = "INSERT INTO student_tb (password, fname, lname, phone, email, image, role)
                    VALUES ('$password', '$fname', '$lname', '$phone', '$email', '$image', '$role');";
            $conn->query($sql);

            echo '<section class="row success-back-row">';
            echo '<script>alert("Successfully registerd"); document.location.href = "signin.php";</script>';
            echo '</section>';
        }
    }

    // disconnect
    $conn = null;
    ?>
</body>
<?php require './includes/footer.php'; ?>
