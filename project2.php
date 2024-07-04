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
  $DriverID = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `driver_information` WHERE `DriverID` = $DriverID";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['DriverIDEdit'])){
        // Update the record
        $DriverID = $_POST["DriverIDEdit"];
        $LicenseNo = $_POST["LicenseNoEdit"];
        $Name = $_POST["NameEdit"];
        $LicenseExpiryDate = $_POST["LicenseExpiryDateEdit"];
        $Contact = $_POST["ContactEdit"];
        $truckID = $_POST["truckIDEdit"];

        // Check if truckID exists in truck_information table
        $check_sql = "SELECT * FROM `truck_information` WHERE `truckID` = '$truckID'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0) {
            // TruckID exists, proceed with the update
            $sql = "UPDATE `driver_information` AS di
                    SET di.`LicenseNo` = '$LicenseNo',
                        di.`Name` = '$Name',
                        di.`LicenseExpiryDate` = '$LicenseExpiryDate',
                        di.`Contact` = '$Contact',
                        di.`truckID` = '$truckID'
                    WHERE di.`DriverID` = '$DriverID'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $update = true;
            } else {
                echo "We could not update the record successfully";
            }
        } else {
            // TruckID does not exist, display error message
            echo "Error: TruckID does not exist. Please provide a valid TruckID.";
        }
    } else {
        // Handle insert operation
        $LicenseNo = $_POST["LicenseNo"];
        $Name = $_POST["Name"];
        $LicenseExpiryDate = $_POST["LicenseExpiryDate"];
        $Contact = $_POST["Contact"];
        $truckID = $_POST["truckID"];

        // Check if truckID exists in truck_information table
        $check_sql = "SELECT * FROM `truck_information` WHERE `truckID` = '$truckID'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0) {
            // TruckID exists, proceed with the insert
            $sql = "INSERT INTO `driver_information` (`LicenseNo`,`Name`,`LicenseExpiryDate`,`Contact`,`truckID`) VALUES ('$LicenseNo','$Name','$LicenseExpiryDate','$Contact','$truckID')";
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
        <form action="/phpt/project2.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="DriverIDEdit" id="DriverIDEdit">
            <div class="form-group">
              <label for="LicenseNo">License Number</label>
              <input type="text" class="form-control" id="LicenseNoEdit" name="LicenseNoEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" class="form-control" id="NameEdit" name="NameEdit" >
            </div> 

            
            <div class="form-group">
              <label for="LicenseExpiryDate">License Expiry Date</label>
              <input type="date" class="form-control" id="LicenseExpiryDateEdit" name="LicenseExpiryDateEdit" >
            </div> 
            
            <div class="form-group">
              <label for="Contact">Contact</label>
              <input type="text" class="form-control" id="ContactEdit" name="ContactEdit" >
            </div> 

            <div class="form-group">
              <label for="truckID">Truck ID</label>
              <input type="text" class="form-control" id="truckIDEdit" name="truckIDEdit" >
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
    <h2>Add a Driver</h2>
    <form action="/phpt/project2.php" method="POST">
    <div class="form-group">
        <label for="LicenseNo">License Number</label>
        <input type="text" class="form-control" id="LicenseNo" name="LicenseNo" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" class="form-control" id="Name" name="Name" >
      </div>

      <div class="form-group">
        <label for="LicenseExpiryDate">License Expiry Date</label>
        <input type="date" class="form-control" id="LicenseExpiryDate" name="LicenseExpiryDate" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="Contact">Contact</label>
        <input type="text" class="form-control" id="Contact" name="Contact" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="truckID">Truck ID</label>
        <input type="text" class="form-control" id="truckID" name="truckID" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add Driver</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Driver ID</th>
          <th scope="col">License Number</th>
          <th scope="col">Name</th>
          <th scope="col">License Expiry Date </th>
          <th scope="col">Contact</th>
          <th scope="col">Truck ID</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `driver_information`";
          $result = mysqli_query($conn, $sql);
          $DriverID = 0;
          while($row = mysqli_fetch_assoc($result)){
            $DriverID = $DriverID + 1;
            echo "<tr>
            <th scope='row'>". $DriverID . "</th>
            <td>". $row['LicenseNo'] . "</td>
            <td>". $row['Name'] . "</td>
            <td>". $row['LicenseExpiryDate'] . "</td>
            <td>". $row['Contact'] . "</td>
            <td>". $row['truckID'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['DriverID'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['DriverID'].">Delete</button>  </td>
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
        LicenseNo = tr.getElementsByTagName("td")[0].innerText;
        Name = tr.getElementsByTagName("td")[1].innerText;
        LicenseExpiryDate = tr.getElementsByTagName("td")[2].innerText;
        Contact = tr.getElementsByTagName("td")[3].innerText;
        truckID = tr.getElementsByTagName("td")[4].innerText;
        console.log(LicenseNo,Name, LicenseExpiryDate, Contact,truckID);
        
        LicenseNoEdit.value = LicenseNo;
        NameEdit.value = Name;
        LicenseExpiryDateEdit.value = LicenseExpiryDate;
        ContactEdit.value = Contact;
        truckIDEdit.value = truckID;
        DriverIDEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        DriverID = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this vehicle!")) {
          console.log("yes");
          window.location = `/phpt/project2.php?delete=${DriverID}`;
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