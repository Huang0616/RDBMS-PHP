<?php require_once('../../../private/initialize.php'); ?>

<?php
  $hospitals = query_all_hospitals();
?> 

<?php $page_title = 'Hospitals'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>Hospitals</h1>

    <div class="actions">
      <a class="action" href = '<?php echo url_for('/entity/hospitals/add.php');?>'>Add New Hospital</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
  	    <th>City</th>
        <th>State</th>
        <th>Zipcode</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php foreach($hospitals as $hospital) { ?>
        <tr>
          <td><?php echo h($hospital['hid']); ?></td>
          <td><?php echo h($hospital['hname']); ?></td>
          <td><?php echo h($hospital['hst_address']); ?></td>
          <td><?php echo h($hospital['hst_city']); ?></td>
    	    <td><?php echo h($hospital['hstate']); ?></td>
          <td><?php echo h($hospital['hzip']); ?></td>
          <td><a class="action" href="<?php echo url_for('/entity/hospitals/show.php?hid=' . h(u($hospital['hid']))); ?>">View Details</a></td>
          <td><a class="action" href="<?php echo url_for('/entity/hospitals/edit.php?hid=' . h(u($hospital['hid']))); ?>">Edit</a></td>
          <td><a class="action" href = '<?php echo url_for('/entity/hospitals/delete.php?hid='.h(u($hospital['hid'])));?>' onclick="return confirm('Are you sure to delete it?')">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
