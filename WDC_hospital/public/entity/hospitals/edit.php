<?php require_once('../../../private/initialize.php');
if(!isset($_GET['hid'])){
	redirect_to(url_for('/entity/hospitals/index.php'));
}
if(is_post_request()){
	$hospital = [];
	$hospital['hid'] = $_POST['hid']??'';
	$hospital['hname'] = $_POST['hname']??'';
	$hospital['hst_address'] = $_POST['hst_address']??'';
	$hospital['hst_city'] = $_POST['hst_city']??'';
	$hospital['hstate'] = $_POST['hstate']??'';
	$hospital['hzip'] = $_POST['hzip']??'';
	$update_hospital = update_hospital($hospital);
	if($update_hospital === true){
		redirect_to(url_for('/entity/hospitals/index.php'));
	}else{
		echo "<script> alert('Something Wrong!')</script>";
		$errors = $update_hospital;
	}
} else{
	$id = $_GET['hid'];
	$hospital = mysqli_fetch_assoc(query_hospital($id));
}

?>
<?php $page_title='Edit hospitals'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Edit hospital</h1>
	<a class='back_link' href = "javascript:history.go(-1)">
		&laquo;Back
	</a>
	<form class='edit' action="<?php echo url_for('/entity/hospitals/edit.php?hid='.h(u($hospital['hid']))); ?>" method="post">  
		<div style='display:none'>hospital ID: <input type="text" name="hid" value='<?php echo h($id);?>'>
		</div>
		<div>
			<label class='xrequired'>Name: </label> 
			<input type="text" name="hname" value='<?php echo h($hospital['hname']);?>'>
			<span class='errors'><?php echo $errors['hname']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Address: </label> 
			<input type="text" name="hst_address" value='<?php echo h($hospital['hst_address']);?>'>
			<span class='errors'><?php echo $errors['hst_address']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>City: </label> 
			<input type="text" name="hst_city" value='<?php echo h($hospital['hst_city']);?>'>
			<span class='errors'><?php echo $errors['hst_city']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>State: </label> 
			<input type="text" name="hstate" value='<?php echo h($hospital['hstate']);?>'>
			<span class='errors'><?php echo $errors['hstate']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Zipcode: </label> 
			<input type="text" name="hzip" value='<?php echo h($hospital['hzip']);?>'>
			<span class='errors'><?php echo $errors['hzip']??'';?></span>
		</div>
		<div><label> </label><input type="Submit" name="edit_hospital"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>