<?php
  include 'connect.php';

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  echo "Connected successfully";


  $sql = "INSERT INTO test.Publications(authors, title, conference, location, year) VALUES ('".$_GET['authors']."','".$_GET['title']."','".$_GET['conference']."','".$_GET['location']."','".$_GET['year']."')";

  echo $sql;

  if ($conn->query($sql) === TRUE) {
    header("Location:index.php");
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();

?>