<?php
$user = new User(); 
if($user->isLoggedIn()) {
			$allTests = $user->get_all_tests();
		
echo '
        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cabin Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    ';
				  if($t_id = Input::get('id')){
	                   $test = new Test($t_id);
						echo' <div class="bottom_design">
						<div class="row header_style">
							<div class="col-md-4">
								<span class="section font_style">Update Test Info</span></div>
                       </div>
					    <form action="update_test.php" method="post" class="form-horizontal form-label-left" novalidate>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Reqired Fields = *
						</label>
					   </div>
					  		  
					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Test Name <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<input name="test_name" class="form-control col-md-7 col-xs-12"  value="'.$test->data()->test_name.'" required="required"  type="text">
						</div>
					  </div>
					   <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Test Price <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						<input name="test_price" class="form-control col-md-7 col-xs-12"  value="'.$test->data()->test_price.'" required="required"  type="text">
						</div>
					  </div>
					  
				      <input type="hidden" id="token" value="'.Token::generate().'">
					  <input type="hidden" name="tid" value="'.$t_id.'">
					  
					  <div class="ln_solid no_border"></div>
					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3">
						  
						  <button id="send" type="submit" class="btn btn-success button_style">Update</button>
						</div>
					  </div>
					</form></div>
						
						';
		
                 }
                 echo' <table id="test_datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Test Name</th>
						  <th>Test Price</th>
						  <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($allTests)){
						  foreach($allTests as $test){
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
							  <td>'.$test->get('id').'</td>
							  <td>'.$test->get('test_name').'</td>
							  <td>'.$test->get('test_price').'</td>
							  <td><a href="test_info.php?id='.$test->get('id').'"> Modify</a> | <a href="#" data-href="delete_test.php?id='.$test->get('id').'"  data-toggle="modal" data-target="#confirm-delete">Delete</a></td>
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