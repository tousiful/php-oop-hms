<?php
    date_default_timezone_set("Asia/Dhaka");
	$user = new User(); 
	if($user->isLoggedIn()) {
		$ward= new Ward();
		$wards = $user->get_all_wards();
		
		echo'
		<body  onload=display_ct();>	
		<div class="right_col" role="main">

			<div class="clearfix"></div>

			<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  
				  <div class="x_content">

					  <div class="row header_style">
							<div class="col-md-4">
								<span class="section">Add New Bed</span>
							</div>
		
							<div class="col-md-2 col-md-offset-6 date_design">Date : '.date('d-m-y').'</div>                  
						</div>
					   <form action="" method="post" >
					       <div>
								
								<div><label for="fullname">Ward No.:</label>
								   <select  name="ward" id="ward" class="form-control input_style1"  required>
								   <option value="">Select ward</option>';
								   if(count($wards)){
						              foreach($wards as $ward){
											//if($bed->data()->ward_name == $ward->get('ward_name'))		
									   echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
									  }
								   }  
						          echo' </select>
						        </div>
							
								<div><label for="fullname">Bed No:</label><input  class="form-control input_style1" type="text" name="bed_no" required /></div>
								<div><label for="fullname">Bed Price/Day:</label><input  class="form-control input_style1" type="text" name="bed_price" required /></div>
                                
								
								 <input type="hidden" name="token" id="token" value="'.Token::generate().'">						  
						  </div>				  
						   <div class="ln_solid"></div>
					  
						  <button id="send" type="submit" class="btn btn-success">Add</button>
					
					   </form>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	</body>	
 ';
}
?>

