<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	$c_id = Input::get('cid');
	$cabin = new Cabin( $c_id);
		if(Input::exists()) {
					
					try {
					   $cabin->update(array(
						   'cabin_no' => Input::get('cabin_no'),
						   'cabin_price' => Input::get('cabin_price')
						), $c_id );
						Redirect::to('cabin_info.php');

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>
