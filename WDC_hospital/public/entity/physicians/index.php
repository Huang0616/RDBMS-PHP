<?php require_once('../../../private/initialize.php'); ?>

<?php
  if(is_post_request()){
    $name = $_POST['name'];
    $physicians = query_physician_by_name($name);
  }else{
    $name = 'input physician name';
    $physicians = query_all_physicians();
  }
?>

<?php $page_title = 'Physicians'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>physicians</h1>

    <div class="actions">
      <a class="action" href = '<?php echo url_for('/entity/physicians/add.php');?>'>Add New Physician</a>
      <form clsss='form' action="<?php echo url_for('/entity/physicians/index.php'); ?>" method="post">
        Search: <input type="text" name="name" placeholder='<?php echo h($name);?>'>
        <input type="submit" name="Search" value="Search">
      </form>
    </div>



  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Field</th>
  	    <th>Phone</th>
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
