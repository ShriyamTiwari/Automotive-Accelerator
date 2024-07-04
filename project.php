<?php  

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

if(isset($_GET['delete'])){
  $truckID = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `truck_information` WHERE `truckID` = $truckID";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['truckIDEdit'])){
  // Update the record
  $truckID = $_POST["truckIDEdit"];
    $License_Plate = $_POST["License_PlateEdit"];
    $Make = $_POST["MakeEdit"];
    $Truck_type = $_POST["Truck_typeEdit"];
    $Cargo_capacity = $_POST["Cargo_capacityEdit"];
    $Year = $_POST["YearEdit"];

  // Sql query to be executed
  $sql = "UPDATE `truck_information` SET  `License_Plate` = '$License_Plate' , `Make` = '$Make'
  , `Truck_type` = '$Truck_type', `Cargo_capacity` = '$Cargo_capacity', `Year` = '$Year' WHERE `truck_information`.`truckID` = $truckID";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{

  $License_Plate = $_POST["License_Plate"];
  $Make = $_POST["Make"];
  $Truck_type = $_POST["Truck_type"];
  $Cargo_capacity = $_POST["Cargo_capacity"];
  $Year = $_POST["Year"];


  // Sql query to be executed
  $sql = $sql = "INSERT INTO `truck_information` (`License_Plate`,`Make`,`Truck_type`,`Cargo_capacity`,`Year`) VALUES ('$License_Plate','$Make','$Truck_type','$Cargo_capacity','$Year')";


  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
<style>
  .navbar {
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
</style>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Automotive Accelerator - Your Trusted Trucking Solution</title>

</head>

<body>
 
<div class="navbar">
    <a href="home.html">Home</a>
    <a href="contact.php">Contact</a>
    <a href="profile.php">Profile</a>
  </div>
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Vehicle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/phpt/project.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="truckIDEdit" id="truckIDEdit">
            <div class="form-group">
              <label for="License_Plate">License Plate</label>
              <input type="text" class="form-control" id="License_PlateEdit" name="License_PlateEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="Make">Make</label>
              <input type="text" class="form-control" id="MakeEdit" name="MakeEdit" >
            </div> 

            
            <div class="form-group">
              <label for="Truck_type">Truck Type</label>
              <input type="text" class="form-control" id="Truck_typeEdit" name="Truck_typeEdit" >
            </div> 
            
            <div class="form-group">
              <label for="Cargo_capacity">Cargo Capacity</label>
              <input type="text" class="form-control" id="Cargo_capacityEdit" name="Cargo_capacityEdit" >
            </div> 

            
            <div class="form-group">
              <label for="Year">Year</label>
              <input type="date" class="form-control" id="YearEdit" name="YearEdit" >
            </div> 

          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your vehicle has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your vehicle has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your vehicle has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Add a vehicle</h2>
    <form action="/phpt/project.php" method="POST">

      <div class="form-group">
        <label for="License_Plate">License Plate</label>
        <input type="text" class="form-control" id="License_Plate" name="License_Plate" >
      </div>
      <div class="form-group">
        <label for="Make">Make</label>
        <input type="text" class="form-control" id="Make" name="Make" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Truck_type">Truck Type</label>
        <input type="text" class="form-control" id="Truck_type" name="Truck_type" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Cargo_capacity">Cargo Capacity</label>
        <input type="text" class="form-control" id="Cargo_capacity" name="Cargo_capacity" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Year">Year</label>
        <input type="date" class="form-control" id="Year" name="Year" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add Truck</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Truck ID</th>
          <th scope="col">License Plate</th>
          <th scope="col">Make</th>
          <th scope="col">Truck Type</th>
          <th scope="col">Cargo Capacity</th>
          <th scope="col">Year</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `truck_information`";
          $result = mysqli_query($conn, $sql);
          $truckID = 0;
          while($row = mysqli_fetch_assoc($result)){
            $truckID = $truckID + 1;
            echo "<tr>
            <th scope='row'>". $truckID . "</th>
            <td>". $row['License_Plate'] . "</td>
            <td>". $row['Make'] . "</td>
            <td>". $row['Truck_type'] . "</td>
            <td>". $row['Cargo_capacity'] . "</td>
            <td>". $row['Year'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['truckID'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['truckID'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        License_Plate = tr.getElementsByTagName("td")[0].innerText;
        Make = tr.getElementsByTagName("td")[1].innerText;
        Truck_type = tr.getElementsByTagName("td")[2].innerText;
        Cargo_capacity = tr.getElementsByTagName("td")[3].innerText;
        Year = tr.getElementsByTagName("td")[4].innerText;
        console.log(License_Plate,Make, Truck_type, Cargo_capacity,Year);
        
        License_PlateEdit.value = License_Plate;
        MakeEdit.value = Make;
        Truck_typeEdit.value = Truck_type;
        Cargo_capacityEdit.value = Cargo_capacity;
        YearEdit.value = Year;
        truckIDEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        truckID = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this vehicle!")) {
          console.log("yes");
          window.location = `/phpt/project.php?delete=${truckID}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>