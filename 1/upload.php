
<?php 
include "../storescripts/connect_to_mysql.php";
if (isset($_POST['mobile'])) {
    $mobile = mysql_real_escape_string($_POST['mobile']);

	$sql = mysql_query("INSERT INTO file_upload(mobile) VALUES('$mobile')") or die (mysql_error());
    $pid = mysql_insert_id();

     }
?>



<?php
if(!empty($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];

$temp = explode(".", $_FILES["userImage"]["name"]);
$newfilename = round($mobile).'.'.
end($temp);

$targetPath = "Upload_Files/".$newfilename;

if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img src="images/logo.png" width="100px" height="100px" />
<?php
}
}
}
?>


<!--<?php echo $targetPath; ?>-->



