<?php
$user = new User();
if($user->isLoggedIn()) {
			$allWards = $user->get_all_wards();
			$allBeds = $user->get_all_beds();	
echo '
	<!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bed Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    ';
				  if($b_id = Input::get('id')){
	                   $bed = new Bed($b_id);
					   /*$room_id = $bed->data()->room_id;
					   $room = new Room($room_id);
					   $ward_id = $room->data()->ward_id;
					   $ward = new Ward($ward_id);
					   $rooms= $ward->get_all_rooms();*/
						echo' <div class="bottom_design">
						<div class="row header_style">
							<div class="col-md-4">
								<span class="section font_style">Update Bed Info</span></div>
                       </div>
					    <form action="update_bed.php" method="post" class="form-horizontal form-label-left" novalidate>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
						</label>
					   </div>
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Ward No.
						</label>
						<div class="col-md- col-sm-6 col-xs-12">
						  <select  name="ward" id="ward"  class="form-control" class="form-control col-md-7 col-xs-12">';
						  if(count($allWards)){
						       foreach($allWards as $ward){
								 if($bed->data()->ward_id == $ward->get('id')){
							            echo'<option value="'.$ward->get('id').'"  selected="selected">'.$ward->get('ward_name').'</option>';
								 }else{
						                 echo'<option value="'.$ward->get('id').'">'.$ward->get('ward_name').'</option>';
									  }
								}  
						  }		
						  echo '</select>
						</div>
					  </div>
					  
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bed No.<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
						   <input name="bed_no" class="form-control col-md-7 col-xs-12"  value="'.$bed->data()->bed_no.'" required="required"  type="text">
						</div>
					  </div>
					 <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Bed Price Per Day<span class="required">*</span>
						</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
						  <input id="name" class="form-control col-md-7 col-xs-12"  name="bed_price" value="'.$bed->data()->bed_price.'" required="required" type="text">
						  
						</div>
					  </div>  
					  <input type="hidden" name="token" id="token" value="'. Token::generate().'">
						   <input type="hidden" name="bid" value="'.$b_id.'">
					  <div class="ln_solid no_border"></div>
					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3">
						  
						  <button id="send" type="submit" class="btn btn-success button_style">Update</button>
						</div>
					  </div>
					</form></div>
						
						';
		
                 }
                 echo' <table id="bed_datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
						  <th>Ward No.</th>
                          <th>Bed No.</th>
                          <th>Bed Price</th>
					      <th>status</th>
			              <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($allBeds)){
						  foreach($allBeds as $bed){
							// $status = $bed->get('status') ? 'booked' :'free';
							$status = $bed->get('status');
							if ($status == 0){$status="free";}else{$status="booked";}
					
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
							  <td>'.$bed->get('id').'</td>
							   <td>'.$bed->get('ward_name').'</td>
							  <td>'.$bed->get('bed_no').'</td>
							  <td>'.$bed->get('bed_price').'</td>
							   <td>'.$status.'</td>
							  <td><a href="bed_info.php?id='.$bed->get('id').'"> Modify</a> | <a href="#" data-href="delete_bed.php?id='.$bed->get('id').'"  data-toggle="modal" data-target="#confirm-delete">Delete</a> </td>
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