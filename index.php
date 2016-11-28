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

require 'scripts/DB_Scripts.php';

db_connect();
	
  $query_string = "SELECT * FROM Customers";
  if ($result = $dbh->query($query_string)) {
    echo "<p>Select returned $result->num_rows rows.</p>";  

    /* free result set */
    $result->close();
}
?>
  </body>
</html>