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
  
  global $fnameErr, $lnameErr, $ageErr, $ssnErr, $errMsg, $add_to_DB;
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
	      $errMsg = "Error adding record: " . mysqli_error($db);
	      return 0;
	    }
    }
}  // End Function add_customer

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
}  // End Function add_part


function add_order ($db) {
  // add an order to the Orders table
  
  global $ord_fnameErr, $ord_lnameErr, $ord_pnameErr, $amtErr;
  global $fname, $lname, $pname, $amt, $add_to_DB;
  
  if (empty($_POST["firstname"])) {
    $ord_fnameErr = "* First Name is required"; 
	} else {
	    $fname = process_input($_POST["firstname"]);
		$add_to_DB = true;
      }
		
  if (empty($_POST["lastname"])) {
	$ord_lnameErr = "* Last Name is required"; 
    $add_to_DB = false;
	} else {
	    $lname = process_input($_POST["lastname"]);
	  }
		
  if (empty($_POST["partname"])) {
    $ord_pnameErr = "* Part name is required"; 
	$add_to_DB = false;
	} else {
	    $pname = process_input($_POST["partname"]);
	  }
		
  if (empty($_POST["amount"])) {
    $amtErr = "* The quantity is required";
	$add_to_DB = false; 
	} else {
	    $amt = process_input($_POST["amount"]);
      }	
	  
  if ($add_to_DB){
    // search for customer by name

	$query_string = "SELECT Customers.Cust_ID, Parts.Part_ID, Parts.Price " .
				    "FROM Customers, Parts " .
					"WHERE Customers.First='$fname' " .
					"AND Customers.Last='$lname' " .
					"AND Parts.Name='$pname'";
     $result = mysqli_query($db, $query_string);
	 
	 if (mysqli_num_rows($result) > 1) {
	   echo "Unable to add order: Multiple Customers found";
	   return 0;
	 }
	 
     if (mysqli_num_rows($result)) {
	   while ($row = mysqli_fetch_row($result)) {
	     $custID = $row[0];
	   	 $partID = $row[1];
	 	 $total = $amt * $row[2];
	   }
	   $query_string = "INSERT INTO Orders " .
	   "(Cust_ID, Part_ID, Amount, Total) " .
       "VALUES ($custID, $partID, $amt, $total)";
	   if (mysqli_query($db, $query_string)) {
	     return 1;
       } else {
	       echo "Error adding record: " . mysqli_error($db);
	       return 0;
	     } // end add operation
	 } else return 0;  // end add operation after existing record confirmed
  }  // end add_to_Db test
}  // end Function add_order



function remove_customer ($db) {
  // remove a customer record from the DB
  global $fnameErr, $lnameErr, $ssnErr, $errMsg;
  global $custID, $fname, $lname, $ssn, $rem_from_DB;
  $rec = "";
  
  if (!empty($_POST["firstname"])) {
    $fname = process_input($_POST["firstname"]);
    $rem_from_DB = true;
  }
		
  if (!empty($_POST["lastname"])) {
	 $lname = process_input($_POST["lastname"]);
	 $rem_from_DB = true;
  }
		
  if (!empty($_POST["custID"])) {
	    $custID = process_input($_POST["custID"]);
		$rec = "custID";
		$rem_from_DB = true;
      }
		
  if (!empty($_POST["custssn"])) {
	    $ssn = process_input($_POST["custssn"]);
		$rec = "custssn";
		$rem_from_DB = true;
      }
	  
  if ($rem_from_DB) {
    // if a name is specified, verify both is submitted
	if ($fname xor $lname) {
	  $errMsg = "Name requires both first and last";
	  return 0;
	} 
	
	//remove the cust record
	$query_string = "DELETE FROM Customers ";
	switch ($rec) {
	  case "custID" : 
	    $query_string .= "WHERE Cust_ID = $custID";
		break;
	  case "custssn" :
	    $query_string .= "WHERE SSN = $ssn";
		break;
	  default:    // a name is being used
	    $val_name = "SELECT * FROM Customers " .
		            "WHERE First = '$fname' " . 
					"AND Last = '$lname'";
	    if ($result = mysqli_query($db, $val_name)) {
		  if (mysqli_num_rows($result) > 1) {
		    $errMsg = "Multiple Records found. Please use Cust ID or SSN";
			return 0;
		  }
		} else {
	        $errMsg = "Error removing record: " . mysqli_error($db);
	        return 0;
	      } // end retrieving customer by name test
	    $query_string .= "WHERE First = '$fname' ";
		$query_string .= "AND Last = '$lname'";
	}
                
	if (mysqli_query($db, $query_string)) {
	   return 1;
    } else {
	    $errMsg = "Error removing record: " . mysqli_error($db);
	    return 0;
	  } // end remove operation	
  } else {
      $errMsg = "At least one field is required";
	  $rem_from_DB = true;  // setting to true so report status function works
	  return 0;
    }
} // end Function remove_cust

?>