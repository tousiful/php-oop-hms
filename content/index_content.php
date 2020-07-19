<?php
date_default_timezone_set("Asia/Dhaka");
$user = new User(); 
if($user->isLoggedIn()) {
	  
	  echo '
		<body  onload=display_ct();>	
		<div class="right_col" role="main">
	
			<div class="clearfix" style="text-align:center; margin-bottom:224px; margin-top:224px;">
			
               <i class="fa fa-plus-square" style="font-size:100px;color:red"></i>
				<h1> HOSPITAL MANAGEMENT SYSTEM </h1>

			</div>

			<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
				
			  </div>
			</div>
		</div>
	</body>	
  ';
}?>