<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
include "storescripts/connect_to_mysql.php"; 
if (isset($_POST['email'])) {
    $email = $_POST['email'];
}

$sql = mysql_query("INSERT INTO newsletter(email) VALUES ('$email')") or die(mysql_error());
	 $pid = mysql_insert_id();
	header("location: index.php?Registered_newsletter"); 
    exit();

?>