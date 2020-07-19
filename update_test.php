<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	$t_id = Input::get('tid');
	$test = new Test($t_id);
		if(Input::exists()) {
					
					try {
					   $test->update(array(
						   'test_name' => Input::get('test_name'),
						   'test_price' => Input::get('test_price')
						), $t_id );
						Redirect::to('test_info.php');

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>
