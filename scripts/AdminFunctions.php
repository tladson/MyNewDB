<?php

function db_connect() {

  $dbhost = "training-database.cwoucfsdiyqd.us-west-2.rds.amazonaws.com";
  $dbport = 3306;
  $dbname = "trng_database";
  $username = "db_user";
  $password = "atc12345";
  
  global $dbh;

  if (!$dbh)
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
  $data = htmlspecialchars($data);
  return $data;
}

function add_customer ($db) {
  // add a customer to the DB
  
  global $fnameErr, $lnameErr, $ageErr,$ssnErr = "";
  $fname = $lname = $age = $ssn = "";
  global $add_to_DB = false;
  
  if (empty($_POST["firstname"])) {
    $fnameErr = "* First Name is required"; 
	} else {
	    $fname = process_input($_POST["firstname"]);
		$add_to_DB = true;
      }
		
  if (empty($_POST["lastname"])) {
	$lnameErr = "* Last Name is required"; 
    $add_to_DB = false;
	} else {
	    $lname = process_input($_POST["lastname"]);
      }
		
  if (empty($_POST["custage"])) {
	$ageErr = "* Age is required";
    $add_to_DB = false; 
	} else {
	    $age = process_input($_POST["custage"]);
      }
		
  if (empty($_POST["custssn"])) {
	$ssnErr = "* SSN is required"; 
	$add_to_DB = false;
	} else {
	    $ssn = process_input($_POST["custssn"]);
      }
	  
	 
  if ($add_to_DB)
    if ($db) {
      $query_string = "INSERT INTO Customers " .
	  "(First, Last, Age, SSN) " .
      "VALUES ('$fn', '$ln', $age, $ssn)";
	  if (mysqli_query($db, $query_string)) {
	    return 1;
      } else {
	      echo "Error adding record: " . mysqli_error($db);
	      return 0;
	    }
    }
}

function add_part ($db, $part, $price) {
  // add a part to the Parts table
}

?>