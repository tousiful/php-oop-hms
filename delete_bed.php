<?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$b_id = Input::get('id')) {
          Redirect::to('bed_info.php');
		} else {
				$bed = new Bed();
			  try {
					$bed->delete($b_id);
					Redirect::to('bed_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		