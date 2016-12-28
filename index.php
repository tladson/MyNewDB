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
	
	  <!-- Customers panel -->
	  <div class="Panel">
	    <center><h3>Customers<br />
<?php	
        show_customers($dbh);
?>
	  </center></div>
	  
	  <!-- Parts panel -->
	  <div class="Panel" style="width:20%;">
	    <center><h3>Parts<br />
<?php
    show_parts($dbh);
?>
	  </center></div>


  
	  <!-- Orders panel -->
	  <div id="orderPanel">
	    <center><h3>Orders<br />  
<?php
	  show_orders($dbh);
?>

	  </center></div>

    </div>
	<br style="clear:left;" />

<?php
    disconnect_DB($dbh);
?>

<?php
	echo "<form action=\"addCustomer($dbh)\">";
?>
	  <fieldset>
	    <legend>Add a Customer to the DB</legend>
	    First Name:<br>
	    <input type="text" name="firstname"><br>
	    Last Name:<br>
	    <input type="text" name="lastname"><br>
	    Age:<br>
	    <input type="text" name="age"><br>
	    SSN:<br>
	    <input type="text" name="ssn"><br>	
		<input type="submit" value="Submit">
	  </fieldset>
	</form> 
  </body>
</html>