<?php

class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null, $remember = false) {
        if(!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);

            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_sessionName, $this->data()->id);

                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

                        if (!$hashCheck->count()) {
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }

                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true;
                }
            }
        }
        return false;
    }

    public function hasPermission($key) {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->group));

        if($group->count()) {
            $permissions = json_decode($group->first()->permissions, true);

            return !empty($permissions[$key]);
        }

        return false;
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout() {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));

        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
	
	public function get_all_patients(){
	  
	  //todo
	  $data = $this->_db->query("SELECT patients.*,cabins.cabin_no,vipcabins.vipcabin_no,beds.bed_no,wards.ward_name FROM patients 
									LEFT JOIN  cabins ON patients.cabin_id = cabins.id 
									LEFT JOIN  vipcabins ON patients.vipcabin_id = vipcabins.id 
									LEFT JOIN  beds ON patients.bed_id = beds.id
									LEFT JOIN  wards ON wards.id = beds.ward_id");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$patient = new Patient();  
			$patients[]=$patient->build($result);
			
		  }
		  return $patients;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	
	
	public function get_all_wards_rooms_together(){
	  
	   $data = $this->_db->query("SELECT wards.ward_name, rooms.id, rooms.room_name FROM wards 
								   INNER JOIN rooms ON wards.id = rooms.ward_id ");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$ward = new Ward();  
			$wards[]=$ward->build_all_wards_rooms($result);
			
		  }
		  return $wards;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	
	public function get_all_billings(){
		
	  $data = $this->_db->query("SELECT patients.id as p_id,patients.patient_name,wards.ward_name,rooms.room_name,beds.bed_no, billings.* FROM patients 
							  LEFT JOIN billings ON patients.billing_id = billings.id 
							  LEFT JOIN beds ON patients.bed_id = beds.id 
							  LEFT JOIN rooms ON beds.room_id = rooms.id 
							  LEFT JOIN wards ON rooms.ward_id = wards.id");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$billing = new Billing();  
			$billings[]=$billing->build($result);
			
		  }
		  return $billings;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	public function get_all_cabins(){
	  
	  //todo
	   $data = $this->_db->query("SELECT * FROM cabins");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$cabin = new Cabin();  
			$cabins[]=$cabin->build($result);
			
		  }
		  return $cabins;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	public function get_all_vipcabins(){
	  
	  //todo
	   $data = $this->_db->query("SELECT * FROM vipcabins");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$vipcabin = new Vipcabin();  
			$vipcabins[]=$vipcabin->build($result);
			
		  }
		  return $vipcabins;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	public function get_all_wards(){
	  
	  //todo
	   $data = $this->_db->query("SELECT * FROM wards");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$ward = new Ward();  
			$wards[]= $ward->build($result);
			
		  }
		  return $wards;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	 public function get_all_beds(){
	  
	   $data = $this->_db->query("SELECT wards.ward_name,beds.id, beds.bed_no, beds.bed_price, beds.status FROM wards 
								   INNER JOIN beds ON wards.id = beds.ward_id");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$bed = new Bed();  
			$beds[]=$bed->build($result);
			
		  }
		  return $beds;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	public function get_all_tests(){
	  
	  //todo
	   $data = $this->_db->query("SELECT * FROM tests");
	  if(!$data->error() && $data->count()){
		  
		  foreach($data->results() as $result){
			$test = new Test();  
			$tests[]= $test->build($result);
			
		  }
		  return $tests;
	  }
		  
	  else
		return array();
	  
	  
	}
	
	
}


  	  
	  
	  