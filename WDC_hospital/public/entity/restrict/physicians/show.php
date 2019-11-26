<?php require_once('../../../../private/initialize.php'); ?>

<?php

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['phid'] ?? '1'; // PHP > 7.0
$physician = mysqli_fetch_assoc(query_physician($id));
?>

<?php $page_title = 'Show Physician';?>
<?php include(SHARED_PATH . '/main_header.php'); ?>


<div id='content'>
	<a class='back_link' href = '<?php echo url_for('/entity/restrict/physicians/index.php');?>'>
		&laquo;Back to List
	</a>
	<div id='show_page'>
		<label>Physician ID : </label><?php echo h($physician['phid']); ?>
	</div>
	<div id='show_page'>
		<label>Name : </label><?php echo h($physician['phfname']); ?>
	</div>
	<div id='show_page'>
		<label>Telephone Number : </label><?php echo h($physician['phtel']); ?>
	</div>
	<div id='show_page'>
		<label>Field : </label><?php echo h($physician['phspl']); ?>
	</div>
	<div id='show_page'>
		<label>Hospital : </label><?php echo h($physician['hname']); ?>
	</div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>