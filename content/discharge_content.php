<?php
    date_default_timezone_set("Asia/Dhaka");
	$user = new User(); 
	if($user->isLoggedIn()) {
		$patient= new Patient();
		$patients = $user->get_all_patients();
	
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
								<span class="section">Discharge Patient</span>
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
						
						

								
					    <input type="hidden" name="token" id="token" value="'.Token::generate().'">						  
								  
				        <div class="ln_solid"></div>
					  
						<button id="discharge" type="submit" class="btn btn-success">Discharge</button>
					
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