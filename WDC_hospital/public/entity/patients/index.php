<?php require_once('../../../private/initialize.php'); ?>

<?php
	$patient_set = query_all_patients();
?>

<?php $page_title = 'Patients'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>


<div id='content'>
	<div class='pages listing'>
		<h1>Patients</h1>

		<div class='actions'>
			<a href = '<?php echo url_for('/entity/patients/add.php');?>'>Add New Patient</a>
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
						<a class = 'actions' href = '<?php echo url_for('/entity/patients/show.php?pid='.h(u($patient['pid']))); ?>'>View Details
						</a>
					</td>
					<td><a class = 'actions' href = '<?php echo url_for('/entity/patients/edit.php?pid='.h(u($patient['pid']))); ?>'>Edit</a></td>
					<td><a class = 'actions' href = '<?php echo url_for('/entity/patients/delete.php?pid='.h(u($patient['pid'])));?>'>Delete</a></td>
				</tr>
			<?php } ?>
		</table>
		<?php mysqli_free_result($patient_set); ?>
	</div>
</div>


<?php include(SHARED_PATH . '/main_footer.php'); ?>
