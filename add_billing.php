<?php
date_default_timezone_set("Asia/Dhaka");
require_once 'core/init.php';

$user = new User(); 

if($user->isLoggedIn()) {
		if (Input::exists()) {
	
			if(Token::check(Input::get('token'))) {
					$p_id = Input::get('p_id');
					$patient = new Patient($p_id,true);
					$bill_no = $patient->data()->billing_id;
					
					$y = $patient->data()->consulting_fees;
					$x = Input::get('consult_fee');
					$consult_fee = $y + $x;
					
					$s = $patient->data()->concession;
					$t = Input::get('concession');
					$concession = $s + $t;
					
					$m = $patient->data()->amount_paid;
					$n = Input::get('amount_paid');
					$amount_paid = $m + $n;
					
					$p = $patient->data()->other_fees;
					$q = Input::get('other_fees');
					$other_fees = $p + $q;
					
					$j = $patient->data()->test_id;
					$k = Input::get('test');
					if($k && $j){
						$x = implode(',', $k);
						$test = $x.",".$j;
					}
					elseif($k && !$j){
						$test = implode(',', $k);
					}
					elseif(!$k && $j){
						$test = $j;
					}
					else{
						 $test ="";
					}
					/*
					$x = Input::get('test');
					if($x){
						$test = implode(',', $x);
					}else{
					   $test ="";
					}*/
					$billing = new Billing();
					try {
						
						$billing->update(array(
							//'room_unit_charge' => Input::get('charge'),
							//'total_room_charge' => Input::get('troom_charges'),
							'consulting_fees' => $consult_fee,
							'test_id' => $test,
							'other_fees' => $other_fees,
							//'total_amount' => Input::get('t_amount'),
							'concession' => $concession,
							//'net_amount' => Input::get('net_amount'),
							'amount_paid' => $amount_paid
							),$bill_no);
	
							/*$discharge = Input::get('discharge');
							if($discharge){
								   $b_id = Input::get('b_id');
									$bed = new Bed();
									try {
									   $bed->update(array(
											'status' => free
										), $b_id );
									} catch(Exception $e) {
										die($e->getMessage());
									}
									
							}*/
						 Session::flash('home', 'Bill has been paid successfully');
						 
					     } catch(Exception $e){
						     echo $error, '<br>';
					     }
						
					}
					
				}
 
			include('includes/header.php');
			include('includes/sidebar.php');
			include('includes/top_navigation.php');
			include('content/add_billing_content.php');
			include('includes/footer.php');
           
}
?>