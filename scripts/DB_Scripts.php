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

  if (!$dbh){
   	  echo "Sorry, no connection\n";

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


function show_customers($db) {

  $query_string = "SELECT * FROM Customers";
  $result = mysqli_query($db, $query_string);
  if (mysqli_num_rows($result) > 0) {
	echo mysqli_num_rows($result) . " Customers found</h3>\n";

	// build display table
	echo "<table>\n<tr>\n";
	echo "<th>Cust ID</th>\n";
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
	  echo "<td>$row[4]</td>\n";
	  echo "</tr>\n";
	}
	echo "</table>\n";

  } else {
  		 echo "No Customers to show\n";
  	} 
  
} // End function show_customers


function show_parts ($db) {

  $query_string = "SELECT * FROM Parts";
  $result = mysqli_query($db, $query_string);
  if (mysqli_num_rows($result) > 0) {
	echo mysqli_num_rows($result) . " Parts found</h3>\n"; 

	// build display table
	echo "<table>\n<tr>\n";
	echo "<th>Part ID</th>\n";
	echo "<th>Name</th>\n";
	echo "<th>Price</th>\n";
	echo "</tr>\n";
	
	while ($row = mysqli_fetch_row($result)) {
	  echo "<tr>\n";
	  echo "<td>$row[0]</td>\n";
	  echo "<td>$row[1]</td>\n";
	  echo "<td>$row[2]</td>\n";
	  echo "</tr>\n";
	}
	echo "</table>\n";

  } else {
  		 echo "No Parts to show\n";
  	} 
  
} // End function show_parts

function show_orders ($db) {

//  $query_string = "SELECT * FROM Orders";
//  $result = mysqli_query($db, $query_string);
//  if (mysqli_num_rows($result) > 0) {
//	echo mysqli_num_rows($result) . " Orders found</h3>\n"; 

	// build display table
//	echo "<table>\n";
//	echo "<tr>\n";
//	echo "<th>Order ID</th>\n";
//	echo "<th>First</th>\n";
//	echo "<th>Last</th>\n";
//	echo "<th>Part ID</th>\n";
//	echo "<th>Part Name</th>\n";	
//	echo "<th>Amount</th>\n";
//	echo "<th>Cost</th>\n";
//	echo "</tr>\n";
	
//	while ($row = mysqli_fetch_row($result)) {
//	  echo "<tr>\n";
//	  echo "<td>$row[0]</td>\n";			 // Order ID
	  
	  // get Customer Name
//	  $query_string = "SELECT Customers.First, Customer.Last From Customers WHERE Customers.Cust_ID=$row[1]"; 
//	  $custResult = mysqli_query($db, $query_string);
//	  $cust = mysqli_fetch_row($custResult);
//	  echo "<td>$cust[0]</td>\n";
//	  echo "<td>$cust[1]</td>\n";
	  
//	  echo "<td>$row[2]</td>\n"; 			// Part ID
	  
	  // get Part Name
//	  $query_string = "SELECT Parts.Name From Parts WHERE Parts.Part_ID=$row[2]";
//	  $partResult = mysqli_query($db, $query_string);
//	  $part = mysqli_fetch_row($partResult);
//	  echo "<td>$part[0]</td>\n";
	  
//	  echo "<td>$row[3]</td>\n"; 			// Order Amount
//	  echo "<td>$row[4]</td>\n";			// Order Total
//	  echo "</tr>\n";
//	}
//	echo "</table>\n";

//  } else {
//  		 echo "No Orders to show\n";
//  	} 
  
 } // End function show_orders

?>