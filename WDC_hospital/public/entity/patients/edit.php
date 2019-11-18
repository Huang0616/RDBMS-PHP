<?php require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
	redirect_to(url_for('/entity/patients/index.php'));
}
$id = $_GET['id'];
$fname = '';
$lname = '';
$birthday = '';
$gender = '';
$race = '';
$status = '';
if(is_post_request()){
	$id = $_POST['id']??'';
	$fname = $_POST['fname']??'';
	$lname = $_POST['lname']??'';
	$birthday = $_POST['birthday']??'';
	$gender = $_POST['gender']??'';
	$race = $_POST['race']??'';
	$status = $_POST['status']??'';
	echo "post process";
	echo 'Form Parameters<br />';
	echo 'fname: '.$fname.'<br />';
} 

?>

<?php $page_title='Edit Patients'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<h1>Edit Patient</h1>
	<form class='edit_patient' action="<?php echo url_for('/entity/patients/edit.php?id='.h(u($id))); ?>" method="post">  
		<div>Patient ID: <input type="text" name="id" value='<?php echo h($id);?>'></div>
		<div>First Name: <input type="text" name="fname" value='<?php echo h($fname);?>'></div>
		<div>Last Name: <input type="text" name="lname" value='<?php echo h($lname);?>'></div>
		<div>
			Birthday: <input type="text" name="birthday"value='<?php echo h($birthday);?>'>
		</div>
		<div>Gender: <input type="radio" name="gender" value='M'<?php if($gender=='M'){echo "			checked";} ?>>Male   
					<input type="radio" name="gender" value='F'<?php if($gender=='F'){echo "checked";} ?>>Female 
					<input type="radio" name="gender" value='U'<?php if($gender=='U'){echo "checked";} ?>>Unknown
		</div>
		<div>Race: 
			<select name='race' >
				<option value = '1'<?php if($race==1){echo "selected";} ?>>Asian</option>
				<option value = '2'<?php if($race==2){echo "selected";} ?>>Hispanic</option>
				<option value = '3'<?php if($race==3){echo "selected";} ?>>Latin American</option>
				<option value = '4'<?php if($race==4){echo "selected";} ?>>African American</option>
				<option value = '0'<?php if($race==0){echo "selected";} ?>>Others</option>
			</select>
		</div>
		<div>Status: <input type="radio" name="status" value='M'<?php if($status=='M'){echo " 			checked";} ?>>Married   
					<input type="radio" name="status" value='S'<?php if($status=='S'){echo "checked";} ?>>Single
					<input type="radio" name="status" value='D'<?php if($status=='D'){echo "checked";} ?>>Divorced
					<input type="radio" name="status" value='W'<?php if($status=='W'){echo "checked";} ?>>Widow or Widower
		</div>
		<div>Submit: <input type="Submit" name="edit_patient"></div>
	</form>
</div>
<?php include(SHARED_PATH . '/main_footer.php'); ?>