<?php
  require_once 'core/init.php';
	$user = new User(); 
	if($user->isLoggedIn()) {
		$token_id=Input::get('tokenId');
		if(Token::check($token_id, true)) {

			if (Input::exists()) {
			
				$cabinType = Input::get('cabinType');
				
				if($cabinType == cabin){
					
					$cabins = $user->get_all_cabins();
					$output = '<option value="" selected="selected">Select Cabin</option>';
					if(count($cabins)){
						 foreach($cabins as $cabin){
							$status = $cabin->get('status');
							if($status == 0){
								$output .= '<option value="'.$cabin->get('id').'">'.$cabin->get('cabin_no').'</option>';
							}
						}
					}
				}

				if($cabinType == v_cabin){
					
					$vipcabins = $user->get_all_vipcabins();
					$output = '<option value="">Select Vip cabin</option>';
					if(count($vipcabins)){
						 foreach($vipcabins as $vipcabin){
							$status = $vipcabin->get('status');
							if($status == 0){
								$output .= '<option value="'.$vipcabin->get('id').'">'.$vipcabin->get('vipcabin_no').'</option>';
							}
						}
					}
				}
				
				$wards = $user-> get_all_wards();
				if(count($wards)){
					
					foreach($wards as $ward){
						$ward_id = $ward-> get('id'); 
						
						if($cabinType == $ward_id){
							$nward = new Ward($cabinType);
							$beds = $nward->get_all_beds();
							$output = '<option value="">Select Bed</option>';
							if(count($beds)){
								 foreach($beds as $bed){
									$status = $bed->get('status');
									if($status == 0){ 
										$output .= '<option value="'.$bed->get('id').'">'.$bed->get('bed_no').'</option>';
									}
								}
							}
						}
					}
				}
				
				echo $output;
			}
		}
	}	
?>