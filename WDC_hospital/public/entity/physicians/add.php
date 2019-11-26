<?php require_once('../../../private/initialize.php');

if(is_post_request()){
	$physician = [];
	$physician['phid'] = $_POST['phid']??'';
	$physician['phfname'] = $_POST['phfname']??'';
	$physician['phspl'] = $_POST['phspl']??'';
	$physician['phtel'] = $_POST['phtel']??'';
	$physician['hname'] = $_POST['hname']??'';
	$new_physician = add_physician($physician);
	$id = find_max_physician_id();
	if($new_physician === true){
		redirect_to(url_for('/entity/physicians/show.php?phid='.h(u($id))));
	}else{
		echo "<script> alert('Something Wrong!')</script>";
		$errors = $new_physician;
	}
}else{
	$physician = [];
	$physician['phfname'] = '';
	$physician['phspl'] = '';
	$physician['phtel'] = '';
	$physician['hname'] = '';
	
}
$hospitals = query_all_hospitals_name();
?>

<?php $page_title='Add Physician'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Add New Physician</h1>
	<a class='back_link' href = "javascript:history.go(-1)">
		&laquo;Back to List
	</a>
	<form class='add' action="<?php echo url_for('/entity/physicians/add.php'); ?>" method="post">  
		<div style='display:none'>physician ID: <input type="text" name="phid" value='<?php echo h($phid);?>'>
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
					<option value='<?php echo h($hos['hname']);?>'><?php echo h($hos['hname']);?></option>
				<?php } ?>
			</select>
			<span class='errors'><?php echo $errors['hname']??'';?></span>
		</div>
		<div><label> </label><input type="Submit" name="add_physician" value = "Submit"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>