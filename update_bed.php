<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	$b_id = Input::get('bid');
	$bed = new Bed( $b_id);
		if(Input::exists()) {
					
					try {
					   $bed->update(array(
						   'bed_no' => Input::get('bed_no'),
							'bed_price' => Input::get('bed_price'),
							'ward_id' => Input::get('ward')
						), $b_id );
						Redirect::to('bed_info.php');

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>
