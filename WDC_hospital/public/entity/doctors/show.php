<?php require_once('../../../private/initialize.php'); ?>

<?php

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

?>

<?php $page_title = 'Show Doctor';?>
<?php include(SHARED_PATH . '/main_header.php'); ?>


	<div id='content'>
		<a class='back_link' href= '<?php echo url_for('/entity/doctors/index.php');?>'>&laquo; Back to List
		</a>
		<div id='page_show'>
			ID: <?php echo h($id); ?>
		</div>
	</div>

	

<?php include(SHARED_PATH . '/main_footer.php'); ?>