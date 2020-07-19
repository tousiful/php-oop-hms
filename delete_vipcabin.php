<?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$vc_id = Input::get('id')) {
          Redirect::to('vipcabin_info.php');
		} else {
				$vipcabin = new Vipcabin();
			  try {
					$vipcabin->delete($vc_id);
					Redirect::to('vipcabin_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		