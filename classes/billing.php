<?php

class Billing {
    private $_db,
            $_data,
			$id;
            
    public function __construct($billing = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($billing) {
            $this->find($billing, $associate);
        }
    }
	public function db(){
		return $this->_db;
	}
    public function create($fields = array()) {
        if(!$this->_db->insert('billings', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
		
    }

	  public function update($fields = array(), $id = null) {
		  
		if(!$this->_db->update('billings', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($billing = null, $associate = false) {
        
		if($billing) {
            $field = (is_numeric($billing)) ? 'id' : 'username';
            if(!$associate)
				$data = $this->_db->get('billings', array($field, '=', $billing));
			else
				$data = $this->_db->query("SELECT patients.*,wards.id as ward_id,wards.ward_name,rooms.id as room_id,rooms.room_name,beds.bed_no FROM patients 
											Left JOIN beds ON patients.bed_id = beds.id 
											Left JOIN rooms ON beds.room_id = rooms.id 
											Left JOIN wards ON rooms.ward_id = wards.id  
											where patients.id =?",array($billing));
            
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
		
		    $this->p_id = $result->p_id; 
			$this->name = $result->patient_name; 
			$this->room = $result->room_name;
			$this->ward = $result->ward_name;
			$this->bed = $result->bed_no;
			$this->id = $result->id;
			$this->room_unit_charge = $result->room_unit_charge;
			$this->consulting_fees = $result->consulting_fees;
			$this->other_fees = $result->other_fees;
			$this->total_amount = $result->total_amount;
			$this->concession = $result->concession;
			$this->net_amount = $result->net_amount;
			$this->amount_paid = $result->amount_paid;
		  return $this;
	
	}
	
	 public function delete($billing = null) {
        if($billing) {
            $field = (is_numeric($billing)) ? 'id' : 'username';
            if(!$this->_db->delete('billings', array($field, '=', $billing))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
 
}

 