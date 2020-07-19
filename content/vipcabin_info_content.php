<?php
$user = new User(); 
if($user->isLoggedIn()) {
			$allVipcabins = $user->get_all_vipcabins();
		
echo '
        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>VIP Cabin Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    ';
				  if($vc_id = Input::get('id')){
	                   $vipcabin = new Vipcabin($vc_id);
						echo' <div class="bottom_design">
						<div class="row header_style">
							<div class="col-md-4">
								<span class="section font_style">Update VIP Cabin Info</span></div>
                       </div>
					    <form action="update_vipcabin.php" method="post" class="form-horizontal form-label-left" novalidate>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
						</label>
					   </div>
					  		  
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">VIP Cabin No <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<input name="vipcabin_no" class="form-control col-md-7 col-xs-12"  value="'.$vipcabin->data()->vipcabin_no.'" required="required"  type="text">
						</div>
					  </div>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">VIP Cabin Price <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<input name="vipcabin_price" class="form-control col-md-7 col-xs-12"  value="'.$vipcabin->data()->vipcabin_price.'" required="required"  type="text">
						</div>
					  </div>
					  
				      <input type="hidden" id="token" value="'.Token::generate().'">
					  <input type="hidden" name="vcid" value="'.$vc_id.'">
					  
					  <div class="ln_solid no_border"></div>
					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3">
						  
						  <button id="send" type="submit" class="btn btn-success button_style">Update</button>
						</div>
					  </div>
					</form></div>
						
						';
		
                 }
                 echo' <table id="vipcabin_datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th> VIP Cabin No.</th>
						  <th>VIP Cabin Price</th>
						    <th>Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($allVipcabins)){
						  foreach($allVipcabins as $vipcabin){
					       $status = $vipcabin->get('status') ? 'booked' :'free';
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
							  <td>'.$vipcabin->get('id').'</td>
							  <td>'.$vipcabin->get('vipcabin_no').'</td>
							  <td>'.$vipcabin->get('vipcabin_price').'</td>
							   <td>'.$status.'</td>
							  <td><a href="vipcabin_info.php?id='.$vipcabin->get('id').'"> Modify</a> | <a href="#" data-href="delete_vipcabin.php?id='.$vipcabin->get('id').'"  data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
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
';
}?>     