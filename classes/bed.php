<?php
class Bed {
    private $_db,
            $_data,
			$id,
			$bed_no,
			$bed_price,
			$room_id,
			$ward_id,
			$room_name,
			$ward_name;
			
            
    public function __construct($bed = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($bed) {
            $this->find($bed, $associate);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('beds', $fields)) {
            throw new Exception('Sorry, there was a problem creating your bed;');
        }
    }

    public function update($fields = array(), $id = null) {
	
		if(!$this->_db->update('beds', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($bed = null, $associate = false) {
		if($bed) {
            $field = (is_numeric($bed)) ? 'id' : 'username';
            if(!$associate)
			$data = $this->_db->get('beds', array($field, '=', $bed));
			else
				$data = $this->_db->query("SELECT beds.bed_no, beds.bed_price, beds.ward_id, beds.room_id, wards.ward_name, rooms.room_name FROM wards INNER JOIN beds ON wards.id = beds.ward_id INNER JOIN rooms ON beds.room_id = rooms.id where beds.id = ?",array($bed));
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
			$this->bed_no = $result->bed_no; 
			$this->bed_price = $result->bed_price;
			$this->status = $result->status;
			//$this->ward_id = $result->ward_id;
			//$this->room_id = $result->room_id;
			//$this->room_name = $result->room_name;
			$this->ward_name = $result->ward_name;
		    return $this;
	
	}
	
	 public function delete($bed = null) {
        if($bed) {
			if(is_numeric($bed)){
				$field = 'id'; 
			}else{
				throw new Exception('Bad parameter');
            
			}
			
            if(!$this->_db->delete('beds', array($field, '=', $bed))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
 
}

 