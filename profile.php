<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <style>
    .navbar {
      float: left;
      background-color: #333;
      overflow: hidden;
      position: fixed;
      top: 0;
      width: 100%;
      height: 80px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
   .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 24px 16px;
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
    }
   .navbar a:hover {
      background-color: #ddd;
      color: black;
    }
    .container {
      
      max-width: 500px;
      margin: 200px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
    }
    input[type="password"],
    button {
      display: block;
      width: 100%;
      margin-bottom: 20px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    
    button {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .message {
      text-align: center;
      color: green;
    }
    
    body {
            background-image: url('contact3.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
            font-family: Arial, sans-serif;
           
        }
  </style>
</head>
<body>
<div class="navbar">
    <a href="home.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="profile.php">Profile</a>
  </div>
  <div class="container">
    <h2>Change Password</h2>
    <?php
      $message = "";

      // Connect to the Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "notes";

      // Create a connection
      $conn = mysqli_connect($servername, $username, $password, $database);

      // Die if connection was not successful
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          $newPassword = $_POST["newPassword"];

          // SQL query to update password
          $sql = "UPDATE login SET password='$newPassword' WHERE username='Shriyam_tiwari'";

          $result = mysqli_query($conn, $sql);

          if($result){
              $message = "Password updated successfully!";
          }
          else{
              $message = "Error: " . mysqli_error($conn);
          }
      }
    ?>
    <form id="changeForm" method="post">
      <input type="password" id="newPassword" name="newPassword" placeholder="New Password" required>
      <button type="submit">Change</button>
    </form>
    <div class="message"><?php echo $message; ?></div>
  </div>
</body>
</html>
