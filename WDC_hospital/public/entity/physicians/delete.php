<?php require_once('../../../private/initialize.php');

if(!isset($_GET['phid'])){
	redirect_to(url_for('/entity/physicians/index.php'));
}
$id = $_GET['phid'];
if(delete_physician($id)){
	redirect_to(url_for('/entity/physicians/index.php'));
}else{
	echo "<script> alert('Some records related to the physician. You can\'t delete it!')</script>";
	echo "<script>javascript:history.go(-1)</script>";
}

close_db_connect($db);

?>

