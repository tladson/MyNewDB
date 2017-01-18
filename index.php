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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--	<script src="js/main.js"></script>  
-->
    <script>
	$(document).ready(function(){
	  $("#addremovechoice").change(function() {
         $("#addcustpanel").toggle();
		 $("#removecustpanel").toggle();
      });
	});
	</script>

  </head>
  <body>
    <center><h1>Customers Order Log</h1></center>
<?php
    // Database Functions 

    require 'scripts/DB_Scripts.php'; 
    db_connect();
	$fnameErr = $lnameErr = $ageErr = $ssnErr = $pnameErr = $ppriceErr = $amtErr = $ord_fnameErr = $ord_lnameErr = $ord_pnameErr = "";
	$fname = $lname = $age = $ssn = $pname = $pprice = $amt = $result = "";
	$add_to_DB = false;
	$ftype = $_GET["form_type"];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

      switch ($ftype) {
	    case "CUST":
          $result = add_customer($dbh);
		  break;
		case "PART":
		  $result = add_part($dbh);
		  break;
		case "ORD":
		  $result = add_order($dbh);
		  break;
		default:
		  echo "form_type not set properly";
	  } 
	}
?>

   <div class="containerBlock"> <!-- User Input -->
	
	  <div class="Panel">
	    <h3>Customer Panel</h3>
	      <form>
		    <select id="addremovechoice">
			  <option value="add" selected>Add</option>
			  <option value="remove">Remove</option>
			</select>
		  </form>	
		<br><br> 
	    <div id="addcustpanel">
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
			  <span class="error"><?php if ($ftype == 'CUST') report_status($result, $add_to_DB, $ftype); ?></span>
	        </fieldset>
	      </form> 
		</div> <!-- end AddCustPanel -->
		<div id="removecustpanel">
		  <form>
		    <fieldset>
			  <legend>Remove Customer from the DB</legend>
			  Cust ID:<br>
	          <input type="text" name="custid">
			  <br>
			  First Name:<br>
	          <input type="text" name="firstname">
			  <br>
			  Last Name:<br>
	          <input type="text" name="lastname">
			  <br>
			  SSN:<br>
	          <input type="text" name="ssn">
			  <br><br>
	          <input type="submit" value="Submit">
			</fieldset>
		  </form>
		</div> <!-- end RemoveCustPanel -->
		<script>
		  $("#removecustpanel").hide();
		</script>
	  </div>
	  
	  <div class="Panel">
        <form name="AddPartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?form_type=PART";?>">
	      <fieldset>
	        <legend>Add a Part to the DB</legend>
	        Part Name:<br>
	        <input type="text" name="partname">
			<span class="error"><?php echo $pnameErr; ?></span>
			<br>
	        Price:<br>
	        <input type="text" name="partprice">
			<span class="error"><?php echo $ppriceErr; ?></span>	
			<br><br>
		    <input type="submit" value="Submit">
			<span class="error"><?php if ($ftype == 'PART') report_status($result, $add_to_DB, $ftype); ?></span>
	      </fieldset>
	    </form> 
	  </div>
	  
	  <div class="Panel">
        <form name="AddOrderForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?form_type=ORD";?>">
	      <fieldset>
	        <legend>Place an Order</legend>
	        First Name:<br>
	        <input type="text" name="firstname">
			<span class="error"><?php echo $ord_fnameErr; ?></span>
			<br>
	        Last Name:<br>
	        <input type="text" name="lastname">
			<span class="error"><?php echo $ord_lnameErr; ?></span>
			<br>
			Part Name:<br>
	        <input type="text" name="partname">
			<span class="error"><?php echo $ord_pnameErr; ?></span>
			<br>
			Amount:<br>	
			<input type="text" name="amount">
			<span class="error"><?php echo $amtErr; ?></span>
			<br><br>
		    <input type="submit" value="Submit">
			<span class="error"><?php if ($ftype == 'ORD') report_status($result, $add_to_DB, $ftype); ?></span>
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