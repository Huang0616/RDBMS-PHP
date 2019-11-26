<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Show Hospital'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<?php
	if(!isset($_GET['hid'])){
		redirect_to(url_for('/entity/hospitals/index.php'));
	}else{
		$id = $_GET['hid'];
	}
	$Hospital = mysqli_fetch_assoc(query_hospital($id));
	$physicians = query_physician_by_hospital($id);

?>

<div id='content'>
	<a class='back_link' href = '<?php echo url_for('/entity/hospitals/index.php');?>'>
		&laquo;Back to List
	</a>
	<h1>
		<?php echo h($Hospital['hname']); ?> 
	</h1>
	<h2>
		Hospital ID: <?php echo h($Hospital['hid']); ?>
	</h2>
	<h2>
		Physician list:
	</h2>
  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Field</th>
  	    <th>Telephone</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php foreach($physicians as $physician) { ?>
        <tr>
          <td><?php echo h($physician['phid']); ?></td>
          <td><?php echo h($physician['phfname']); ?></td>
          <td><?php echo h($physician['phspl']); ?></td>
    	  <td><?php echo h($physician['phtel']); ?></td>
          <td><a class="action" href="<?php echo url_for('/entity/physicians/show.php?phid=' . h(u($physician['phid']))); ?>">View Details</a></td>
          <td><a class="action" href="<?php echo url_for('/entity/physicians/edit.php?phid=' . h(u($physician['phid']))); ?>">Edit</a></td>
          <td><a class="action" href = '<?php echo url_for('/entity/physicians/delete.php?phid='.h(u($physician['phid'])));?>' onclick="return confirm('Are you sure to delete it?')">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
  </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
