<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="CoffeeCup HTML Editor (www.coffeecup.com)">
    <meta name="dcterms.created" content="Tue, 25 Oct 2016 21:01:29 GMT">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
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
?>

    <div id="containerBlock">
	  <div class="Panel">
<?php	
        show_customers($dbh);
?>
	  </div>
	  
	  <div class="Panel">
<?php
    show_parts($dbh);
?>
	  </div>
	  
	  <div class="Panel">
	    <h3>Placeholder for Order Tbl</h3>
	  </div>
<?php
    disconnect_DB($dbh);
?>
    </div>
	<br style="clear:left;" />
    <h2>All code has been condensed to functions.</h2>
  </body>
</html>