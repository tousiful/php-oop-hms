<?php
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	$p_id = Input::get('pid');
	$patient = new Patient( $p_id);
		if(Input::exists()) {
			        $status_id =Input::get('status_id');
					$status_no =Input::get('status_no');
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
					
					
					try {
					   $patient->update(array(
						   'patient_name' => Input::get('pname'),
							'guardian' => Input::get('fname'),
							'address' => Input::get('address'),
							'age' => Input::get('age'),
							'gender' => Input::get('gender'),
							'telephone' => Input::get('phone'),
							'cabin_id' => $cabin,
							'vipcabin_id' => $vipcabin,
							'bed_id' => $bed,
							'admitting_doctor_id' => Input::get('adname'),
							'admitting_nurse_id' => Input::get('anname'),
							'director_id' => Input::get('dname')
						), $p_id );
						
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
								if($status_id){
									if($status_no == "cabin"){
										if($cabin != $status_id){
														try {
													   $ncabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
									if($status_no == "v_cabin"){
										$nvipcabin = new Vipcabin();
										if($cabin != $status_id){
														try {
													   $nvipcabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
									
									if($status_no == "bed"){
										$nbed = new Bed();
										if($cabin != $status_id){
														try {
													   $nbed->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
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
								
								
								if($status_id){
									if($status_no == "v_cabin"){
										$nvipcabin = new Vipcabin();
										if($cabin != $status_id){
														try {
													   $nvipcabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
									if($status_no == "cabin"){
											$ncabin = new Cabin();
										if($cabin != $status_id){
														try {
													   $ncabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
									if($status_no == "bed"){
										$nbed = new Bed();
										if($cabin != $status_id){
														try {
													   $nbed->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
										}
									}
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
										
										if($status_id){
											if($status_no == "bed"){
												$nbed = new Bed();
												if($cabin != $status_id){
													  try {
													   $nbed->update(array(
															'status' => 0
														), $status_id );
													   } catch(Exception $e) {
														die($e->getMessage());
													   }
										        }
									        }
											
											if($status_no == "cabin"){
												$ncabin = new cabin();
												if($cabin != $status_id){
														try {
													   $ncabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
												}
											}
											
											if($status_no == "v_cabin"){
												$nvipcabin = new Vipcabin();
												if($cabin != $status_id){
														try {
													   $nvipcabin->update(array(
															'status' => 0
														), $status_id );
													} catch(Exception $e) {
														die($e->getMessage());
													}
												}
											}
										}
									}
								}
							}
							
					Redirect::to('patient_info.php');
							

					} catch(Exception $e) {
						die($e->getMessage());
					}
		} 
}
?>
