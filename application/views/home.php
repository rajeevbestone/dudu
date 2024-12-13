<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dial Up Delta | Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('includes/plugins/fontawesome-free/css/all.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('includes/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('includes/dist/css/adminlte.min.css');?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="<?= base_url('includes/js/jquery.toast.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>includes/css/jquery.toast.css" type="text/css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo base_url();?>"><b>Dial Up</b>Delta</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="<?php echo base_url("AdminController/checkAuthentication");?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    if (isset($_SESSION['logInStatus'])) {
?>
<script>
    $.toast({
        heading: 'Failed',
        text: 'Wrong Username / password',
        icon: 'error',
        position: 'top-right',
    });
</script>
<?php
        unset($_SESSION['logInStatus']);        
    }
    if (isset($_SESSION['logout'])) {
?>
<script>
    $.toast({
        heading: 'Success',
        text: 'Logged Out Successfully',
        icon: 'success',
        position: 'top-right',
    });
</script>
<?php
        unset($_SESSION['logout']);
    }
?>


    <script src="<?php echo base_url('includes/plugins/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('includes/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('includes/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
