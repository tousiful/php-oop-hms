<body  onload=display_ct();>	
	<div class="right_col" role="main">

		<div class="clearfix"></div>

		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
			  
			  <div class="x_content">

				  <div class="row header_style">
						<div class="col-md-4">
							<span class="section">Add New VIP Cabin</span>
						</div>
							
						<div class="col-md-2 col-md-offset-6 date_design">Date : <?php echo date('d-m-y'); ?></div>                    
					</div>
				   <form action="" method="post">
							<div><label for="fullname">VIP Cabin No:</label><input  class="form-control input_style1" type="text" name="vipcabin_no" required /></div>
						
							<div><label for="fullname">VIP Cabin Price/Day:</label><input  class="form-control input_style1" type="text" name="vipcabin_price" required /></div>
							
							<input type="hidden" name="token" value="<?php echo Token::generate();?>">						  			  
						    
							<div class="ln_solid"></div>
					  
						   <button id="send" type="submit" class="btn btn-success">Add</button>
				
				   </form>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</body>	
