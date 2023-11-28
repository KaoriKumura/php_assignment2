<?php
require './includes/header.php';

// access existing session
session_start();

// remove session variables
session_unset();

// kill the session
session_destroy();

// Display success message
echo '<section>';
echo '<script>alert("Successfully logged out");
    document.location.href = "signin.php";</script>';
echo '</section>';

require './includes/footer.php';
?>
