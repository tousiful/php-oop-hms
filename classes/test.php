<?php
class Test {
    private $_db,
            $_data,
			$id,
			$bed_no,
			$bed_price,
			$room_id,
			$ward_id,
			$room_name,
			$ward_name;
			
            
    public function __construct($test = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($test) {
            $this->find($test, $associate);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('tests', $fields)) {
            throw new Exception('Sorry, there was a problem creating your test;');
        }
    }

    public function update($fields = array(), $id = null) {
	
		if(!$this->_db->update('tests', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($test = null, $associate = false) {
		if($test) {
            $field = (is_numeric($test)) ? 'id' : 'username';
            if(!$associate)
			$data = $this->_db->get('tests', array($field, '=', $test));
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
			$this->test_name = $result->test_name; 
			$this->test_price = $result->test_price;
			//$this->ward_id = $result->ward_id;
			//$this->room_id = $result->room_id;
			//$this->room_name = $result->room_name;
		    return $this;
	
	}
	
	 public function delete($test = null) {
        if($test) {
			if(is_numeric($test)){
				$field = 'id'; 
			}else{
				throw new Exception('Bad parameter');
            
			}
			
            if(!$this->_db->delete('tests', array($field, '=', $test))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
 
}

 