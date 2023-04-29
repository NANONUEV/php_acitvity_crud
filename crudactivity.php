<?php
// Database credentials
$servername = "localhost";
$username = "nanonuev";
$password = "biri";
$dbname = "baits";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Add new user to database
if(isset($_POST['add'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $sql = "INSERT INTO users (name, username, password, first_name, last_name) VALUES ('$name', '$username', '$password', '$first_name', '$last_name')";
  if ($conn->query($sql) === TRUE) {
    echo "New user added successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Update user data
if(isset($_POST['update'])) {
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $sql = "UPDATE users SET name='$name', password='$password', first_name='$first_name', last_name='$last_name' WHERE username='$username'";
  if ($conn->query($sql) === TRUE) {
    echo "User data updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Delete user data
if(isset($_POST['delete'])) {
  $username = $_POST['username'];
  $sql = "DELETE FROM users WHERE username='$username'";
  if ($conn->query($sql) === TRUE) {
    echo "User data deleted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>


<?php

$sql = "SELECT username, first_name, last_name FROM users";
$result = $conn->query($sql);
?>

<table>
  <thead>
    <tr>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["username"] . "</td>";
          echo "<td>" . $row["first_name"] . "</td>";
          echo "<td>" . $row["last_name"] . "</td>";
          echo "<td>";
          echo "<form method='POST'>";
          echo "<input type='hidden' name='username' value='" . $row["username"] . "'>";
          echo "<input type='submit' name='edit' value='Edit'>";
          echo "<input type='submit' name='delete' value='Delete'>";
          echo "</form>";
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
      }
    ?>
  </tbody>
</table>


<?php
if(isset($_POST['edit'])) {
  $username = $_POST['username'];
  // code to retrieve user data for editing
  // display a form with pre-filled input fields for editing the user data
}

if(isset($_POST['delete'])) {
  $username = $_POST['username'];
  // code to delete the user from the database
}
?>



<form method="POST">
  <label for="name">Name:</label>
  <input type="text" name="name"><br>
  <label for="username">Username:</label>
  <input type="text" name="username"><br>
  <label for="password">Password:</label>
  <input type="password" name="password"><br>
  <label for="first_name">First Name:</label>
  <input type="text" name="first_name"><br>
  <label for="last_name">Last Name:</label>
  <input type="text" name="last_name"><br>
  <input type="submit" name="add" value="Add user">
</form>


<form method="POST">
  <label for="username">Username:</label>
  <input type="text" name="username"><br>
  <label for="name">Name:</label>
  <input type="text" name="name"><br>
  <label for="password">Password:</label>
  <input type="password" name="password"><br>
  <label for="first_name">First Name:</label>
  <input type="text" name="first_name"><br>
  <label for="last_name">Last Name:</label>
  <input type="text" name="last_name"><br>
  <input type="submit" name="update" value="Update user data">
</form>


<form method="POST">
  <label for="username">Username:</label>
  <input type="text" name="username"><br>
  <input type="submit" name="delete" value="Delete user data">
</form>

