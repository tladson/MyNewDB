<?php
// Database Functions 


function db_connect() {

  $dbhost = "training-database.cwoucfsdiyqd.us-west-2.rds.amazonaws.com";
  $dbport = 3306;
  $dbname = "trng_database";
  $username = "db_user";
  $password = "atc12345";
  
  global $dbh;

  $dbh = mysqli_connect($dbhost, $username, $password, $dbname, $dbport); 

  if ($dbh){
  	 echo "<p>You are connected to the DB</p>\n";
  } else {
  	  echo "Sorry, no connection\n";
	}

  // Check connection pre-5.2.9
  if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  
}  // End function db_connect


function show_customers($db) {

  $query_string = "SELECT * FROM Customers";
  $result = mysqli_query($db, $query_string);
  if (mysqli_num_rows($result) > 0) {
	echo "Select returned " . mysqli_num_rows($result) . " rows.\n"; 

	// build display table
	echo "<table>\n<tr>\n";
	echo "<th>First</th>\n";
	echo "<th>Last</th>\n";
	echo "<th>Age</th>\n";
	echo "<th>SSN</th>\n";
	echo "</tr>\n";
	
	while ($row = mysqli_fetch_row($result)) {
	  echo "<tr>\n";
	  echo "<td>$row[0]</td>\n";
	  echo "<td>$row[1]</td>\n";
	  echo "<td>$row[2]</td>\n";
	  echo "<td>$row[3]</td>\n";
	  echo "</tr>\n";
	}
	echo "</table>\n";

    /* free result set */
	mysqli_close($db);
  } else {
  		 echo "No Customers to show\n";
  	} 
  
} // End function show_customers

?>