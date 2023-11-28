<?php
include "database.php";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM `student_tb` WHERE id = $id";
  $conn->query($sql);

echo "<script>
      var result = confirm('Are you sure you want to delete this student?');
      if (result) {
          window.location.href = 'delete-student.php?id=$id&confirm=yes';
      } else {
          window.location.href = 'display-person.php';
      }
      </script>";
      
    } else {
      // Redirect if 'id' is not set in the URL
      header("location: display-person.php");
      exit;
  }
  
  // Handle deletion only if 'confirm' is set to 'yes'
  if (isset($_GET['id'], $_GET['confirm']) && $_GET['confirm'] === 'yes') {
      $id = $_GET['id'];
  
      // Use prepared statement to prevent SQL injection
      $sql = "DELETE FROM `student_tb` WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $stmt->close();
  }
  
  // Redirect to 'display-person.php' after handling deletion
  header("location: display-person.php");
  exit;
?>
