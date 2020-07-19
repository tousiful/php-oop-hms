<?php
require_once 'core/init.php';
$user = new User();
if($user->isLoggedIn()) {
	$w_id = Input::get('wid');
	$ward = new Ward($w_id);
		if(Input::exists()) {
					
					try {
					   $ward->update(array('ward_name' => Input::get('wname')), $w_id);
						Redirect::to('ward_info.php');

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>