<?php
$user = new User();
if($user->isLoggedIn()) {
			
			/*$p_id = Input::get('id');
			$patient = new Patient($p_id);
			
			echo $patient->get_name();*/
			
			$patients = $user->get_all_patients();
			$wards = $user->get_all_wards();
			$cabins = $user->get_all_cabins();
			$vipcabins = $user->get_all_vipcabins();
			
			
			//var_dump($patients);
			
			
echo '
	<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Patient Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    ';
				  if($p_id = Input::get('id')){
	                   $patient = new Patient($p_id,true);
					   
					   $cabin_no = $patient->data()->cabin_no;
					   $vipcabin_no = $patient->data()->vipcabin_no;
					   $bed_no = $patient->data()->bed_no;
					   
						echo' <div class="bottom_design">
						<div class="row header_style">
							<div class="col-md-4">
								<span class="section font_style">Update Paitent Info</span></div>
                       </div>
					    <form action="update_patient.php" method="post" class="form-horizontal form-label-left" novalidate>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
						</label>
					   </div>
					    <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Patient Name <span class="required">*</span>
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="pname" value="'.$patient->data()->patient_name.'" required="required"  type="text">
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Father/Husband Name 
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <input id="name" class="form-control col-md-7 col-xs-12"  name="fname" value="'.$patient->data()->guardian.'" placeholder="both name(s) e.g Tausiful Islam" type="text">
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address 
						</label>
						<div class="col-md-4 col-sm-6 col-xs-12">
						  <textarea id="textarea"  name="address" class="form-control col-md-7 col-xs-12">'.$patient->data()->address.'</textarea>
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Age <span class="required">*</span>
						</label>
						<div class="col-md-2 col-sm-6 col-xs-12">
						  <input type="number" id="number" name="age" value="'.$patient->data()->age.'" required="required" data-validate-minmax="1,200" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  
					  <div class="item form-group">
						 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" value="<?php echo escape($patient->data()->gender); ?>" class="btn-group " data-toggle="buttons" >
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="gender" value="male" checked="checked"  required="required">Male
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
						  <input type="tel" id="telephone" name="phone" value="'.$patient->data()->telephone.'" required="required" data-validate-length-range="8,15" class="form-control col-md-7 col-xs-12">
						</div>
					  </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Categories(Cabin/Ward)
						</label>
					   <div class="col-md-2 col-sm-6 col-xs-12">
						<select  class="js-example-basic-single js-states select2" id="category" name="category" style="width: 100%" required>';
						
						if($cabin_no){
							
							echo '<option value="" >Select type</option>	
								<option value="cabin" selected="selected"> Cabin</option>	
								<option value="v_cabin"> Vip Cabin</option>	
								<optgroup label="Ward">';
								if(count($wards)){
									foreach($wards as $ward){
										echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
									}
								}
								echo'
								</optgroup>';
						}
						
						elseif($vipcabin_no){
							echo '<option value="" >Select type</option>	
								<option value="cabin"> Cabin</option>	
								<option value="v_cabin"  selected="selected"> Vip Cabin</option>	
								<optgroup label="Ward">';
								if(count($wards)){
									foreach($wards as $ward){
										echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
									}
								}
								echo'
								</optgroup>';
						}
						
						elseif($bed_no){
							echo '<option value="" >Select type</option>	
								<option value="cabin" > Cabin</option>	
								<option value="v_cabin"> Vip Cabin</option>	
								<optgroup label="Ward">';
								
								if(count($wards)){
									foreach($wards as $ward){
										if($patient->data()->ward_name == $ward->get('ward_name')){
											echo'<option value="'.$ward->get('id').'" selected="selected">'.$ward->get('ward_name').'</option>';
										}else{
											echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';

										}
									}
								}
								echo'
								</optgroup>';
							
						}
						else{
							echo '<option value="" >Select type</option>	
								<option value="cabin"> Cabin</option>	
								<option value="v_cabin"> Vip Cabin</option>	
								<optgroup label="Ward">';
								if(count($wards)){
									foreach($wards as $ward){
										echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
									}
								}
								echo'
								</optgroup>';
						}
						  echo'	
						</select>	
					</div>
						
                      					
						<div class="col-md-2 col-sm-6 col-xs-12">
							<select  class="form-control" id="selected_cabins"  name="selected_cabins" required>';
							if($cabin_no){
								if(count($cabins)){
									
									foreach($cabins as $cabin){
										
										if($patient->data()->cabin_no == $cabin->get('cabin_no')){
											
											echo'<option value="'.$cabin->get('id').'" selected="selected">'.$cabin->get('cabin_no').'</option>';
											$status_id = $cabin->get('id');
											$status_no = "cabin";
										}else{
											if($cabin->get('status')==0){
												
												echo'<option value="'.$cabin->get('id').'">'.$cabin->get('cabin_no').'</option>';
											}
										}
									}	
								}
							}
							
							if($vipcabin_no){
								if(count($vipcabins)){
									foreach($vipcabins as $vipcabin){
										if($patient->data()->vipcabin_no == $vipcabin->get('vipcabin_no')){
											echo'<option value="'.$vipcabin->get('id').'" selected="selected">'.$vipcabin->get('vipcabin_no').'</option>';
											$status_id = $vipcabin->get('id');
											$status_no = "v_cabin";
										}else{
											if($vipcabin->get('status')==0){
												echo'<option value="'.$vipcabin->get('id').'">'.$vipcabin->get('vipcabin_no').'</option>';
											}
										}
									}
								}	
							}
							
							if($bed_no){
								$ward_id = $patient->data()->ward_id; 
								$nward = new Ward($ward_id);
								$beds = $nward->get_all_beds();
								if(count($beds)){
									foreach($beds as $bed){
										if($patient->data()->bed_no == $bed->get('bed_no')){
											echo'<option value="'.$bed->get('id').'" selected="selected">'.$bed->get('bed_no').'</option>';
											$status_id = $bed->get('id');
											$status_no = "bed";
										}else{
											if($bed->get('status')==0){
												echo'<option value="'.$bed->get('id').'">'.$bed->get('bed_no').'</option>';
											}
										}
									}
								}	
							}
							
							
							echo'
							</select>	
						</div>
					  </div>
					   
					  <input type="hidden" name="status_id"  value="'.$status_id.'">
					  <input type="hidden" name="status_no"  value="'.$status_no.'">
					  
					  <input type="hidden" name="token" id="token" value="'.Token::generate().'">
					  <input type="hidden" name="pid" value="'.$p_id.'">
					  <div class="ln_solid no_border"></div>
					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3">
						
								  
						<button class="btn btn-success"  type="submit">Update</button>
						</div>
					  </div>
					</form>
					
					<div class="modal fade " id="submit-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog ">
							<div class="modal-content modal-sm">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title"></h4>
							  </div>
							  <div class="modal-body"></div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" data-confirm="modal">OK</button>
							  </div>
							</div>
						  </div>
					</div>
				
					</div>
						
						';
		
                 }
                 echo' <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Patient name</th>
                          <th>Address</th>
                          <th>Age</th>
						  <th>cabin/Bed No.</th>
                          <th>Admitted</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($patients)){
						  foreach($patients as $patient){
							  $cabin = $patient->get('cabin_no');
							  $vipcabin = $patient->get('vipcabin_no');
							  $bed = $patient->get('bed');
							  $ward = $patient->get('ward');
					        
							echo '
							<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog ">
									<div class="modal-content">
									
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
										</div>
									
										<div class="modal-body">
											<p>You are about to delete one track, this procedure is irreversible.</p>
											<p>Do you want to proceed?</p>
											<p class="debug-url"></p>
										</div>
										
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
											<a class="btn btn-danger btn-ok">Delete</a>
										</div>
									</div>
								</div>
							</div>
							<tr>
							  <td>'.$patient->get('id').'</td>
							  <td>'.$patient->get('name').'</td>
							  <td>'.$patient->get('address').'</td>
							  <td>'.$patient->get('age').'</td>';
							  if($cabin){
								 echo'<td>'.$cabin.'</td>';	
							  }
							  if($vipcabin){
								 echo'<td>'.$vipcabin.'</td>';	
							  }
							  if($bed){
								 echo'<td>'.$ward.' / '.$bed.'</td>';	
							  }
							  if(!$cabin && !$vipcabin && !$bed  ){
								 echo'<td>'.$cabin.'</td>';	
							  }
							  echo '
							  
							  <td>'.$patient->get('admitted').'</td>                                                                                     
							  <td><a href="view_patient.php?id='.$patient->get('id').'">View</a> | <a href="patient_info.php?id='.$patient->get('id').'"> Modify</a> | <a href="#" data-href="delete_patient.php?id='.$patient->get('id').'"  data-toggle="modal" data-target="#confirm-delete">Delete</a> | <a href="payment_details.php?id='.$patient->get('id') .'">Payment Details</a> | <a href="receipt.php?id='.$patient->get('id') .'">Make Receipt</a></td>
							</tr>';
						  }
}						  
					  echo '
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
      <!-- page content -->
';
}?>     