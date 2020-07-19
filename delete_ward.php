 <?php
require_once 'core/init.php';
$user = new User(); //Current
if($user->isLoggedIn()) {
	   if(!$w_id = Input::get('id')) {
          Redirect::to('ward_info.php');
		} else {
				$ward = new Ward();
			  try {
					$ward->delete($w_id);
					Redirect::to('ward_info.php');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
		} 
}
?>		