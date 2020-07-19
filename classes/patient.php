<?php

class Patient {
    private $_db,
            $_data,
			$id,
			$name,
			$address,
			$age,
			$gender,
			$telephone,
			$ward,
			$bed,
			$price,
			$nurse,
			$cabin_no,
			$vipcabin_no,
			$doctor,
			$director,
			$admitted;
            
    public function __construct($patient = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($patient) {
            $this->find($patient, $associate);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('patients', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

	  public function update($fields = array(), $id = null) {
		  
		if(!$this->_db->update('patients', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($patient = null, $associate = false) {
        
		if($patient) {
            $field = (is_numeric($patient)) ? 'id' : 'username';
            if(!$associate)
				$data = $this->_db->get('patients', array($field, '=', $patient));
			else
				$data = $this->_db->query("SELECT patients.*,billings.id as billing_id,billings.room_unit_charge,billings.consulting_fees,billings.test_id,billings.other_fees,billings.total_amount,billings.concession,billings.net_amount,billings.amount_paid, billings.total_room_charge, wards.id as ward_id,wards.ward_name,beds.id as bed_id,beds.bed_no,beds.bed_price, beds.status as status1,cabins.id as cabin_id,cabins.cabin_no,cabins.cabin_price,cabins.status as status2,vipcabins.id as vipcabin_id, vipcabins.vipcabin_no,vipcabins.vipcabin_price,vipcabins.status as vstatus FROM patients 
											Left JOIN billings ON patients.billing_id = billings.id 
											Left JOIN cabins ON patients.cabin_id = cabins.id 
											Left JOIN vipcabins ON patients.vipcabin_id = vipcabins.id 
											Left JOIN beds ON patients.bed_id = beds.id 
											Left JOIN wards ON wards.id = beds.ward_id  
											where patients.id =?",array($patient));
            
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

   
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

   

    public function data(){
        return $this->_data;
    }
	public function get($key){
        return $this->$key;
    }
	
	public function build($result){
		
		    $this->id = $result->id; 
			$this->name = $result->patient_name; 
			$this->address = $result->address;
			$this->age = $result->age;
			$this->cabin_no = $result->cabin_no;
			$this->vipcabin_no = $result->vipcabin_no;
			$this->ward = $result->ward_name;
			$this->bed = $result->bed_no;
			$this->doctor = $result->admitting_doctor_id;
			$this->admitted = $result->joined;
			$this->status = $result->status;
		
		  return $this;
	
	}
	
	 public function delete($patient = null) {
        if($patient) {
            $field = (is_numeric($patient)) ? 'id' : 'username';
            if(!$this->_db->delete('patients', array($field, '=', $patient))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
 
}

 