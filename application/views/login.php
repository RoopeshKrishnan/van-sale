
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.webp">
  <title>
   Van Sale
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url() ?>assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" /> 
</head>

<body class="bg-gray-200"> 

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="w-50 navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        <img class="w-30" src="<?= base_url() ?>assets/img/GL-img/full-logo-inline-for-dark-background-1.webp" alt="" >
      </a>
      
    </div>
  </nav>
  <!-- End Navbar -->
      
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-height-300 m-3 border-radius-xl"
      style="background-image: url('https://images.unsplash.com/photo-1491466424936-e304919aada7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1949&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span> 
    </div>
    <div class="container mb-4">
      <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card mt-8">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1 text-center py-4">
                <h4 class="font-weight-bolder text-white mt-1">Log In</h4>
                <p class="mb-1 text-sm text-white">Enter your email and password to Log In</p>
              </div>
            </div>
            <div class="card-body">
              <form role="form" action="<?= base_url() ?>login-check" method="POST" class="text-start">
                <div class="input-group input-group-static mb-4">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="John158" name="username" value="<?php echo set_value('username') ?>" >
                </div>
                <span class="text-danger"><?php echo form_error("username"); ?></span>
                    <?php  if($this->session->flashdata('invalid_username')){ ?>
                        <span class="text-danger"><?php echo $this->session->flashdata('invalid_username') ?></span>
                    <?php } ?>
                <div class="input-group input-group-static mb-4">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="•••••••••••••">
                </div> 
                <span class="text-danger"><?php echo form_error("password"); ?></span>
                    <?php  if($this->session->flashdata('invalid_password')){ ?>
                        <span class="text-danger"><?php echo $this->session->flashdata('invalid_password') ?></span>
                    <?php } ?>
                <!-- <div class="text-center">
                 <a href="<?= base_url() ?>dashboard"> <button type="button" class="btn bg-gradient-success w-100 mt-3 mb-0">Sign in</button> </a>
                </div> -->
                <input class="btn bg-gradient-success w-100 mt-3 mb-0" name="submit" type="submit" value="Sign in">

              </form>
            </div> 
          </div>
        </div>
      </div>
    </div> 
  </main>

  <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/smooth-scrollbar.min.js"></script> 
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <script src="<?= base_url() ?>assets/js/material-dashboard.min.js?v=3.0.6"></script> 
</body>


</html>