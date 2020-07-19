<?php
date_default_timezone_set("Asia/Dhaka");
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$p_id = Input::get('id')) {
          Redirect::to('patient_info.php');
} else {
        $patient = new Patient($p_id,true);

    if(!$patient->exists()) {
        Redirect::to(404);
    } else {
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
			

			
			
			
?>			
	


        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title_view">
                    <h2>Payment Details</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                     <div class="table-responsive control">
					 
						<table class="table">
						  <tbody>
							<tr>
							  <th >Patient Id</th>
							  <td ><?php echo escape($data->id); ?></td>
							</tr>
							<tr>
							  <th>Patient Name</th>
							  <td><?php echo escape($data->patient_name); ?></td>
							</tr>
							
							<tr>
							  <th>Telephone</th>
							  <td><?php echo escape($data->telephone); ?></td>
							</tr>
							<tr>
							  <th>Cabin/Bed No.</th>
							  <td>
								<?php 
									$cabin_no = $data->cabin_no;
									$vipcabin_no = $data->vipcabin_no;
									$bed_no = $data->bed_no;
									$ward_no = $data->ward_name;
									if($cabin_no){
										echo escape($cabin_no); 
									}
									elseif($vipcabin_no){
										echo escape($vipcabin_no); 
									}
									elseif($bed_no){
										echo $ward_no. " / " .$bed_no; 
									}
									else{
										echo "No Bed Assigned"; 
									}
								?>
							  </td>
							</tr>
							<tr>
							  <th>Cabin/Bed Charge per Day</th>
								  <td>
								  <?php 
										$cabin_price = $data->cabin_price;
										$vipcabin_price = $data->vipcabin_price;
										$bed_price = $data->bed_price;
										//$ward_no = $data->ward_name;
										if($cabin_price){
											echo escape($cabin_price); 
										}
										elseif($vipcabin_price){
											echo escape($vipcabin_price); 
										}
										elseif($bed_price){
											echo escape($bed_price);
										}
										else{
											echo escape(0);
										}
									?>
								  </td>
							</tr>
							<tr>
							  <th style="width:50%">Total Cabin/Bed Charge&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $unit_charge;?> * <?php echo $days." days";?>)</th>
							  <td><?php echo escape($total_room_charge); ?></td>
							</tr>
							<tr>
							  <th>Consulting Fees</th>
							  <td><?php echo $data->consulting_fees; ?></td>
							</tr>
							
							<?php
							if($tids){
							foreach($tids as $tid){ 
									$tid = (int)$tid;
										foreach($tests as $test){ 
											$test_id = $test->get('id');
											if($tid == $test_id){
							      
							?>
							<tr>
							  <th><?php echo $test->get('test_name'); ?></th>
							  <td><?php echo $test->get('test_price'); ?></td>
							</tr>
							<?php 
							                }           
								        }

						    }
							}
							?>
							
							<tr>
							  <th>Other Fees</th>
							  <td><?php echo $data->other_fees; ?></td>
							</tr>
							<tr>
							  <th>Concession(%)</th>
							  <td><?php echo $concession; ?></td>
							</tr>
							<tr>
							  <th>Total Amount</th>
							  <td><?php echo $total_amount; ?></td>
							</tr>
							
							<tr>
							  <th>Concession Amount</th>
							  <td><?php echo $concession_amount; ?></td>
							</tr>
							<tr>
							  <th>Net Amount</th>
							  <td><?php echo $net_amount; ?></td>
							</tr>
							<tr>
							  <th>Amount Paid</th>
							  <td><?php echo $amount_paid; ?></td>
							</tr>
							<tr>
							  <th>Status</th>
							  <?php
								$status = $data->status;
								 if($status == 1){
							  ?>
							  <td>Discharge</td>
							  <?php 
								 }elseif($status == 0 && $total_amount != 0){
							  ?>
							  <td><?php echo "Due is ".$due.". (Current Patient)"; ?></td>
							   <?php 
							   }else{
							  ?>
							  <td>Current Patient</td>
							   <?php 
							   }
							   ?>
							</tr>
						  </tbody>
						</table>
	                </div>
				      <a href="patient_info.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Back</button></a>
                  </div>
                </div>
              </div>
            </div>
        
        </div>
  
  
  
 <?php
    }
} 
  
} 
                
