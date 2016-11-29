<?
// Database Functions 

function db_connect() {

  $dbhost = "training-database.cwoucfsdiyqd.us-west-2.rds.amazonaws.com";
  $dbport = 3306;
  $dbname = "trng_database";
  $username = "db_user";
  $password = "atc12345";

$dbh = mysqli_connect($dbhost, $username, $password, $dbname, $dbport); 

  if ($dbh){
  	 echo "You are connected to the DB";
  } else {
  	  echo "Sorry, no connection";
	}

  // Check connection
  if ($dbh->connect_error) {
    die("Connection failed: " . $dbh->connect_error);
  }
  
  // Check connection pre-5.2.9
  if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
  }
  
}  // End function db_connect
?>