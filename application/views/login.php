<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=assets?>vendors/iconic-fonts/flat-icons/flaticon.css">

  
  <link href="<?=assets?>vendors/iconic-fonts/font-awesome/css/all.min.css" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="<?=assets?>css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery UI -->
  <link href="<?=assets?>css/jquery-ui.min.css" rel="stylesheet">
  <!-- Costic styles -->
  <link href="<?=assets?>css/style.css" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="<?=assets?>favicon.ico">
  <style>
  .error{
      color:red;
  }
  </style>
</head>

<body class="ms-body ms-primary-theme ms-logged-out">
 
  <!-- Preloader -->
  <div id="preloader-wrap">
    <div class="spinner spinner-8">
      <div class="ms-circle1 ms-child"></div>
      <div class="ms-circle2 ms-child"></div>
      <div class="ms-circle3 ms-child"></div>
      <div class="ms-circle4 ms-child"></div>
      <div class="ms-circle5 ms-child"></div>
      <div class="ms-circle6 ms-child"></div>
      <div class="ms-circle7 ms-child"></div>
      <div class="ms-circle8 ms-child"></div>
      <div class="ms-circle9 ms-child"></div>
      <div class="ms-circle10 ms-child"></div>
      <div class="ms-circle11 ms-child"></div>
      <div class="ms-circle12 ms-child"></div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="body-content">
    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper ms-auth">
      <div class="ms-auth-container">
        <div class="ms-auth-col">
          <div class="ms-auth-bg"></div>
        </div>
        <div class="ms-auth-col">
          <div class="ms-auth-form">
              <p><img src="<?=assets?>/img/familybazar_logo.png"/></p>
            <form class="needs-validation" action="<?=base_url()?>Login" method="POST">
              <h3>Login to Account</h3>

              <?php if($this->session->flashdata('login_fail')) { ?>
                    <div class="alert alert-danger alert-solid" role="alert">
                        <strong>Oops ! </strong> <?php echo $this->session->flashdata('login_fail')?>s
                    </div>
        		<?php } ?>
             
              <div class="mb-3">
                <label for="validationCustom08">Username</label>
                    <input type="text" class="form-control"  placeholder="Username" name="admin_username" required="">
                    <span class="error"><?=form_error('admin_username');?></span>
              </div>
              <div class="mb-3">
                <label for="validationCustom09">Password</label>
                  <input type="password" class="form-control"  placeholder="Password" name="admin_pass" required="">
                  <span class="error"><?=form_error('admin_pass');?></span>
              </div>
              <div class="form-group">
                <label class="ms-checkbox-wrap">
                  <input class="form-check-input" type="checkbox" value=""> <i class="ms-checkbox-check"></i>
                </label> <span> Remember Password </span>
                <label class="d-block mt-3"><a href="#" class="btn-link" data-toggle="modal" data-target="#modal-12">Forgot Password?</a>
                </label>
              </div>
              <button class="btn btn-primary mt-4 d-block w-100" type="submit">Sign In</button> 
              <p class="mb-0 mt-3 text-center">Don't have an account? <a class="btn-link" href="default-register.html">Create Account</a> 
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Forgot Password Modal -->
    <div class="modal fade" id="modal-12" tabindex="-1" role="dialog" aria-labelledby="modal-12">
      <div class="modal-dialog modal-dialog-centered modal-min" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button> <i class="flaticon-secure-shield d-block"></i>
            <h1>Forgot Password?</h1>
            <p>Enter your email to recover your password</p>
            <form method="post">
              <div class="ms-form-group has-icon">
                <input type="text" placeholder="Email Address" class="form-control" name="forgot-password" value=""> <i class="material-icons">email</i>
              </div>
              <button type="submit" class="btn btn-primary shadow-none">Reset Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  
  <!-- SCRIPTS -->
  <!-- Global Required Scripts Start -->
  <script src="<?=assets?>js/jquery-3.5.0.min.js"></script>
  <script src="<?=assets?>js/popper.min.js"></script>
  <script src="<?=assets?>js/bootstrap.min.js"></script>
  <script src="<?=assets?>js/perfect-scrollbar.js">
  </script>
  <script src="<?=assets?>js/jquery-ui.min.js">
  </script>
  <!-- Global Required Scripts End -->
  <!-- Costic core JavaScript -->
  <script src="<?=assets?>js/framework.js"></script>
  <!-- Settings -->
  <script src="<?=assets?>js/settings.js"></script>
</body>


</html>