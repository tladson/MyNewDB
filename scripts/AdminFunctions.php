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
  
  global $fnameErr, $lnameErr, $ageErr, $ssnErr, $add_to_DB;
  global $fname, $lname, $age, $ssn;
  
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
      "VALUES ('$fname', '$lname', $age, $ssn)";
	  if (mysqli_query($db, $query_string)) {
	    return 1;
      } else {
	      echo "Error adding record: " . mysqli_error($db);
	      return 0;
	    }
    }
}

function add_part ($db) {
  // add a part to the Parts table
  
  global $pnameErr, $ppriceErr;
  global $pname, $pprice, $add_to_DB;
  
  if (empty($_POST["partname"])) {
    $pnameErr = "* The Part's name is required"; 
	} else {
	    $pname = process_input($_POST["partname"]);
		$add_to_DB = true;
      }
		
  if (empty($_POST["partprice"])) {
	$ppriceErr = "* Price of part required"; 
    $add_to_DB = false;
	} else {
	    $pprice = process_input($_POST["partprice"]);
      }
	  
  if ($add_to_DB)
    if ($db) {
      $query_string = "INSERT INTO Parts " .
	  "(Name, Price) " .
      "VALUES ('$pname', $pprice)";
	  if (mysqli_query($db, $query_string)) {
	    return 1;
      } else {
	      echo "Error adding record: " . mysqli_error($db);
	      return 0;
	    }
    }
}

?>