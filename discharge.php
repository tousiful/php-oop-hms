<?php

require_once 'core/init.php';

$user = new User(); 

if($user->isLoggedIn()) {
		if (Input::exists()) {
	
			if(Token::check(Input::get('token'))) {
					
				$p_id = Input::get('p_id');
				$patient = new Patient($p_id,true);
				$tests = $user->get_all_tests();
				$data = $patient->data();
				
				$date = $data->joined;
					$admitted_date = strtotime($date);
					$billing_date = time(); 
					$datediff = $billing_date - $admitted_date;
					if($datediff<86400){
						 $days = ceil(abs($datediff/(60*60*24)));
					}else{
					
						 $days = floor(abs($datediff/(60*60*24)));
					}
					
					$cabin_price = $data->cabin_price;
					$vipcabin_price = $data->vipcabin_price;
					$bed_price = $data->bed_price;
					//$ward_no = $data->ward_name;
					if($cabin_price){
						$unit_charge = $cabin_price;  
					}
					elseif($vipcabin_price){
						$unit_charge = $vipcabin_price;
					}
					elseif($bed_price){
						$unit_charge = $bed_price;
					}
					else{
						$unit_charge = 0;
					}
					
					$total_room_charge = $unit_charge * $days;
					$consulting_fees = $data->consulting_fees;
					$other_fees = $data->other_fees;
					$total_amount = $total_room_charge + $consulting_fees + $other_fees;
					
					$x = $data->test_id;
					$tids = explode(",",$x);
					if($tids){
						foreach($tids as $tid){ 
							$tid = (int)$tid;
								foreach($tests as $test){ 
									$test_id = $test->get('id');
									if($tid == $test_id){
										$test_price = $test->test_price;
										$total_amount = $total_amount+$test_price;
									}
								}
						}
					}
					
					$amount_paid = $data->amount_paid;
					$concession = $data->concession;
					$concession_amount1 = $total_amount *($concession/100);
					$concession_amount = round($concession_amount1,2);
					$net_amount1 = $total_amount - $concession_amount;
					$net_amount = round($net_amount1);
					$due = $net_amount - $amount_paid;
					if($net_amount == $amount_paid ){
						    $cabin_id = $patient->data()->cabin_id;
							$vipcabin_id = $patient->data()->vipcabin_id;
							$bed_id = $patient->data()->bed_id;
							
							if($cabin_id){
								$cabin = new Cabin();
								try {
								   $cabin->update(array(
										'status' => 0
									), $cabin_id );
								} catch(Exception $e) {
									die($e->getMessage());
								}
											
							}
							if($vipcabin_id){
								$vipcabin = new Vipcabin();
								try {
								   $vipcabin->update(array(
										'status' => 0
									), $vipcabin_id );
								} catch(Exception $e) {
									die($e->getMessage());
								}
											
							}
							if($bed_id){
								$bed = new Bed();
								try {
								   $bed->update(array(
										'status' => 0
									), $bed_id);
								} catch(Exception $e) {
									die($e->getMessage());
								}
											
							}


							try {
								$patient->update(array(
									'status' => 1
								), $p_id );
								
							Session::flash('home', 'Patient has been discharged successfully');
								} catch(Exception $e) {
									die($e->getMessage());
								}
					}else{
						try {
								$patient->update(array(
									'status' => 0
								), $p_id );
								
							Session::flash('home', 'Patient can not be discharged.Please pay due '.$due.'.');
								} catch(Exception $e) {
									die($e->getMessage());
								}
			        }
			}		
		}
		
		include('includes/header.php');
		include('includes/sidebar.php');
		include('includes/top_navigation.php');
		include('content/discharge_content.php');
		include('includes/footer.php');
	   
}
?>