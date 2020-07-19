<?php
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$p_id = Input::get('id')) {
          Redirect::to('patient_info.php');
} else {
        $patient = new Patient($p_id,true);

    if(!$patient->exists()) {
        Redirect::to(404);
    } else {
        $data = $patient->data();

			
?>			
	


        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title_view">
                    <h2>Patient Details</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                     <div class="table-responsive control">
					 
						<table class="table">
						  <tbody>
							<tr>
							  <th >Id</th>
							  <td ><?php echo escape($data->id); ?></td>
							</tr>
							<tr>
							  <th>Patient Name</th>
							  <td><?php echo escape($data->patient_name); ?></td>
							</tr>
							<tr>
							  <th>Guardian</th>
							  <td><?php echo escape($data->guardian); ?></td>
							</tr>
							<tr>
							  <th>Address</th>
							  <td><?php echo escape($data->address); ?></td>
							</tr>
							<tr>
							  <th style="width:50%">Age</th>
							  <td><?php echo escape($data->age); ?></td>
							</tr>
							<tr>
							  <th>Gender</th>
							  <td><?php echo escape($data->gender); ?></td>
							</tr>
							<tr>
							  <th>Telephone</th>
							  <td><?php echo escape($data->telephone); ?></td>
							</tr>
							<tr>
							  <th>cabin/Bed No.</th>
							  <td>
								<?php 
									$cabin_no = $data->cabin_no;
									$vipcabin_no = $data->vipcabin_no;
									$bed_no = $data->bed_no;
									$ward_no = $data->ward_name;
									if($cabin_no){
										echo escape($cabin_no); 
									}
									if($vipcabin_no){
										echo escape($vipcabin_no); 
									}
									if($bed_no){
										echo $ward_no. " / " .$bed_no; 
									}
								?>
							  </td>
							</tr>
							<tr>
							  <th>Admitted</th>
							  <td><?php echo escape($data->joined); ?></td>
							</tr>
							<tr>
							  <th style="width:50%">Admitting Doctor's Name</th>
							  <td><?php echo escape($data->admitting_doctor_id); ?></td>
							</tr>
							<tr>
							  <th>Operator's Id</th>
							  <td><?php echo escape($data->operator_id); ?></td>
							</tr>
							<tr>
							  <th>Status</th>
							  <?php 
								$status = $data->status;
								if($status == 1){
							  ?>
							  <td>Discharge</td>
							  <?php }else{ ?>
							  <td>Current Patient</td>
							  <?php }?>
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
                
