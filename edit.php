<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // Check if 'id' is set in the GET request
  if (!isset($_GET["id"])) {
    header("location: index.php");
    exit;
  }

  $id = $_GET['id'];

  // Use prepared statement to prevent SQL injection
  $sql = "SELECT * FROM student_tb WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  // Check for errors during the query
  if ($stmt->error) {
    echo "Error: " . $stmt->error;
    exit;
  }

  $result = $stmt->get_result();

  // Check if there are rows returned
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fname = $row["fname"];
    $lname = $row["lname"];
    $phone = $row["phone"];
    $email = $row["email"];
    // $role = $row["role"];
    // $image = $row["image"];
  } else {
    // Redirect if no rows are returned
    header("location: index.php");
    exit;
  }

  $stmt->close(); // Close the prepared statement
}
?>

<?php require('./includes/header.php'); ?>
<link rel="stylesheet" href="css/style.css">
<body class="admin">
  <main>
    <form class="admin" action="update.php" method="POST" enctype="multipart/form-data">
      <section>
        <h3 class="admin">Update</h3>
        <div class="info">
          <label for="fname">First Name</label>
          <input type="text" class="admin" name="fname" value="<?php echo $fname; ?>" required="">
        </div>
        <div class="info">
          <label for="lname">Last Name</label>
          <input type="text" class="admin" name="lname" value="<?php echo $lname; ?>" required="">
        </div>
        <div class="info">
          <label for="phone">Phone Number</label>
          <input type="text" class="admin" name="phone" value="<?php echo $phone; ?>" required="">
        </div>
        <div class="info">
          <label for="email">Email</label>
          <input type="email" class="admin" name="email" value="<?php echo $email; ?>" required="">
        </div>
        <div class="info">
          <select name="role" value="">
            <option value="<?php echo $role; ?>"></option>
            <option value="user">user</option>
            <option value="admin">admin</option>
          </select>
        </div>
        <div class="info">
          <input class="file" type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="<?php echo $image; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button class="admin" type="submit" name="update">Save</button>
      </section>
    </form>
  </main>
</body>

<?php require('./includes/footer.php'); ?>