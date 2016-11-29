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
<?php
require 'scripts/DB_Scripts.php';
?>
  </head>
  <body>
      <h1>Hello World!!</h1>
	  
<?php

db_connect();
	
  $query_string = "SELECT * FROM Customers";
  // Removed- if ($result = $dbh->query($query_string)) {
  if ($result = mysqli_query($dbh, $query_string)) {
    // Removed- echo "Select returned $result->num_rows rows."; 
	echo "Select returned" . mysqli_num_rows($result) . "rows."; 

    /* free result set */
    // Removed- $result->close();
	mysqli_close($dbh);
}
?>
  </body>
</html>