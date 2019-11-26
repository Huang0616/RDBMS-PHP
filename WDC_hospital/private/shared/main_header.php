<?php
  if(!isset($page_title)) { $page_title = 'WDC'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>WDC - <?php echo $page_title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>WDC Hospital Management System</h1>
    </header>

    <navigation>
      <ul>
        <li><a href="<?php if($_SESSION['usertype'] == 'admin'){echo url_for('/entity/index.php');}else{echo url_for('/entity/restrict/index.php');} ?>">Menu</a></li>
        <li><span>Current User: <?php echo $_SESSION['username'];?></span></li>
        <li><a href="<?php echo url_for('/entity/login/index.php'); ?>">Exit</a></li>
      </ul>
    </navigation>
