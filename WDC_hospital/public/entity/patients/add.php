<?php require_once('../../../private/initialize.php');

if(is_post_request()){
	$patient = [];
	$patient['fname'] = $_POST['pfname']??'';
	$patient['lname'] = $_POST['plname']??'';
	$patient['birthday'] = $_POST['pbd']??'';
	$patient['gender'] = $_POST['pgender']??'';
	$patient['race'] = $_POST['prace']??'';
	$patient['status'] = $_POST['pstatus']??'';
	$new_patient = add_patient($patient);
	$id = find_max_patient_id();
	if($new_patient === true){
		redirect_to(url_for('/entity/patients/show.php?pid='.h(u($id))));
	}else{
		echo "<script> alert('Something Wrong!')</script>";
		$errors = $new_patient;
	}
}else{
	$patient = [];
	$patient['fname'] = '';
	$patient['lname'] = '';
	$patient['birthday'] = '';
	$patient['gender'] = '';
	$patient['race'] = '';
	$patient['status'] = '';
}
?>



<?php $page_title='Add Patients'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Add New Patient</h1>
	<a class='back_link' href = '<?php echo url_for('/entity/patients/index.php');?>'>
		&laquo;Back to List
	</a>
	<form class='add' action="<?php echo url_for('/entity/patients/add.php');?>" method="post">
		<div style="display:none">
			<label class='xrequired'>Patient ID:</label> 
			<input type="text" name="pid" value='<?php echo(h($patient['id']));?>'>
		</div>
		<div>
			<label class='xrequired'>First Name: </label> 
			<input type="text" name="pfname" value='<?php echo(h($patient['fname']));?>'>
			<span class='errors'><?php echo $errors['fname']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Last Name: </label> 
			<input type="text" name="plname" value='<?php echo(h($patient['lname']));?>'>
			<span class='errors'><?php echo $errors['lname']??'';?></span>
		</div>
		<div>
			<label class='xrequired'>Birthday: </label> 
			<input type="text"name="pbd"value='<?php echo(h($patient['birthday']));?>'>
			<span class='errors'><?php echo $errors['birthday']??'';?></span>
		</div>
		<div>
			<label>Gender: </label> 
			<input type="radio" name="pgender" value='M'<?php if($patient['gender']=='M'){echo "checked";} ?>>Male   
					<input type="radio" name="pgender" value='F'<?php if($patient['gender']=='F'){echo "checked";} ?>>Female 
					<input type="radio" name="pgender" value='U'<?php if($patient['gender']=='U'){echo "checked";} ?>>Unknown
					<span class='errors'><?php echo $errors['gender']??'';?></span>
		</div>
		<div>
			<label>Race: </label>
			<select name='prace' >
				<option value = ''></option>
				<option value = 'ASIAN'<?php if($patient['race']=='ASIAN'){echo "selected";} ?>>Asian</option>
				<option value = 'HISPANIC'<?php if($patient['race']=='HISPANIC'){echo "selected";} ?>>Hispanic</option>
				<option value = 'AMEIRCAN'<?php if($patient['race']=='AMERICAN'){echo "selected";} ?>>American</option>
				<option value = 'AFRICAN'<?php if($patient['race']=='AFRICAN'){echo "selected";} ?>>African</option>
				<option value = 'LATINO'<?php if($patient['race']=='LATINO'){echo "selected";} ?>>Latino</option>
				<option value = 'Others'<?php if($patient['race']=='Others'){echo "selected";} ?>>Others</option>
			</select>
			<span class='errors'><?php echo $errors['race']??'';?></span>
		</div>
		<div>
			<label>Status: </label>
					<input type="radio" name="pstatus" value='M'<?php if($patient['status']=='M'){echo " 			checked";} ?>>Married   
					<input type="radio" name="pstatus" value='S'<?php if($patient['status']=='S'){echo "checked";} ?>>Single
					<input type="radio" name="pstatus" value='D'<?php if($patient['status']=='D'){echo "checked";} ?>>Divorced
					<input type="radio" name="pstatus" value='W'<?php if($patient['status']=='W'){echo "checked";} ?>>Widow or Widower
					<span class='errors'><?php echo $errors['status']??'';?></span>
		</div>
		<div><label> </label><input type="Submit" name="add_patient" value = "Add"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>