<?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$p_id = Input::get('id')) {
          Redirect::to('patient_info.php');
		} else {
				$patient = new Patient($p_id);
	
			  try {
					$patient->delete($p_id);
				} catch(Exception $e) {
					echo $error, '<br>';
				}
				
				$b_id = $patient->data()->billing_id;
				$billing = new Billing();
				try {
					$billing->delete($b_id);
					Redirect::to('patient_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		