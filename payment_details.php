<?php

require_once 'core/init.php';

$user = new User(); //Current

if($user->isLoggedIn()) {
					
			include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/payment_details_content.php');
			include('includes/footer.php');
           
}
?>