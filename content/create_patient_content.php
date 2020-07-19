<?php
date_default_timezone_set("Asia/Dhaka");
$user = new User(); 
if($user->isLoggedIn()) {
			
	  $wards = $user->get_all_wards();
	  
	  echo '
		<body  onload=display_ct();>	
		<div class="right_col" role="main">
	
			<div class="clearfix"></div>

			<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				  
				  <div class="x_content">

					  <div class="row header_style">
							<div class="col-md-4">
								<span class="section">Insert Paitent Info</span></div>
								<div class="col-md-2 col-md-offset-6 date_design">Date : '.date('d-m-y').'</div>
                       </div>
					    <form action="" method="post" class="form-horizontal form-label-left" novalidate>';
						
						if(Session::exists('home')) {
							echo ' <div class="item form-group">
						              <label class="col-md-4 col-md-offset-4 col-sm-3 col-xs-12 message_design" for="name">
											<p>' . Session::flash('home'). '</p></label></div>';
							//echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
						}
						
                    echo '
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
						</label>
					   </div>
					  
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Patient Name <span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <input id="name" class="form-control col-md-5 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="pname" placeholder="both name(s) e.g Tausiful Islam"  required="required"  type="text">
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father/Husband Name 
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <input id="name" class="form-control col-md-7 col-xs-12"  name="fname" placeholder="both name(s) e.g Tausiful Islam" type="text">
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address 
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <textarea id="textarea"  name="address" class="form-control col-md-7 col-xs-12"></textarea>
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Age <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
						  <input type="number" id="text" name="age" required="required" data-validate-minmax="1,200" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="item form-group">
						 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group " data-toggle="buttons"  >
                            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" >
                              <input type="radio" name="gender" value="male" checked>Male
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="female" > Female
                            </label>
                          </div>
                        </div>
                      </div>
					  </div>
					  
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
						  <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,15" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Categories(Cabin/Ward)
						</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
						<select  class="js-example-basic-single js-states select2" id="category" name="category" style="width: 100%">
							<option value="" selected="selected">Select type</option>	
							<option value="cabin"> Cabin</option>	
							<option value="v_cabin"> Vip Cabin</option>	
						    <optgroup label="Ward">';
							if(count($wards)){
								foreach($wards as $ward){
									echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
								}
							}
							echo'
							</optgroup>
						</select>	
						</div>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<select  class="form-control" id="selected_cabins"  name="selected_cabins">
							</select>	
						</div>
					  </div>
					  
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Admitting Doctor Name <span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12" >
						  <select  name="adname"  class="form-control col-md-7 col-xs-12 required" >
							<option></option>
							<option value="3">Rahman khan</option>
							<option  value="4" >Rakib Islam</option>
						  </select>
						</div>
					  </div>
					  
					  <input type="hidden" name="token" id="token" value="'.Token::generate().'">
					  <div class="ln_solid"></div>
					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3">
						  
						  <button id="send" type="submit" class="btn btn-success">Add</button>
						</div>
					  </div>
					</form>
					
				  </div>
				</div>
			  </div>
			</div>
		</div>
	</body>	
  ';
}?>