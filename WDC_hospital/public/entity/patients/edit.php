<?php require_once('../../../private/initialize.php');

if(!isset($_GET['pid'])){
	redirect_to(url_for('/entity/patients/index.php'));
}

if(is_post_request()){
	$patient = [];
	$patient['id'] = $_POST['pid']??'';
	$patient['fname'] = $_POST['pfname']??'';
	$patient['lname'] = $_POST['plname']??'';
	$patient['birthday'] = $_POST['pbd']??'';
	$patient['gender'] = $_POST['pgender']??'';
	$patient['race'] = $_POST['prace']??'';
	$patient['status'] = $_POST['pstatus']??'';
	$id = $_POST['pid']??'';
	$update_patient = update_patient($patient);
	if($update_patient === true){
		redirect_to(url_for('/entity/patients/show.php?pid='.h(u($id))));
	}else{
		$errors = $update_patient;
	}
} else{
	$id = $_GET['pid'];
	$patient = mysqli_fetch_assoc(query_patient($id));
	$patient['id'] = $patient['pid'];
	$patient['fname'] = $patient['pfname'];
	$patient['lname'] = $patient['plname'];
	$patient['birthday'] = $patient['pbd'];
	$patient['gender'] = $patient['pgender'];
	$patient['race'] = $patient['prace'];
	$patient['status'] = $patient['pstatus'];
}

?>

<?php $page_title='Edit Patients'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Edit Patient</h1>
	<a class='back_link' href = '<?php echo url_for('/entity/patients/index.php');?>'>
		&laquo;Back
	</a>
	<form class='edit_patient' action="<?php echo url_for('/entity/patients/edit.php?pid='.h(u($id))); ?>" method="post">  
		<div style='display:none'>Patient ID: <input type="text" name="pid" value='<?php echo h($id);?>'></div>
		<div>First Name: <input type="text" name="pfname" value='<?php echo h($patient['fname']);?>'>
			<span class='errors'><?php echo $errors['fname']??'';?></span>
		</div>
		<div>Last Name: <input type="text" name="plname" value='<?php echo h($patient['lname']);?>'>
			<span class='errors'><?php echo $errors['lname']??'';?></span>
		</div>
		<div>
			Birthday: <input type="text" name="pbd"value='<?php echo h($patient['birthday']);?>'>
			<span class='errors'><?php echo $errors['birthday']??'';?></span>
		</div>
		<div>Gender: <input type="radio" name="pgender" value='M'<?php if($patient['gender']=='M'){echo "			checked";} ?>>Male   
					<input type="radio" name="pgender" value='F'<?php if($patient['gender']=='F'){echo "checked";} ?>>Female 
					<input type="radio" name="pgender" value='U'<?php if($patient['gender']=='U'){echo "checked";} ?>>Unknown
					<span class='errors'><?php echo $errors['race']??'';?></span>
		</div>
		<div>Race: 
			<select name='prace' >
				<option value = 'ASIAN'<?php if($patient['race']=='ASIAN'){echo "selected";} ?>>Asian</option>
				<option value = 'HISPANIC'<?php if($patient['race']=='HISPANIC'){echo "selected";} ?>>Hispanic</option>
				<option value = 'AMEIRCAN'<?php if($patient['race']=='AMERICAN'){echo "selected";} ?>>American</option>
				<option value = 'AFRICAN'<?php if($patient['race']=='AFRICAN'){echo "selected";} ?>>African</option>
				<option value = 'LATINO'<?php if($patient['race']=='LATINO'){echo "selected";} ?>>Latino</option>
				<option value = 'Others'<?php if($patient['race']=='Others'){echo "selected";} ?>>Others</option>
			</select>
			<span class='errors'><?php echo $errors['race']??'';?></span>
		</div>
		<div>Status: <input type="radio" name="pstatus" value='M'<?php if($patient['status']=='M'){echo " 			checked";} ?>>Married   
					<input type="radio" name="pstatus" value='S'<?php if($patient['status']=='S'){echo "checked";} ?>>Single
					<input type="radio" name="pstatus" value='D'<?php if($patient['status']=='D'){echo "checked";} ?>>Divorced
					<input type="radio" name="pstatus" value='W'<?php if($patient['status']=='W'){echo "checked";} ?>>Widow or Widower
					<span class='errors'><?php echo $errors['status']??'';?></span>
		</div>
		<div><input type="Submit" name="edit_patient"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>