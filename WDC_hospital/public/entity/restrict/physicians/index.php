<?php require_once('../../../../private/initialize.php'); ?>

<?php
  $physicians = query_all_physicians();
?>

<?php $page_title = 'Physicians'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div class="subjects listing">
    <h1>physicians</h1>
    <a class='back_link' href = '<?php echo url_for('/entity/restrict/index.php');?>'>
    &laquo;Back
    </a>
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
          <td><a class="action" href="<?php echo url_for('/entity/restrict/physicians/show.php?phid=' . h(u($physician['phid']))); ?>">View Details</a></td>
    	  </tr>
      <?php } ?>
  	</table>
  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
