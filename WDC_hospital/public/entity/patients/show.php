<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Patient'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<?php
	if(!isset($_GET['pid'])){
		redirect_to(url_for('/entity/patients/index.php'));
	}else{
		$id = $_GET['pid'];
	}
	$patient = mysqli_fetch_assoc(query_patient($id));
?>

<div id='content'>
	<a class='back_link' href = '<?php echo url_for('/entity/patients/index.php');?>'>
		&laquo;Back to List
	</a>
	<div id='show_page'>
		Patient ID : <?php echo h($patient['pid']); ?>
	</div>
	<div id='show_page'>
		First Name : <?php echo h($patient['pfname']); ?>
	</div>
	<div id='show_page'>
		Last Name : <?php echo h($patient['plname']); ?>
	</div>
	<div id='show_page'>
		Gender : <?php echo h($patient['pgender']); ?>
	</div>
	<div id='show_page'>
		Birthday : <?php echo h($patient['pbd']); ?>
	</div>
	<div id='show_page'>
		Race : <?php echo h($patient['prace']); ?>
	</div>
	<div id='show_page'>
		Marital Status: <?php echo h($patient['pstatus']); ?>
	</div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>