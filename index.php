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

  require 'scripts/DB_Scripts.php';
  db_connect();
	
  show_customers($dbh);
?>
    <h2>All code has been condensed to functions.</h2>
  </body>
</html>