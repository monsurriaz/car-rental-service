<?php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $dbname = 'car_rental_service';

  $conn = new mysqli($host, $user, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>