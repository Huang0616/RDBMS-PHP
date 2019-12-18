<?php require_once('../../../private/initialize.php'); ?>

<?php
  if(is_post_request()){
    $user = [];
    $user['username'] = $_POST['username'];
    $user['password'] = $_POST['password'];
    if(!empty($_POST['admin'])) {
        //admin
      if(verify_admin_user($user) === true){
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = 'admin';
        redirect_to(url_for('/entity/index.php'));
      }else{
        echo "<script> alert('Username or password is incorrect!Try again!')</script>";
      }
    } elseif(!empty($_POST['physician'])) {
        //physician
      if(verify_physician_user($user) === true){
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = 'physician';
        redirect_to(url_for('/entity/restrict/index.php'));
      }else{
        echo "<script> alert('Username or password is incorrect!Try again!')</script>";
      }
    }
  }
?>

<?php $page_title = 'Login'; ?>
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
    <h1 style="text-align: center">Login</h1>
    <form id = 'login' class='add' action="<?php echo url_for('/entity/login/index.php'); ?>" method="post">  
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
    <div  style="text-align: center">
      <a class='back_link' href = "<?php echo url_for('/entity/login/register.php'); ?>" >
      Don't have a username? Register now!
      </a>
    </div>
    <div style="text-align: center">
      <br>
      &nbsp;&nbsp;
      <input type="Submit" name="admin" value = "Admin" >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="Submit" name="physician" value ="Physician" >
    </div>
  </form>

  </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>
