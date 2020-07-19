<?php
    date_default_timezone_set("Asia/Dhaka");
	$user = new User(); 
	if($user->isLoggedIn()) {
		$patient= new Patient();
		$patients = $user->get_all_patients();
		$tests = $user->get_all_tests();
	
echo'   
<div class="right_col" role="main">
	<div class="page-title"></div>
	<div class="clearfix"></div>

	<div class="row">
	<form class="form-horizontal" action="" method="post" role="form">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title_view">
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
	
					<div class="row header_style">
							<div class="col-md-4">
								<span class="section">Patient Bill Payment</span>
							</div>
	                </div>
					<form action="" method="post" >';
					
					if(Session::exists('home')) {
							echo ' <div class="item form-group">
						              <label class="col-md-4 col-md-offset-4 col-sm-3 col-xs-12 message_design" for="name">
											<p>' . Session::flash('home'). '</p></label></div>';
							//echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
						}
						
					echo'
						<div><label for="fullname">Patient ID:</label>
								   <select  name="p_id" id="p_id" class="form-control input_style1" required>
										<option value>Select Patient ID</option>';
										 if(count($patients)){
											foreach($patients as $patient){
											//if($bed->data()->ward_name == $ward->get('ward_name'))
												if($patient->get('status')==0){
													echo'<option value="'.$patient->get('id').'">'.$patient->get('id').'</option>';
												}
											}
										}  
						           echo' </select>
						</div>
						
						<div ><label for="fullname">Consulting Fees:</label><input  class="form-control input_style1" type="text" name="consult_fee" id="consult_fee" /></div>
					    <div><label for="fullname">Test Name:</label><br>
               <select class="js-example-placeholder-multiple form-control" name=test[] id="test" multiple="multiple" style="width:25%;">										
		               ';
										if(count($tests)){
											foreach($tests as $test){
											//if($bed->data()->ward_name == $ward->get('ward_name'))		
												echo'<option value="'.$test->get('id').'">'.$test->get('test_name').'</option>';
											}
										}  
						           echo' </select>
						</div>
						<div><label for="fullname" style="margin-top:17px">Other Fees:</label><input class="form-control input_style1" type="text"  name="other_fees" id="other_fees" /></div>
                        
						<div><label for="fullname">Concession (%):</label><input  class="form-control input_style1" type="text"  name="concession" id="concession"/></div>
					    
						<div><label for="fullname">Amount Paid:</label><input  class="form-control input_style1" type="text"  id="amount_paid" name="amount_paid"/></div>

								
					    <input type="hidden" name="token" id="token" value="'.Token::generate().'">						  
								  
				        <div class="ln_solid"></div>
					  
						<button id="send" type="submit" class="btn btn-success">Add</button>
					    <a href="patient_info.php"><button type="button" class="btn btn-primary pull-right"></span>Payment Details</button></a>
					</form>
					
			</div>	 
		  </div>
		</div>
	  </div>
	</form>
	</div>

</div>
 ';
}
?>