<?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$c_id = Input::get('id')) {
          Redirect::to('cabin_info.php');
		} else {
				$cabin = new Cabin();
			  try {
					$cabin->delete($c_id);
					Redirect::to('cabin_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		