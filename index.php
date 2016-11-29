<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Tue, 25 Oct 2016 21:01:29 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>
    
    <!--[if IE]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
      <h1>Hello World!!</h1>
	  
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
  	 echo "You are connected to the DB";
  } else {
  	  echo "Sorry, no connection";
	}

  // Check connection pre-5.2.9
  if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  
}  // End function db_connect

// require 'scripts/DB_Scripts.php';
  db_connect();
	
  $query_string = "SELECT * FROM Customers";
  $result = mysqli_query($dbh, $query_string);
  if (mysqli_num_rows($result) > 0) {
	echo "Select returned" . mysqli_num_rows($result) . "rows."; 

    /* free result set */
	mysqli_close($dbh);
}
?>
  </body>
</html>