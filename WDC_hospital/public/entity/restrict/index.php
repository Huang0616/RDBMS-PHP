<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Main Menu'; ?>
<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li>
      	<div class='entity'><a href="<?php echo url_for('/entity/restrict/physicians/index.php'); ?>">Physicians</a>
        </div>
      </li>
      <li>
      	<div class='entity'><a href="<?php echo url_for('/entity/restrict/patients/index.php'); ?>">Patients</a>
        </div>
      </li>
      <li>
        <div class='entity'><a href="<?php echo url_for('/index.php'); ?>">Diseases</a>
        </div>
      </li>
      <li>
        <div class='entity'><a href="<?php echo url_for('/index.php'); ?>">Treatments</a>
        </div>
      </li>
      <li>
        <div class='entity'><a href="<?php echo url_for('/index.php'); ?>">Medical Records</a>
        </div>
      </li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
