<?php require_once('../../../../private/initialize.php'); ?>

<?php $page_title = 'Show Patient'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<?php
	if(!isset($_GET['pid'])){
		redirect_to(url_for('/entity/restrict/patients/index.php'));
	}else{
		$id = $_GET['pid'];
	}
	$patient = mysqli_fetch_assoc(query_patient($id));
?>

<div id='content'>
	<a class='back_link' href = "javascript:history.go(-1)">
		&laquo;Back to List
	</a>
	<div id='show_page'>
		<label>Patient ID:</label>  <?php echo h($patient['pid']); ?>
	</div>
	<div id='show_page'>
		<label>First Name: </label><?php echo h($patient['pfname']); ?>
	</div>
	<div id='show_page'>
		<label>Last Name : </label><?php echo h($patient['plname']); ?>
	</div>
	<div id='show_page'>
		<label>Gender : </label><?php echo h($patient['pgender']); ?>
	</div>
	<div id='show_page'>
		<label>Birthday : </label><?php echo h($patient['pbd']); ?>
	</div>
	<div id='show_page'>
		<label>Race : </label><?php echo h($patient['prace']); ?>
	</div>
	<div id='show_page'>
		<label>Marital Status: </label><?php echo h($patient['pstatus']); ?>
	</div>
	<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a class = 'actions' href = '<?php echo url_for('/entity/restrict/patients/edit.php?pid='.h(u($patient['pid']))); ?>'>Edit</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a class = 'actions' href = '<?php echo url_for('/entity/restrict/patients/delete.php?pid='.h(u($patient['pid'])));?>' onclick="return confirm('Are you sure to delete it?')">Delete</a>
	</div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
