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
        <li><a href="<?php echo url_for('/entity/index.php'); ?>">Menu</a></li>
      </ul>
    </navigation>
