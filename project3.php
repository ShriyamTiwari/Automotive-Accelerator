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
  $ServiceID = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `service_schedule` WHERE `ServiceID` = $ServiceID";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['ServiceIDEdit'])){
        // Update the record
        $ServiceID = $_POST["ServiceIDEdit"];
        $Date = $_POST["DateEdit"];
        $Description = $_POST["DescriptionEdit"];
        $Mileage = $_POST["MileageEdit"];
        $Cost = $_POST["CostEdit"];
        $TruckID = $_POST["TruckIDEdit"];

        // Check if truckID exists in truck_information table
        $check_sql = "SELECT * FROM `truck_information` WHERE `truckID` = '$TruckID'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Update the record in the service_schedule table
            $sql = "UPDATE `service_schedule` SET 
                    `Date` = '$Date',
                    `Description` = '$Description',
                    `Mileage` = '$Mileage',
                    `Cost` = '$Cost',
                    `TruckID` = '$TruckID' 
                    WHERE `ServiceID` = '$ServiceID'";
            
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $update = true;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Error: TruckID does not exist. Please provide a valid TruckID.";
        }

        // Close database connection
        
    
    } else {
        // Handle insert operation
        $Date= $_POST["Date"];
        $Description = $_POST["Description"];
        $Mileage = $_POST["Mileage"];
        $Cost = $_POST["Cost"];
        $TruckID = $_POST["TruckID"];

        // Check if truckID exists in truck_information table
        $check_sql = "SELECT * FROM `truck_information` WHERE `truckID` = '$TruckID'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0) {
            // TruckID exists, proceed with the insert
            $sql = "INSERT INTO `service_schedule` (`Date`,`Description`,`Mileage`,`Cost`,`TruckID`) VALUES ('$Date','$Description','$Mileage','$Cost','$TruckID')";
            $result = mysqli_query($conn, $sql);
            if($result){ 
                $insert = true;
            } else {
                echo "The record was not inserted successfully because of this error: " . mysqli_error($conn);
            }
        } else {
            // TruckID does not exist, display error message
            echo "Error: TruckID does not exist. Please provide a valid TruckID.";
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
          <h5 class="modal-title" id="editModalLabel">Edit this Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/phpt/project3.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="ServiceIDEdit" id="ServiceIDEdit">
            <div class="form-group">
              <label for="Date">Date</label>
              <input type="date" class="form-control" id="DateEdit" name="DateEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="Description">Description</label>
              <input type="text" class="form-control" id="DescriptionEdit" name="DescriptionEdit" >
            </div> 

            
            <div class="form-group">
              <label for="Mileage">Mileage</label>
              <input type="text" class="form-control" id="MileageEdit" name="MileageEdit" >
            </div> 
            
            <div class="form-group">
              <label for="Cost">Cost</label>
              <input type="text" class="form-control" id="CostEdit" name="CostEdit" >
            </div> 

            <div class="form-group">
              <label for="TruckID">Truck ID</label>
              <input type="text" class="form-control" id="TruckIDEdit" name="TruckIDEdit" >
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
    <strong>Success!</strong> Your data has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Add a Schedule</h2>
    <form action="/phpt/project3.php" method="POST">
    <div class="form-group">
        <label for="Date">Date</label>
        <input type="date" class="form-control" id="Date" name="Date" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Description">Description</label>
        <input type="text" class="form-control" id="Description" name="Description" >
      </div>

      <div class="form-group">
        <label for="Mileage">Mileage</label>
        <input type="text" class="form-control" id="Mileage" name="Mileage" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Cost">Cost</label>
        <input type="text" class="form-control" id="Cost" name="Cost" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="TruckID">Truck ID</label>
        <input type="text" class="form-control" id="TruckID" name="TruckID" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add Schedule</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Service ID</th>
          <th scope="col">Date</th>
          <th scope="col">Description</th>
          <th scope="col">Mileage </th>
          <th scope="col">Cost</th>
          <th scope="col">Truck ID</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `service_schedule`";
          $result = mysqli_query($conn, $sql);
          $ServiceID = 0;
          while($row = mysqli_fetch_assoc($result)){
            $ServiceID = $ServiceID + 1;
            echo "<tr>
            <th scope='row'>". $ServiceID . "</th>
            <td>". $row['Date'] . "</td>
            <td>". $row['Description'] . "</td>
            <td>". $row['Mileage'] . "</td>
            <td>". $row['Cost'] . "</td>
            <td>". $row['TruckID'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['ServiceID'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['ServiceID'].">Delete</button>  </td>
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
        Date = tr.getElementsByTagName("td")[0].innerText;
        Description = tr.getElementsByTagName("td")[1].innerText;
        Mileage = tr.getElementsByTagName("td")[2].innerText;
        Cost = tr.getElementsByTagName("td")[3].innerText;
        TruckID = tr.getElementsByTagName("td")[4].innerText;
        console.log(Date, Description, Mileage, Cost,TruckID);
        
        DateEdit.value = Date;
        DescriptionEdit.value = Description;
        MileageEdit.value = Mileage;
        CostEdit.value = Cost;
        TruckIDEdit.value = TruckID;
        ServiceIDEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        ServiceID = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this data!")) {
          console.log("yes");
          window.location = `/phpt/project3.php?delete=${ServiceID}`;
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