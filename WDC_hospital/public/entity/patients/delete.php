<?php require_once('../../../private/initialize.php');

if(!isset($_GET['pid'])){
	redirect_to(url_for('/entity/patients/index.php'));
}
$id = $_GET['pid'];
if(delete_patient($id)){
	redirect_to(url_for('/entity/patients/index.php'));
}else{
	echo 'fail';
}

close_db_connect($db);

?>

