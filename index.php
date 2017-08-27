<?php
  include 'connect.php';

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  //echo "Connected successfully";

  if (isset($_GET["sort"])) {
    $sort = $_GET["sort"];
  }

  $sql = "select * from test.Faculty";
  if (isset($_GET["sort"])) {
    if(strcmp($sort, "Name")==0 || strcmp($sort, "Position")==0) {
      $sql = $sql." order by ".$sort;
    }
  }
  $faculty = $conn->query($sql);

  $sql = "select * from test.Publications";
  if (isset($_GET["sort"])) {
    if(strcmp($sort, "Authors")==0 || strcmp($sort, "Title")==0 || strcmp($sort, "Conference")==0 || strcmp($sort, "Location")==0 || strcmp($sort, "Year")==0) {
      $sql = $sql." order by ".$sort;
    }
  }
  $publication = $conn->query($sql);

  //$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Estimation Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="text-center">Add Faculty</h2>
        <form class="form-horizontal" action="submit-faculty.php" method="GET">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="position">Position:</label>
            <div class="col-sm-10">          
            <select class="form-control" id="position" name="position">
              <option value="" disabled selected style="display: none;">Choose position</option>
              <option value="Asistant Professor">Asistant Professor</option>
              <option value="Associate Professor">Associate Professor</option>
              <option value="Professor">Professor</option>
            </select>
            </div>
          </div>
          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <h2 class="text-center">Add Publication</h2>
        <form class="form-horizontal" action="submit-publication.php" method="GET">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Authors:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" placeholder="Enter authors e.g. Author 1, Author 2, Author 3" name="authors">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Title:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Conference name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="conference" placeholder="Enter conference name" name="conference">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Conference location:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="location" placeholder="Enter conference location" name="location">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="position">Year:</label>
            <div class="col-sm-10">
              <select class="form-control" name="year" id="year">
                <option value="" disabled selected style="display: none;">Choose year</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
              </select>
            </div>
          </div>
          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr>

    <div class="alert alert-info alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Click column name to sort table by that column.
    </div>

    <div class="row">
      <div class="col-md-6">
        <h2 class="text-center">Faculty List</h2>
        <table class="table">
          <thead>
            <tr>
              <th><a href="index.php?sort=Name">Name</a></th>
              <th><a href="index.php?sort=Position">Position</a></th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($faculty_row = $faculty->fetch_assoc()) {
                echo "
                  <tr>
                    <td>".$faculty_row['Name']."</td>
                    <td>".$faculty_row['Position']."</td>
                  </tr>";
              }
          ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <h2 class="text-center">Publications List</h2>
        <table class="table">
          <thead>
            <tr>
              <th><a href="index.php?sort=Authors">Authors</a></th>
              <th><a href="index.php?sort=Title">Title</a></th>
              <th><a href="index.php?sort=Conference">Conference</a></th>
              <th><a href="index.php?sort=Location">Location</a></th>
              <th><a href="index.php?sort=Year">Year</a></th>
            </tr>
          </thead>
          <tbody>
          <?php
              while($publication_row = $publication->fetch_assoc()) {
                echo "
                <tr>
                  <td>".$publication_row['Authors']."</td>
                  <td>".$publication_row['Title']."</td>
                  <td>".$publication_row['Conference']."</td>
                  <td>".$publication_row['Location']."</td>
                  <td>".$publication_row['Year']."</td>
                </tr>";
              }
            $conn->close();
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
