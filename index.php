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
	$fnameErr = $lnameErr = $ageErr = $ssnErr = $pnameErr = $ppriceErr = "";
	$fname = $lname = $age = $ssn = $pname = $pprice = $result = "";
	$add_to_DB = false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

      switch ($_GET["form_type"]) {
	    case "CUST":
          $result = add_customer($dbh);
		  break;
		case "PART":
		  $result = add_part($dbh);
		  break;
		default:
		  echo "form_type not set properly";
	  } 
	}
?>

   <div class="containerBlock"> <!-- User Input -->
	
	  <div class="Panel">
        <form name="AddCustForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?form_type=CUST";?>">
	      <fieldset>
	        <legend>Add a Customer to the DB</legend>
	        First Name:<br>
	        <input type="text" name="firstname">
			<span class="error"><?php echo $fnameErr; ?></span>
			<br>
	        Last Name:<br>
	        <input type="text" name="lastname">
			<span class="error"><?php echo $lnameErr; ?></span>
			<br>
	        Age:<br>
	        <input type="text" name="custage">
			<span class="error"><?php echo $ageErr; ?></span>
			<br>
	        SSN:<br>
	        <input type="text" name="custssn">	
			<span class="error"><?php echo $ssnErr; ?></span>
			<br><br>
	        <input type="submit" value="Submit">
			<span class="error"><?php report_status($result, $add_to_DB, $_GET["form_type"]); ?></span>
	      </fieldset>
	    </form> 
	  </div>
	  
	  <div class="Panel">
        <form name="AddPartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	      <fieldset>
	        <legend>Add a Part to the DB</legend>
	        Part Name:<br>
	        <input type="text" name="partname">
			<span class="error"><?php echo $pnameErr; ?></span>
	        Price:<br>
	        <input type="text" name="partprice">
			<span class="error"><?php echo $ppriceErr; ?></span>	
			<br><br>
		    <input type="submit" value="Submit">
			<span class="error"><?php report_status($result, $add_to_DB, $_GET["form_type"]); ?></span>
	      </fieldset>
	    </form> 
	  </div>
	  
	  <div class="Panel">
        <form name="AddOrderForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	      <fieldset>
	        <legend>Place an Order</legend>
	        First Name:<br>
	        <input type="text" name="firstname"><br>
	        Last Name:<br>
	        <input type="text" name="lastname"><br>
			Part Name:<br>
	        <input type="text" name="partname"><br>
			Amount:<br>	
			<input type="text" name="Quantity"><br>
		    <input type="submit" value="Submit">
	      </fieldset>
	    </form> 
	  </div>
	
	</div>  <!-- End User Input -->

    <div class="containerBlock">
	
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
    $form_type = "";
?>
  </body>
</html>