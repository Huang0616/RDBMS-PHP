<?php require_once('../../../../private/initialize.php');

if(!isset($_GET['pid'])){
	redirect_to(url_for('/entity/restrict/patients/index.php'));
}
$id = $_GET['pid'];
if(delete_patient($id)){
	redirect_to(url_for('/entity/restrict/patients/index.php'));
}else{
	echo "<script> alert('The patient has some treatment records. You can\'t delete it!')</script>";
	echo "<script>javascript:history.go(-1)</script>";
}

close_db_connect($db);

?>

