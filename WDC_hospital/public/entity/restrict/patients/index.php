<?php require_once('../../../../private/initialize.php'); ?>

<?php
	$name = '';
	if(is_post_request()){
		$name = $_POST['name'];
		$patient_set = query_patient_by_name($name);
	}else{
		$name = 'input patient name';
		$patient_set = query_all_patients();
	}
?>

<?php $page_title = 'Patients'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>


<div id='content'>
	<div class='pages listing'>
		<h1>Patients</h1>
		<div class='actions'>
			<a href = '<?php echo url_for('/entity/restrict/patients/add.php');?>'>Add New Patient</a>
			<form clsss='form' action="<?php echo url_for('/entity/restrict/patients/index.php'); ?>" method="post">
				Search: <input type="text" name="name" placeholder='<?php echo h($name);?>'>
				<input type="submit" name="Search">
			</form>
		</div>

		<table class='list'>
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>

			<?php foreach ($patient_set as $patient) { ?>
				<tr>
					<td><?php echo h($patient['pid']); ?></td>
					<td><?php echo h($patient['pfname']); ?></td>
					<td><?php echo h($patient['plname']); ?></td>
					<td><?php echo h($patient['pgender']) ;?></td>
					<td>
						<a class = 'actions' href = '<?php echo url_for('/entity/restrict/patients/show.php?pid='.h(u($patient['pid']))); ?>'>View Details
						</a>
					</td>
					<td><a class = 'actions' href = '<?php echo url_for('/entity/restrict/patients/edit.php?pid='.h(u($patient['pid']))); ?>'>Edit</a></td>
					<td><a class = 'actions' href = '<?php echo url_for('/entity/restrict/patients/delete.php?pid='.h(u($patient['pid'])));?>' onclick="return confirm('Are you sure to delete it?')">Delete</a></td>
				</tr>
			<?php } ?>
		</table>
		<?php mysqli_free_result($patient_set); ?>
	</div>
</div>


<?php include(SHARED_PATH . '/main_footer.php'); ?>
