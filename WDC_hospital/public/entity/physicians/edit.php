<?php require_once('../../../private/initialize.php');
if(!isset($_GET['phid'])){
	redirect_to(url_for('/entity/physicians/index.php'));
}
if(is_post_request()){
	$physician = [];
	$physician['phid'] = $_POST['phid']??'';
	$physician['phfname'] = $_POST['phfname']??'';
	$physician['phspl'] = $_POST['phspl']??'';
	$physician['phtel'] = $_POST['phtel']??'';
	$physician['hname'] = $_POST['hname']??'';
	$update_physician = update_physician($physician);
	if($update_physician === true){
		redirect_to(url_for('/entity/physicians/show.php?phid='.h(u($physician['phid']))));
	}else{
		echo "<script> alert('Something Wrong!')</script>";
		$errors = $update_physician;
	}
} else{
	$id = $_GET['phid'];
	$physician = mysqli_fetch_assoc(query_physician($id));
}
$hospitals = query_all_hospitals_name();
?>
<?php $page_title='Edit physicians'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Edit physician</h1>
	<a class='back_link' href = "javascript:history.go(-1)">
		&laquo;Back
	</a>
	<form class='edit_patient' action="<?php echo url_for('/entity/physicians/edit.php?phid='.h(u($physician['phid']))); ?>" method="post"> 
		<div style='display:none'>physician ID: <input type="text" name="phid" value='<?php echo h($physician['phid']);?>'>
		</div>
		<div>
			<label class='xrequired'>Name: </label> 
			<input type="text" name="phfname" value='<?php echo h($physician['phfname']);?>'>
			<span class='errors'><?php echo $errors['phfname']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Field: </label> 
			<input type="text" name="phspl" value='<?php echo h($physician['phspl']);?>'>
			<span class='errors'><?php echo $errors['phspl']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Telephone Number: </label> 
			<input type="text" name="phtel" value='<?php echo h($physician['phtel']);?>'>
			<span class='errors'><?php echo $errors['phtel']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Hospital: </label> 
			<select name="hname">
				<?php foreach ($hospitals as $hos) { ?>
					<option value='<?php echo h($hos['hname']);?>' <?php if($physician['hname']==$hos['hname']){echo "selected";} ?>><?php echo h($hos['hname']);?></option>
				<?php } ?>
			</select>
			<span class='errors'><?php echo $errors['hname']??'';?></span>
		</div>
		<div><label> </label><input type="Submit" name="edit_physician" value = "Submit"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>