/* Database Functions */

function db_connect() {

  $dbhost = "training-database.cwoucfsdiyqd.us-west-2.rds.amazonaws.com";
  $dbport = 3306;
  $dbname = "trng_database";
  $username = "db_user";
  $password = "atc12345";

$dbh = mysqli_connect($dbhost, $username, $password, $dbname, $dbport); 

  if ($dbh){
  	 echo "<p>You are connected to the DB</p>";
  } else {
  	  echo "<p>Sorry, no connection</p>";
	}
	
  if ($dbh->connect_errno) {
    echo "<p>Sorry, no connection</p>";
    exit();
  }
  
}
