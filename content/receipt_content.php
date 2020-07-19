 <?php
date_default_timezone_set("Asia/Dhaka");
$user = new User();
if($user->isLoggedIn()) {
	 if($p_id = Input::get('id')){
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
?>	
 

 <div class="right_col" role="main" style="min-height: 798px; ">

          <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>

            <div class="row ">
              <div class="col-md-12 print_col">
                <div class="x_panel ">
                 
                  <div class="x_content ">

                    <section class="content invoice ">
                      <!-- title row -->
                      <div class="row">
					  
                        <div class="col-md-4 col-md-offset-4 address_design ">
						 <address class="address_print">
							  <strong>Pabna sadar Hospital</strong>
							  <br>795 Freedom Ave, Suite 600
							  <br>Pabna, CA 94107
							  <br>Phone: 1 (804) 123-9876
							  <br>Email: ironadmin.com
							    <br><br><br><b>RECEIPT</b>
                         </address>
                          
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-md-2 invoice-col ">
                      
                          <address>
                                          <strong>Patient</strong>
                                          <br>Name:<?php echo $patient->data()->patient_name;?>                                         
										  <br>Phone: <?php echo $patient->data()->telephone;?>                                      
							</address>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-8 invoice-col">
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2  invoice-col receipt_print">
                          <b>Patient Id:</b> <?php echo $patient->data()->id;?>                         
						  <br>
                          <b>Bill No:</b> <?php echo $patient->data()->billing_id;?>						  
						  <br>
                          <b>Date:</b><?php echo date('d-m-Y');?>                       
						  </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table t_design1">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="t_design1 col-xs-6">Particular Name</th>
                                <th class="t_design1 col-xs-6">Amount(Tk)</th>
                              </tr>
                            </thead>
                            <tbody>
								<tr>
								  <td> Cabin/Bed Charge Per Day</td>
                                  <td><?php 
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
									?></td>

                              </tr>
                              <tr>
                                <td>Total Cabin/Bed Charge&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $unit_charge;?> * <?php echo $days." days";?>)</td>
                                <td><?php echo escape($total_room_charge); ?></td>

                              </tr>
							  <tr>
                                <td>Consulting Fees</td>
								 <td><?php echo $patient->data()->consulting_fees;?></td>
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
								  <td><?php echo $test->get('test_name'); ?></td>
								  <td><?php echo $test->get('test_price'); ?></td>
								</tr>
								<?php 
												}           
											}

								}
								}
							?>
						    <tr>
                             <td>Other Fees</td>
                             <td><?php echo $patient->data()->other_fees;?></td>
								
                            </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      
                        <!-- /.col -->
                        <div class="col-md-4 col-md-offset-4">
                          <p class="lead lead2">Amount Details in Tk</p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Total Amount:</th>
                                  <td><?php echo $total_amount; ?></td>
                                </tr>
                                <tr>
                                  <th>Concession:</th>
                                  <td><?php echo $concession_amount;?>(<?php echo $concession;?>%)</td>
                                </tr>
                                <tr>
                                  <th>Net Amount:</th>
                                  <td><?php echo $net_amount; ?></td>
                                </tr>
                                <tr>
                                  <th>Amount Paid:</th>
                                  <td><?php echo $amount_paid; ?></td>
                                </tr>
								<tr>
                                  <th>Due:</th>
                                  <td><?php echo $due; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </section></div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
						  <a href="patient_info.php"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span>Back</span></button></a>
						</div>
                      </div>
					    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
		
<?php
	    }
    }
?>