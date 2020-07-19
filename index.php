<?php

require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}

$user = new User(); //Current

if($user->isLoggedIn()) {
	if($user->hasPermission('admin')) {
		include('includes/header.php');
		include('includes/sidebar.php');
		include('includes/top_navigation.php');
		include('content/index_content.php');
		include('includes/footer.php');
    }
	if($user->hasPermission('doctor')) {
		include('includes/header.php');
		
		include('includes/top_navigation.php');
		include('content/index_content.php');
		include('includes/footer.php');
    }

} else {
   Redirect::to('login.php');
}