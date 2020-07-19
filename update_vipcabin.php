<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	$vc_id = Input::get('vcid');
	$vipcabin = new Vipcabin($vc_id);
	echo $vc_id;
		if(Input::exists()) {
					
					try {
					   $vipcabin->update(array(
						   'vipcabin_no' => Input::get('vipcabin_no'),
						   'vipcabin_price' => Input::get('vipcabin_price')
						), $vc_id );
						Redirect::to('vipcabin_info.php');

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>
