<?php
date_default_timezone_set("Asia/Dhaka");
require_once 'core/init.php';

$user = new User(); //Current

if($user->isLoggedIn()) {
		
		if (Input::exists()) {
	
			if(Token::check(Input::get('token'))) {
					$test = new Test();
					try {
						
						$test->create(array(
							'test_name' => Input::get('test_name'),
							'test_price' => Input::get('test_price')
							));
						 Redirect::to('test_info.php');
					     } catch(Exception $e){
						     echo $error, '<br>';
					     }
						
					}
					
				}
 
			
            include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/add_test_content.php');
			include('includes/footer.php');
			
}
?>



