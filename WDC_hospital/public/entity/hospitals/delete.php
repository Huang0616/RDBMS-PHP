<?php require_once('../../../private/initialize.php');

if(!isset($_GET['hid'])){
	redirect_to(url_for('/entity/hospitals/index.php'));
}
$id = $_GET['hid'];
if(delete_hospital($id)){
	redirect_to(url_for('/entity/hospitals/index.php'));
}else{
	echo "<script> alert('Some doctors ares still hired in the hospital. You can\'t delete it!')</script>";
	echo "<script>javascript:history.go(-1)</script>";
}

close_db_connect($db);

?>

