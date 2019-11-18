<?php require_once('../../../private/initialize.php'); ?>

<?php
  $doctors = [
    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
  ];
?>

<?php $page_title = 'Doctors'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Doctors</h1>

    <div class="actions">
      <a class="action" href="">Add New Doctor</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php foreach($doctors as $doctor) { ?>
        <tr>
          <td><?php echo h($doctor['id']); ?></td>
          <td><?php echo h($doctor['position']); ?></td>
          <td><?php echo $doctor['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($doctor['menu_name']); ?></td>
          <td><a class="action" href="<?php echo url_for('/entity/doctors/show.php?id=' . h(u($doctor['id']))); ?>">View</a></td>
          <td><a class="action" href="">Edit</a></td>
          <td><a class="action" href="">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
