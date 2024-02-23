<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/img/GL-img/gl-logo1.webp">
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/GL-img/gl-logo1.webp">
  <title>
    Van Sale | <?= $page_title ?>
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- select 2 -->
  <link href="<?php echo base_url(); ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url() ?>assets/css/style_pro.css" rel="stylesheet" /> 
  <link id="pagestyle" href="<?= base_url() ?>assets/css/glstyle.css" rel="stylesheet" /> 
  <!-- toaster css -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="g-sidenav-show  bg-gray-200">
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=""
        target="_blank">
        <img src="<?= base_url() ?>assets/img/GL-img/gl-logo1.webp" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Grandlady</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      <li class="nav-item mb-2 mt-0">
          <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav"
            role="button" aria-expanded="false">
            <img src="<?= base_url() ?>assets/img/team-3.jpg" class="avatar">
            <span class="nav-link-text ms-2 ps-1"><?= $this->session->userdata('user_name') ?></span>
          </a>
          <div class="collapse" id="ProfileNav" style>
            <ul class="nav ">
              <li class="nav-item">
                <a class="nav-link text-white" href="profile_view">
                  <span class="sidenav-mini-icon"> MP </span>
                  <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href=" ">
                  <span class="sidenav-mini-icon"> S </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Settings </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="<?= base_url() ?>logout">
                  <span class="sidenav-mini-icon"> L </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <hr class="horizontal light mt-0">
        <?php
          $show = 'nav-link active bg-gradient-primary';
          $hide = 'nav-link ';
          $show_sub_menu = ' nav-item active  ';
          $hide_sub_menu = ' nav-item   ';
          $show_sub_menu_dropdown = ' collapse show   ';
          $hide_sub_menu_dropdown = ' collapse hide  ';
        ?>
        <li class="nav-item">
          <a class=" text-white   <?= $active == 'dashboard' ? $show : $hide ?> " href="dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-2">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#user" class="nav-link text-white <?= ($active == 'user_creation' || $active == 'all_user') ?'active bg-gradient-primary':''; ?>"
            aria-controls="user" role="button" aria-expanded="false">
            <i class="material-icons opacity-10">groups_2</i>
            <span class="nav-link-text ms-2 ">User</span>
          </a>
          <div class="collapse  <?= ($active == 'user_creation' || $active == 'all_user') ?'show':''; ?> " id="user">
            <ul class="nav ">
              <li class="nav-item  ">
                <a class="nav-link text-white <?= ($active == 'user_creation') ?'active':''; ?>" href="<?= base_url() ?>user-registration">
                  <span class="sidenav-mini-icon"> UC </span>
                  <span class="sidenav-normal  ms-2  ps-1"> User Creation  </span>
                </a>
              </li>
              <li class=" nav-item">
                <a class="nav-link text-white <?= ($active == 'all_user') ?'active':''; ?>" href="<?= base_url() ?>All-users">
                  <span class="sidenav-mini-icon"> AU </span>
                  <span class="sidenav-normal  ms-2  ps-1"> All User </span>
                </a>
              </li>
              
            </ul>
          </div>
        </li>  
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#customer" class="nav-link text-white <?= ($active == 'customer_creation' || $active == 'all_customer') ?'active bg-gradient-primary':''; ?>"
            aria-controls="customer" role="button" aria-expanded="false">
            <i class="material-icons opacity-10">person</i>
            <span class="nav-link-text ms-2 ">Customer</span>
          </a>
          <div class="collapse  <?= ($active == 'customer_creation' || $active == 'all_customer') ?'show':''; ?> " id="customer">
            <ul class="nav ">
              <li class="nav-item  ">
                <a class="nav-link text-white <?= ($active == 'customer_creation') ?'active':''; ?>"  href="<?= base_url() ?>customer-registration">
                  <span class="sidenav-mini-icon"> CC </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Customer Creation  </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white <?= ($active == 'all_customer') ?'active':''; ?>" href="<?= base_url() ?>All-customers">
                  <span class="sidenav-mini-icon"> AC </span>
                  <span class="sidenav-normal  ms-2  ps-1"> All CUstomers </span>
                </a>
              </li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'area' ? $show : $hide ?>  text-white  " href="<?= base_url() ?>area">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">public</i>
            </div>
            <span class="nav-link-text ms-2">  Area</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="<?= $active == 'driver' ? $show : $hide ?>  text-white  " href="<?= base_url() ?>driver">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">airline_seat_recline_normal</i>
            </div>
            <span class="nav-link-text ms-2">  Driver</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'vehicle' ? $show : $hide ?> text-white  " href="<?= base_url() ?>vehicle">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2">  Vehicle</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'group' ? $show : $hide ?> text-white  " href="<?= base_url() ?>group">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2"> Group</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'category' ? $show : $hide ?> text-white  " href="<?= base_url() ?>category">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2"> Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'sub_category' ? $show : $hide ?> text-white  " href="<?= base_url() ?>sub-category">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2">Sub-category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'category_type' ? $show : $hide ?> text-white  " href="<?= base_url() ?>Category-type">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2">Category-type</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'tax_type' ? $show : $hide ?> text-white  " href="<?= base_url() ?>tax-type">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2">Tax-type</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="<?= $active == 'tax' ? $show : $hide ?> text-white  " href="<?= base_url() ?>tax">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-2">Tax</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#item" class="nav-link text-white <?= ($active == 'item_creation' || $active == 'all_items' || $active == 'item_unit') ?'active bg-gradient-primary':''; ?>"
            aria-controls="item" role="button" aria-expanded="false">
            <i class="material-icons opacity-10">apps</i>
            <span class="nav-link-text ms-2 ">Item</span>
          </a>
          <div class="collapse   <?= ($active == 'item_creation' || $active == 'all_items' || $active == 'item_unit') ?'show':''; ?> " id="item">
            <ul class="nav ">
              <li class="nav-item  ">
                <a class="nav-link text-white <?= ($active == 'item_creation') ?'active':''; ?>" href="<?= base_url() ?>item">
                  <span class="sidenav-mini-icon"> UC </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Add Item  </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white <?= ($active == 'all_items') ?'active':''; ?>" href="<?= base_url() ?>All-items">
                  <span class="sidenav-mini-icon"> AU </span>
                  <span class="sidenav-normal  ms-2  ps-1"> All Item </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white <?= ($active == 'item_unit') ?'active':''; ?>" href="<?= base_url() ?>item-unit">
                  <span class="sidenav-mini-icon"> AU </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Item unit </span>
                </a>
              </li>
              
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#stock" class="nav-link text-white <?= ($active == 'stock_creation' ) ?'active bg-gradient-primary':''; ?>"
            aria-controls="stock" role="button" aria-expanded="false">
            <i class="material-icons opacity-10">inventory_2</i>
            <span class="nav-link-text ms-2 "> Stock</span>
          </a>
          <div class="collapse  sho w " id="stock">
            <ul class="nav "> 
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>stock">
                  <span class="sidenav-mini-icon"> SO </span>
                  <span class="sidenav-normal  ms-2  ps-1">Stock Open  </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>all-stock">
                  <span class="sidenav-mini-icon"> AS </span>
                  <span class="sidenav-normal  ms-2  ps-1">All Stock</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>consolidated-stocks">
                  <span class="sidenav-mini-icon"> AS </span>
                  <span class="sidenav-normal  ms-2  ps-1">Consolidate Stock</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  " href="<?= base_url() ?>all-price-list">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">list_alt</i>
            </div>
            <span class="nav-link-text ms-2">Price List</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#ordertakeing" class="nav-link text-white activ e"
            aria-controls="ordertakeing" role="button" aria-expanded="false">
            <i class="material-icons opacity-10">fact_check</i>
            <span class="nav-link-text ms-2 "> Order Takeing</span>
          </a>
          <div class="collapse  sho w " id="ordertakeing">
            <ul class="nav "> 
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>order-taking">
                  <span class="sidenav-mini-icon"> CO </span>
                  <span class="sidenav-normal  ms-2  ps-1">Customer Order</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>all-orders">
                  <span class="sidenav-mini-icon"> AO </span>
                  <span class="sidenav-normal  ms-2  ps-1">All Order</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="<?= base_url() ?>all-orders">
                  <span class="sidenav-mini-icon"> AO </span>
                  <span class="sidenav-normal  ms-2  ps-1">All Converted Orders</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  " href="<?= base_url() ?>consolidate">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">mediation</i>
            </div>
            <span class="nav-link-text ms-2">Consolidate</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="<?= $active == 'bill' ? $show : $hide ?>  text-white  " href="<?= base_url() ?>bill">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons ms-1 opacity-10">airline_seat_recline_normal</i>
            </div>
            <span class="nav-link-text ms-2">  Bill</span>
          </a>
        </li>
      </ul>
    </div> 
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
          <a href="javascript:;" class="nav-link text-body p-0">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end"> 
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?= base_url() ?>assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="<?= base_url() ?>assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li> 
              </ul>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href=" " class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->