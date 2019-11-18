<?php require_once('../../../private/initialize.php'); ?>

<?php
  $patients = [
    ['id' => '1', 'name' => '1', 'city' => '1', 'zipcode' => 'About Globe Bank'],
    ['id' => '2', 'name' => '2', 'city' => '1', 'zipcode' => 'Consumer'],
    ['id' => '3', 'name' => '3', 'city' => '1', 'zipcode' => 'Small Business'],
    ['id' => '4', 'name' => '4', 'city' => '1', 'zipcode' => 'Commercial'],
  ];
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
				<th>Name</th>
				<th>Citu</th>
				<th>Zipcode</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>

			<?php foreach ($patients as $patient) { ?>
				<tr>
					<td><?php echo h($patient['id']); ?></td>
					<td><?php echo h($patient['name']); ?></td>
					<td><?php echo h($patient['city']); ?></td>
					<td><?php echo h($patient['zipcode']) ;?></td>
					<td>
						<a class = 'actions' href = '<?php echo url_for('/entity/patients/show.php?id='.h(u($patient['id']))); ?>'>View
						</a>
					</td>
					<td><a class = 'actions' href = '<?php echo url_for('/entity/patients/edit.php?id='.h(u($patient['id']))); ?>'>Edit</a></td>
					<td><a class = 'actions' href = 'Delete'>Delete</a></td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>


<?php include(SHARED_PATH . '/main_footer.php'); ?>
