<?php
date_default_timezone_set("Asia/Dhaka");
require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home').'</p>';
}

$user = new User(); //Current

if($user->isLoggedIn()) {
		if (Input::exists()) {
			if(Token::check(Input::get('token'))) {

					$cabinType = Input::get('category');
					$cabin = "";
					$vipcabin = "";
					$bed ="";
					
					 if($cabinType == 'cabin'){
						$cabin = Input::get('selected_cabins');
					 }
					
					 if($cabinType == 'v_cabin'){
						$vipcabin = Input::get('selected_cabins');
					 }
					 
					$wards = $user-> get_all_wards();
					if(count($wards)){
						
						foreach($wards as $ward){
							$ward_id = $ward-> get('id'); 
							
							if($cabinType == $ward_id){
								
								$bed = Input::get('selected_cabins');
							}
						}
					}
					
					$billing = new Billing();
					try {
						
						$billing->create(array(
							'room_unit_charge' => Input::get('room_charge')
							));
					} catch(Exception $e) {
						echo $error, '<br>';
					}
					//echo "hi " . $billing->db()->lastInsertedId(); exit;
					 
					$patient = new Patient();
					try {
						
						$patient->create(array(
							'patient_name' => Input::get('pname'),
							'guardian' => Input::get('fname'),
							'address' => Input::get('address'),
							'age' => Input::get('age'),
							'gender' => Input::get('gender'),
							'telephone' => Input::get('phone'),
							'cabin_id' => $cabin,
							'vipcabin_id' => $vipcabin,
							'bed_id' => $bed,
							'account_id' => Input::get('account_id'),
							'admitting_doctor_id' => Input::get('adname'),
							'admitting_nurse_id' => Input::get('anname'),
							'director_id' => Input::get('dname'),
							'joined' => date('Y-m-d H:i:s'),
							'operator_id' => $user->data()->id,
							'billing_id' =>$billing-> db()->lastInsertedId()
							));
							
						   Session::flash('home', 'Patient has been registered successfully');
						   
						    if($cabinType == 'cabin'){
								$cabin = Input::get('selected_cabins');
								$ncabin = new Cabin();
								try {
								   $ncabin->update(array(
										'status' => 1
									), $cabin );
								} catch(Exception $e) {
									die($e->getMessage());
								}
							}
							
							 if($cabinType == 'v_cabin'){
								$vipcabin = Input::get('selected_cabins');
								$nvipcabin = new Vipcabin();
								try {
								   $nvipcabin->update(array(
										'status' => 1
									), $vipcabin );
								} catch(Exception $e) {
									die($e->getMessage());
								}
							}
							
							$wards = $user-> get_all_wards();
							if(count($wards)){
								foreach($wards as $ward){
									$ward_id = $ward-> get('id'); 
										if($cabinType == $ward_id){
										$bed = Input::get('selected_cabins');
										$nbed = new Bed();
										try {
										   $nbed->update(array(
												'status' => 1
											), $bed );
										} catch(Exception $e) {
											die($e->getMessage());
										}
										
									}
								}
							}
							
						    //Redirect::to('patient_info.php');
					} catch(Exception $e) {
						echo $error, '<br>';
					}
					
			}
 
		}
            include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/create_patient_content.php');
			include('includes/footer.php');
			
}