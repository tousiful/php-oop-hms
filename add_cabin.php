<?php
date_default_timezone_set("Asia/Dhaka");
require_once 'core/init.php';

$user = new User(); //Current

if($user->isLoggedIn()) {
		
		if (Input::exists()) {
	
			if(Token::check(Input::get('token'))) {
					$cabin = new Cabin();
					try {
						
						$cabin->create(array(
							'cabin_no' => Input::get('cabin_no'),
							'cabin_price' => Input::get('cabin_price'),
							'status' => 0
							));
							
						 Redirect::to('cabin_info.php');
					     } catch(Exception $e){
						     echo $error, '<br>';
					     }
						
					}
					
				}
 
			
            include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/add_cabin_content.php');
			include('includes/footer.php');
			
}
?>