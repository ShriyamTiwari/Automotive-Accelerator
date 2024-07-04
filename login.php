<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
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

if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "select * from login where username = '$username' and password = '$password'";  
    $result = mysqli_query($conn, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    
    if($count == 1){  
        header("Location: about.html");
    }  
    else{  '<script>
        function isvalid(){
            var user = document.form.user.value;
            var pass = document.form.pass.value;
            if(user.length=="" && pass.length==""){
                alert(" Username and password field is empty!!!");
                return false;
            }
            else if(user.length==""){
                alert(" Username field is empty!!!");
                return false;
            }
            else if(pass.length==""){
                alert(" Password field is empty!!!");
                return false;
            }
            
        }
        alert("Login failed. Invalid username or password!!")
    </script>';
    }     
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Automotive Accelerator Login</title>
<style>

    body {
        background-image: url('contact3.jpeg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        max-width: 400px;
        padding: 30px;
        background-color: black;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
    h1 {
        text-align: center;
        color:whitesmoke;
        text-transform: uppercase;
    }
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: 2px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background-color: #4CAF50;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        text-transform: uppercase;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #45a049;
    }
    .message {
        text-align: center;
        font-size: 14px;
        margin-top: 10px;
    }
    .error {
        color: red;
    }
    .success {
        color: green;
    }
    label{
        color: whitesmoke;
    }
    
</style>

</head>
<body  background="truck.jpg">
<div class="container">
<h1>Login Form</h1>
            <form name="form" action="login.php" onsubmit="return isvalid()" method="POST">
                <label>Username: </label>
                <input type="text" id="user" name="user"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass"></br></br>
                <button id="btn" value="Login" name = "submit">Login </button>
            </form>
   
</div>

    
</body>
</html>
