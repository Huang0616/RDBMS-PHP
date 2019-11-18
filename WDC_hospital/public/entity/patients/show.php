<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Patient'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id='content'>
	<a class='back_link' href = '<?php echo url_for('/entity/patients/index.php');?>'>
		&laquo;Back to List
	</a>
	<div id='show_page'>
		Patient ID : <?php echo h($_GET['id']??'1'); ?>
	</div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>