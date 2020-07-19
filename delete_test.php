<?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$t_id = Input::get('id')) {
          Redirect::to('test_info.php');
		} else {
				$test = new Test();
			  try {
					$test->delete($t_id);
					Redirect::to('test_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		