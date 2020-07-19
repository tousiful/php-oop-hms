<?php

$user = new User(); //Current
if($user->isLoggedIn()) {
			/*$p_id = Input::get('id');
			$patient = new Patient($p_id);
			echo $patient->get_name();*/
			$billings = $user->get_all_billings();
			//var_dump($patients);		
echo '
        <div class="right_col" role="main">
            <div class="page-title"></div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Billing Information</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    ';
                 echo' <table id="billing_datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Patient Id</th>
                          <th>Bill No</th>
                          <th>Patient Name</th>
                          <th>Net Amount</th>
						  <th>Amount Paid</th>
                          <th>Action</th>
                        </tr>
                      </thead>


                      <tbody>
					  ';
					  if(count($billings)){
						  foreach($billings as $billing){
					
							echo '
							<tr>
							  <td>'.$billing->get('p_id').'</td>
							  <td>'.$billing->get('id').'</td>
							  <td>'.$billing->get('name').'</td>
							  <td>'.$billing->get('net_amount').'</td>
							  <td>'.$billing->get('amount_paid').'</td>
							  <td><a href="add_billing.php?id='.$billing->get('p_id').'">Payment</a> |<a href="receipt.php?id='.$billing->get('p_id').'"> Make Receipt</a> </td>
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