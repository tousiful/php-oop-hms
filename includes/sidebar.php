 <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
<a href="index.php" ><i class="fa fa-plus-square" style="font-size:22px;color:red;margin-top:14px;margin-left:10px;"></i><span style="margin-left:5px;font-weight:400;font-size:17px;color:white;">HMS</span></a>            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/tnmoy.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo escape($user->data()->name);?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  
                  <li><a><i class="fa fa-edit"></i> Patient Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="create_patient.php">Add New Patient</a>
					  <li><a href="patient_info.php">Patient Information</a>
                      </li>
                    </ul>
                  </li>
				     <li><a><i class="fa fa-edit"></i> Room Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="add_cabin.php">Add New Cabin</a></li>
					  <li><a href="cabin_info.php">Cabin Information</a></li>
					  <li><a href="add_vipcabin.php">Add New VIP Cabin</a></li>
					  <li><a href="vipcabin_info.php">VIP Cabin Information</a></li>
                      <li><a href="add_ward.php">Add New Ward</a></li>
					  <li><a href="ward_info.php">Ward Information</a></li>
					  <li><a href="add_bed.php">Add New Bed</a></li>
					  <li><a href="bed_info.php">Bed Information</a></li>
                    </ul>
                  </li>
				  
				   <li><a><i class="fa fa-edit"></i> Diagnosis <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="add_test.php">Add New Test</a></li>
					  <li><a href="test_info.php">Test Information</a></li>
                    </ul>
                  </li>
				  
                   <li><a><i class="fa fa-edit"></i> Account management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					  <li><a href="add_billing.php">Bill Payment</a></li>
                      <li><a href="discharge.php">Discharge Patient</a></li>
                    </ul>
                  </li>
				  
				 
                  
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>