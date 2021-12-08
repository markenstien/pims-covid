<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Purchase: https://1.envato.market/nobleui_admin
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title><?php echo $page_title ?? SITE_NAME?></title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="<?php echo _path_tmp('assets/vendors/core/core.css')?>">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo _path_tmp('assets/fonts/feather-font/css/iconfont.css')?>">
    <link rel="stylesheet" href="<?php echo _path_tmp('assets/vendors/flag-icon-css/css/flag-icon.min.css')?>">
    <!-- endinject -->

  <!-- Layout styles -->  
    <link rel="stylesheet" href="<?php echo _path_tmp('assets/css/demo3/style.css')?>">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="<?php echo _path_tmp('assets/images/favicon.png')?>" />
</head>
<body>
    <?php $auth = auth()?>
    <div class="main-wrapper">

        <!-- partial:../../partials/_navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar">
                <div class="container">
                    <div class="navbar-content">
                        <a href="#" class="navbar-brand">
                            COVID<span>PIMS</span>
                        </a>
                        <form class="search-form">
                            <div class="input-group">
                                <div class="input-group-text">
                                  <i data-feather="search"></i>
                                </div>
                                <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                            </div>
                        </form>
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i data-feather="mail"></i>
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="messageDropdown">
                              <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>9 New Messages</p>
                                <a href="javascript:;" class="text-muted">Clear all</a>
                              </div>
                              <div class="p-1">
                                <?php for($i = 0; $i < 3; $i++) :?>
                                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                  <div class="me-3">
                                    <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                                  </div>
                                  <div class="d-flex justify-content-between flex-grow-1">
                                    <div class="me-4">
                                      <p>TEST</p>
                                      <p class="tx-12 text-muted">test-status</p>
                                    </div>
                                    <p class="tx-12 text-muted">2 min ago</p>
                                  </div>    
                                </a>
                                <?php endfor?>
                              </div>
                              <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                              </div>
                            </div>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i data-feather="bell"></i>
                              <div class="indicator">
                                <div class="circle"></div>
                              </div>
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                              <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                                <p>(6) Notification</p>
                                <a href="javascript:;" class="text-muted">Clear all</a>
                              </div>
                              <div class="p-1">
                                <?php for($i = 0; $i < 3; $i++) :?>
                                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                                  <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                    <i class="icon-sm text-white" data-feather="gift"></i>
                                  </div>
                                  <div class="flex-grow-1 me-2">
                                    <p>New NOTIFICATION</p>
                                    <p class="tx-12 text-muted">30 min ago</p>
                                  </div>    
                                </a>
                                <?php endfor?>
                              </div>
                              <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                <a href="javascript:;">View all</a>
                              </div>
                            </div>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                              <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                <div class="mb-3">
                                  <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
                                </div>
                                <div class="text-center">
                                  <p class="tx-16 fw-bolder"><?php echo $auth->first_name . ' '.$auth->last_name?></p>
                                  <p class="tx-12 text-muted"><?php echo $auth->email ?></p>
                                </div>
                              </div>
                              <ul class="list-unstyled p-1">
                                <li class="dropdown-item py-2">
                                  <a href="#" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="user"></i>
                                    <span>Profile</span>
                                  </a>
                                </li>
                                <li class="dropdown-item py-2">
                                  <a href="javascript:;" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                  </a>
                                </li>
                                <li class="dropdown-item py-2">
                                  <a href="javascript:;" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="repeat"></i>
                                    <span>Switch User</span>
                                  </a>
                                </li>
                                <li class="dropdown-item py-2">
                                  <a href="<?php echo _route('auth:logout')?>" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                            <i data-feather="menu"></i>                 
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo _route('dashboard:index')?>">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <?php if( isEqual($auth->user_type , ['medical personels' , 'admin' , 'doctor'])) :?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="link-icon" data-feather="mail"></i>
                                <span class="menu-title">Users</span>
                                <i class="link-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link" href="<?php echo _route('user:create')?>">Create</a></li>
                                    <li class="category-heading">Medical Personels</li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo _route('user:index' , ['user_type' => 'medical personels'])?>">Staff</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo _route('user:index' , ['user_type' => 'doctor'])?>">Doctors</a></li>
                                    <li class="category-heading">Others<li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo _route('user:index')?>">All</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo _route('user:index' , ['user_type' => 'patient'])?>">Patients</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php endif?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo _route('patient-record:index')?>">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="menu-title">Records</span>
                            </a>
                        </li>
                        <?php if( isEqual($auth->user_type , ['medical personels' , 'admin' , 'doctor'])) :?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="link-icon" data-feather="box"></i>
                                <span class="menu-title">Lab Results</span>
                            </a>
                        </li>
                        <?php endif?>

                        <?php if( isEqual($auth->user_type , ['medical personels' , 'admin' , 'doctor'])) :?>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="link-icon" data-feather="mail"></i>
                                <span class="menu-title">Others</span>
                                <i class="link-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="category-heading">Forms</li>
                                    <li class="nav-item"><a class="nav-link" href="#">Questionarire</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Responses</a></li>
                                </ul>
                            </div>
                        </li> -->

                        <?php endif?>

                        <?php if( isEqual($auth->user_type , ['medical personels' , 'admin' , 'doctor'])) :?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="link-icon" data-feather="hash"></i>
                                <span class="menu-title">Reports</span></a>
                        </li>
                        <?php endif?>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
    
        <div class="page-wrapper">

            <div class="page-content">
                <?php echo produce('content')?>
            </div>

            <!-- partial:../../partials/_footer.html -->
            <footer class="footer border-top">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between py-3 small">
          <p class="text-muted mb-1 mb-md-0">Copyright © 2021 <?php echo COMPANY_NAME?>.</p>
        </div>
            </footer>
            <!-- partial -->
    
        </div>
    </div>

    <!-- core:js -->
    <script src="<?php echo _path_tmp('assets/vendors/core/core.js')?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="<?php echo _path_tmp('assets/vendors/feather-icons/feather.min.js')?>"></script>
    <script src="<?php echo _path_tmp('assets/js/template.js')?>"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>
</html>