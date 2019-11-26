<?php require_once('../../../private/initialize.php'); 

if(is_post_request()){
  $puser = [];
  $puser['username'] = $_POST['username']??'';
  $puser['password'] = $_POST['password']??'';
  $new_puser = insert_physician_user($puser);
  if($new_puser === true){
    redirect_to(url_for('/entity/login/index.php'));
  }else{
    echo "<script> alert('Something Wrong!')</script>";
  }
} 

?>



<?php $page_title = 'Register'; ?>
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

<div id="content">
  <div class="subjects listing">
    <h1 style="text-align: center">Register</h1>
    <div  style="text-align: center">
      <a class='back_link' href = "javascript:history.go(-1)">&laquo;Back
    </div>
  </a>
    <form class='add' action="<?php echo url_for('/entity/login/register.php'); ?>" method="post">  
    <div style="text-align: center">
      <label>Username: </label> 
      <input type="text" name="username" >
      <span class='errors'><?php echo $errors['hname']??'';?></span>
    </div>
    <div style="text-align: center">
      <label>Password: </label> 
      <input type="password" name="password" >
      <span class='errors'><?php echo $errors['hst_address']??'';?></span>
    </div>
    <div style="text-align: center">
      <br>
      &nbsp;&nbsp;
      <input type="Submit" name="admin" value = "Register">
    </div>
  </form>

  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
