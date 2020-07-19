<?php
$user = new User(); //Current
if($user->isLoggedIn()) {
			
			$wards = $user->get_all_wards();
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
                    <h2>Ward Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content"> 
				  ';
				  if($w_id = Input::get('id')){
	                   $ward = new Ward($w_id);
						echo' <div class="row header_style">
											<div class="col-md-4">
												<span class="section">Update Ward</span></div>
												<div class="col-md-4"></div>
												
									   </div>
										<form action="update_ward.php" method="post" class="form-horizontal form-label-left" novalidate>
									   <div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
										</label>
									   </div>
									  
									   <div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Ward Name <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										  <input id="name" class="form-control col-md-7 col-xs-12" name="wname" value="'.$ward->data()->ward_name.'" required="required"  type="text">
										  <input type="hidden" name="wid" value="'.$w_id.'">
										</div>
									  </div>
									  <div class="ln_solid"></div>
									  <div class="form-group">
										<div class="col-md-6 col-md-offset-3">
										  
										  <button id="send" type="submit" class="btn btn-success">Update</button>
										</div>
									  </div>
									</form>
						
						';
		
                 }
                    
                   echo' <table id="ward_datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Ward name</th>
						  <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($wards)){
						  foreach($wards as $ward){
					       
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
							  <td>'.$ward->get('id').'</td>
							  <td>'.$ward->get('ward_name').'</td>
							  <td><a href="ward_info.php?id='.$ward->get('id').'"> Modify</a> | <a href="#" data-href="delete_ward.php?id='.$ward->get('id').'"  data-toggle="modal" data-target="#confirm-delete">Delete</a> </td>
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