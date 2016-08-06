<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="<?php echo base_url();?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="<?php echo base_url();?>/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="<?php echo base_url();?>/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>
<body>
<div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-target=
                ".top-nav.nav-collapse,.sidebar-nav.nav-collapse" data-toggle=
                "collapse"><span class="icon-bar"></span> <span class=
                "icon-bar"></span> <span class="icon-bar"></span></a> <a class=
                "brand" href="index.html"><span>Metro</span></a> 
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav pull-right">
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle=
                            "dropdown" href="#"><i class=
                            "halflings-icon white warning-sign"></i></a>
                            <ul class="dropdown-menu notifications">
                                <li class="dropdown-menu-title">
                                    <span>You have 11 notifications</span>
                                    <a href="#refresh"><i class=
                                    "icon-repeat"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon blue"><i class=
                                    "icon-user"></i></span> <span class=
                                    "message">New user registration</span>
                                    <span class="time">1 min</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon green"><i class=
                                    "icon-comment-alt"></i></span> <span class=
                                    "message">New comment</span> <span class=
                                    "time">7 min</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon green"><i class=
                                    "icon-comment-alt"></i></span> <span class=
                                    "message">New comment</span> <span class=
                                    "time">8 min</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon green"><i class=
                                    "icon-comment-alt"></i></span> <span class=
                                    "message">New comment</span> <span class=
                                    "time">16 min</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon blue"><i class=
                                    "icon-user"></i></span> <span class=
                                    "message">New user registration</span>
                                    <span class="time">36 min</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon yellow"><i class=
                                    "icon-shopping-cart"></i></span>
                                    <span class="message">2 items sold</span>
                                    <span class="time">1 hour</span></a>
                                </li>
                                <li class="warning">
                                    <a href="#"><span class=
                                    "icon red"><i class="icon-user"></i></span>
                                    <span class="message">User deleted
                                    account</span> <span class="time">2
                                    hour</span></a>
                                </li>
                                <li class="warning">
                                    <a href="#"><span class=
                                    "icon red"><i class="icon-shopping-cart"></i></span>
                                    <span class="message">New comment</span>
                                    <span class="time">6 hour</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon green"><i class=
                                    "icon-comment-alt"></i></span> <span class=
                                    "message">New comment</span> <span class=
                                    "time">yesterday</span></a>
                                </li>
                                <li>
                                    <a href="#"><span class=
                                    "icon blue"><i class=
                                    "icon-user"></i></span> <span class=
                                    "message">New user registration</span>
                                    <span class="time">yesterday</span></a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                                    <a>View all notifications</a>
                                </li>
                            </ul>
                        </li><!-- start: Notifications Dropdown -->
                       <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle=
                            "dropdown" href="#"><i class=
                            "halflings-icon white user"></i> <?php echo $auth_username?>
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title"><span>Account
                                Settings</span></li>
                                <li>
                                    <a href="#"><i class=
                                    "halflings-icon user"></i> Profile</a>
                                </li>
                                <li><?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('examples/logout', '' ),'<i class=
                                    "halflings-icon off"></i> Logout</a>');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=examples', '' ),'Login','id="login-link"');
									}
									?>
                                </li>
                            </ul>
                        </li><!-- end: User Dropdown -->
                    </ul>
                </div><!-- end: Header Menu -->
            </div>
        </div>
    </div><!-- start: Header -->
    <div class="container-fluid-full">
        <div class="row-fluid">
            <!-- start: Main Menu -->
            <div class="span2" id="sidebar-left">
                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li>
                            <a href="index.html"><i class="icon-bar-chart"></i>
                            <span class="hidden-tablet">Dashboard</span></a>
                        </li>
                        <li>
                            <a class="dropmenu" href="#"><i class=
                            "icon-folder-close-alt"></i> <span class=
                            "hidden-tablet">Management</span> </a>
                            <ul>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/user_register', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">User Registration</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/user_management', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">User Management</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/costumer_register', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">Customer Registration</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/costumer_management', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">Customer Management</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropmenu" href="#"><i class=
                            "icon-folder-close-alt"></i> <span class=
                            "hidden-tablet">Transaction</span> </a>
                            <ul>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/transfer', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">Transfer</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/deposit', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">Deposit</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                                <li>
                                	<?php 
                                	if( isset( $auth_user_id ) ){
										echo anchor( site_url('access/withdrawal', NULL ),'<i class=
                                    "icon-file-alt"></i> <span class=
                                    "hidden-tablet">Withdrawal</span>','class="submenu"');
									}else{
										echo anchor( site_url(LOGIN_PAGE . '?redirect=access', NULL ),'Login','id="login-link"');
									}
									?>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div><!-- end: Main Menu -->
             <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href=
                "http://en.wikipedia.org/wiki/JavaScript" target=
                "_blank">JavaScript</a> enabled to use this site.</p>
            </div></noscript>
