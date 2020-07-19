<?php
date_default_timezone_set("Asia/Dhaka");
require_once 'core/init.php';

$user = new User(); //Current

if($user->isLoggedIn()) {
		
		if (Input::exists()) {
	
			if(Token::check(Input::get('token'))) {
					
					$ward = new Ward();
					$w_name=Input::get('ward');
					try {
						   foreach($w_name as $value){
						   $ward->create(array(
								'ward_name' => $value
								));
						   }	
						   Redirect::to('ward_info.php');
					     } catch(Exception $e){
						     echo $error, '<br>';
					     }
						
					}
					
				}
 
			
            include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/add_ward_content.php');
			include('includes/footer.php');
			
}
?>