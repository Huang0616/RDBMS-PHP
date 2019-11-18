<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Main Menu'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li>
      	<div><a href="<?php echo url_for('/entity/doctors/index.php'); ?>">Doctors</a></div>
      </li>
      <li>
      	<div><a href="<?php echo url_for('/entity/patients/index.php'); ?>">Patients</a></div>
      </li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
