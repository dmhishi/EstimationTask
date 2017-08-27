<?php
  include 'connect.php';

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } 
  echo "Connected successfully";


  $sql = "INSERT INTO test.Faculty(name, position) VALUES ('".$_GET['name']."','".$_GET['position']."')";

  echo $sql;

  if ($conn->query($sql) === TRUE) {
    header("Location:index.php");
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();

?>