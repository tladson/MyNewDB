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
    <center><h1>Customers Order Log</h1></center>
<?php
    // Database Functions 

    require 'scripts/DB_Scripts.php'; 
    db_connect();
?>

    <div id="containerBlock">
	  // Customers panel
	  <div class="Panel">
	    <center><h3>Customers<br />
<?php	
        show_customers($dbh);
?>
	  </center></div>
<!--	  
	  // Parts panel
	  <div class="Panel">
	    <center><h3>Parts<br />
<?php
    show_parts($dbh);
?>
	  </center></div>

<!--
  
	  // Orders panel
	  <div class="Panel">
	    <center><h3>Orders  </h3>
<?php
	  show_orders($dbh);
?>

	  </center></div>
-->
    </div>
	<br style="clear:left;" />

<?php
    disconnect_DB($dbh);
?>
    <h3>Last Call for Alcohol!</h3>
  </body>
</html>