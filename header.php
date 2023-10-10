<?php 

include 'function.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Display dashboard content for logged-in users
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>E website</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
      <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="codedthemes">
      <!-- Favicon icon -->
      <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
	  <link rel="stylesheet" type="text/css" href="assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
      <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://www.cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<meta charset=utf-8 />
<!-- 
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script> -->

  <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
  <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 
//slider -->
<script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>


<link rel="stylesheet" href="css/header.css"/>
  <style>
    
    div.dataTables_wrapper div.dataTables_info {
    padding-top: 0.85em;
    display: none;
}
        /* Your custom styles */
        .main {
            font-family: Arial;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .star{
            color:red;
        }
        .error{
            color:red;
        }
        .main {
            font-family: Arial;
            width: 500px;
            display: block;
            margin: 0 auto;
        }

        h3 {
            background: #fff;
            color: #3498db;
            font-size: 36px;
            line-height: 100px;
            margin: 10px;
            padding: 2%;
            position: relative;
            text-align: center;
        }

        .action {
            display: block;
            margin: 100px auto;
            width: 100%;
            text-align: center;
        }

        .action a {
            display: inline-block;
            padding: 5px 10px;
            background: #f30;
            color: #fff;
            text-decoration: none;
        }

        .action a:hover {
            background: #000;
        }
        
        /* Rest of your custom styles... */
    </style>

  
<style>
 .data-grid-container {
  /* Add desired styling for the container */
  text-align: center; /* Center the pagination */
}

.dataTables_paginate, .paging_simple_numbers {
  display: inline-block; /* Display as inline block to center within the container */
  
}

 .buttonsize{
    font-size: 14px;
    font-weight: 500;
 }
    /* previe image center  */
    .previewImages img,
    .previewImages video {
        max-width: 100px;
        max-height: 100px;
        width: auto;
        height: auto;
    }
    .centerimage{
        margin: auto;
  width: 50%;
  border: 3px solid green;
  padding: 10px;
    }
.imageweightview{
    width: 22px;
}
.tooglelineremove{
    text-decoration:none;
}
.previewImagesModelBox .close-button{

    display: none;
}
    .previewImagesModelBox img,
    .previewImagesModelBox video {
        max-width: 100px;
        max-height: 100px;
        width: auto;
        height: auto;
        
       
        display: block;
    
  margin-left: auto;
  margin-right: auto;
    }
 .playnowcolor{
    background-color:#fda12e;
    }

    .buynowcolor{
    background-color:#ff621f;
    }
 
    .previewlogo{
        display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    height: 100px;
    }
    .previewlogo1{
        display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    height: 100px;
    }
    #media-container {
      white-space: nowrap; /* Prevent line breaks */
      overflow-x: scroll; /* Add horizontal scroll if media items overflow */
      width: 100%; /* Expand the container to the full width of the screen */
    }

    /* Style for individual media items */
    .media-item {
      max-width: 100px; /* Adjust the maximum width of the media item */
      height: auto; /* Allow the height to adjust based on content */
      display: inline-block; /* Display media items in a line */
      margin-right: 10px; /* Add some spacing between media items */
      border: 1px solid #adacac;
      position: relative; /* Position relative for close button positioning */
    }

    /* Style for the media item images within the thumbnail */
    .media-item.img-thumbnail img,
    .media-item.img-thumbnail video {
        margin-top:12px;
      max-width: 90px;
       /* Set the maximum width */
      max-height: 100px; /* Set the maximum height */
      width: auto; /* Allow the width to adjust based on content */
      height: auto; /* Allow the height to adjust based on content */
    }

    /* Style for the close button */
    .close-button {
      position: absolute; /* Position absolute for close button */
      top: 5px; /* Adjust top position to provide spacing */
      right: 5px; /* Adjust right position to provide spacing */
      background-color: rgba(255, 255, 255, 0.8); /* Background color for visibility */
      border: none; /* Remove border */
      border-radius: 50%; /* Make it a circle */
      padding: 2px 6px; /* Add some padding */
      cursor: pointer; /* Change cursor on hover */
    }

    
    
    
    .margincheckbox{
        margin-left:-72px;
    }
.toogleweight {
  transform: scale(2); /* Increase the size of the toggle */
}
.toogle {
  display: flex;
  align-items: center;
  margin-left: 27px;
}
    .width{
    width:197px;
}
.margin{
    margin-right:34px;
}
.morris-hover {
  position:absolute;
  z-index:1000;
}
.tablesize{
    font-size:small
}
.morris-hover.morris-default-style {     border-radius:10px;
  padding:6px;
  color:#666;
  background:rgba(255, 255, 255, 0.8);
  border:solid 2px rgba(230, 230, 230, 0.8);
  font-family:sans-serif;
  font-size:12px;
  text-align:center;
}

.morris-hover.morris-default-style .morris-hover-row-label {
  font-weight:bold;
  margin:0.25em 0;
}

.morris-hover.morris-default-style .morris-hover-point {
  white-space:nowrap;
  margin:0.1em 0;
}

svg { width: 100%; }
    </style>
    </head>

  <body>
  <body>
	  <!-- <div class="fixed-button">
		<a href="https://codedthemes.com/item/gradient-able-admin-template" target="_blank" class="btn btn-md btn-primary">
			<i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
		</a>
	  </div> -->
       <!-- Pre-loader start -->
    <!-- <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div> -->
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
               <div class="navbar-wrapper">
                   <div class="navbar-logo">
                       <a class="mobile-menu" id="mobile-collapse" href="#!">
                           <i class="ti-menu"></i>
                       </a>
                       <div class="mobile-search">
                           <div class="header-search">
                               <div class="main-search morphsearch-search">
                                   <div class="input-group">
                                       <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                       <input type="text" class="form-control" placeholder="Enter Keyword">
                                       <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <a href="dashboard.php">
                           <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
                       </a>
                       <a class="mobile-options">
                           <i class="ti-more"></i>
                       </a>
                   </div>

                   <div class="navbar-container container-fluid">
                       <ul class="nav-left">
                           <li>
                               <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                           </li>
                           <li class="header-search">
                               <div class="main-search morphsearch-search">
                                   <div class="input-group">
                                       <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                       <input type="text" class="form-control">
                                       <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                   </div>
                               </div>
                           </li>
                           <li>
                               <a href="#!" onclick="javascript:toggleFullScreen()">
                                   <i class="ti-fullscreen"></i>
                               </a>
                           </li>
                       </ul>
                       <ul class="nav-right">
                           <li class="header-notification">
                               <a href="#!">
                                   <i class="ti-bell"></i>
                                   <span class="badge bg-c-pink"></span>
                               </a>
                               <ul class="show-notification">
                                   <li>
                                       <h6>Notifications</h6>
                                       <label class="label label-danger">New</label>
                                   </li>
                                   <li>
                                       <div class="media">
                                           <img class="d-flex align-self-center img-radius" src="assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                           <div class="media-body">
                                               <h5 class="notification-user">John Doe</h5>
                                               <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                               <span class="notification-time">30 minutes ago</span>
                                           </div>
                                       </div>
                                   </li>
                                   <li>
                                       <div class="media">
                                           <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                           <div class="media-body">
                                               <h5 class="notification-user">Joseph William</h5>
                                               <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                               <span class="notification-time">30 minutes ago</span>
                                           </div>
                                       </div>
                                   </li>
                                   <li>
                                       <div class="media">
                                           <img class="d-flex align-self-center img-radius" src="assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                           <div class="media-body">
                                               <h5 class="notification-user">Sara Soudein</h5>
                                               <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                               <span class="notification-time">30 minutes ago</span>
                                           </div>
                                       </div>
                                   </li>
                               </ul>
                           </li>
                           
                           <li class="user-profile header-notification">
                               <a href="#!">
                                   <img src="assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                   <span><?php echo $_SESSION['email']; ?></span>
                                   <i class="ti-angle-down"></i>
                               </a>
                               <ul class="show-notification profile-notification">
                                   <li>
                                       <a href="#!">
                                           <i class="ti-settings"></i> Settings
                                       </a>
                                   </li>
                                   <li>
                                       <a href="user-profile.html">
                                           <i class="ti-user"></i> Profile
                                       </a>
                                   </li>
                                   
                                   <li>
                                       <a href="logout.php">
                                       <i class="ti-layout-sidebar-left"></i> Logout

                                   </a>
                                   </li>
                               </ul>
                           </li>
                       </ul>
                   </div>
               </div>
           </nav>
