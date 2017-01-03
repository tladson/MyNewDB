<?php

function db_connect() {

  $dbhost = "training-database.cwoucfsdiyqd.us-west-2.rds.amazonaws.com";
  $dbport = 3306;
  $dbname = "trng_database";
  $username = "db_user";
  $password = "atc12345";
  
  global $dbh;

  $dbh = mysqli_connect($dbhost, $username, $password, $dbname, $dbport); 

//  if (!$dbh){
//   	  echo "Sorry, no connection\n";

  // Check connection pre-5.2.9
  if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  
}  // End function db_connect


function disconnect_DB ($db) {

  if ($db) 
    mysqli_close($db);
  else
    echo "An error occurred: No DB connection to close";
}

function process_input ($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $daat = htmlspecialchars($data);
  return $data;
}

function add_customer ($db, $fn, $ln, $age, $ssn) {
  // add a customer to the DB
  
  if ($db) {
    $query_string = "INSERT INTO Customers(First, Last, Age, SSN)
VALUES($fn, $ln, $age, $ssn)";
	if (mysqli_query($db, $query_string))
	  return 1;
    else 
	  return 0;
}

?>