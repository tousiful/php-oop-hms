<?php
class Cabin {
    private $_db,
            $_data,
			$id,
			$cabin_no;
			
    public function __construct($cabin = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($cabin) {
            $this->find($cabin, $associate );
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('cabins', $fields)) {
            throw new Exception('Sorry, there was a problem creating your cabin;');
        }
    }

    public function update($fields = array(), $id = null) {
	
		if(!$this->_db->update('cabins', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($cabin = null, $associate = false) {
        if($cabin) {
            $field = (is_numeric($cabin)) ? 'id' : 'cabin_no';
            if(!$associate)
				$data = $this->_db->get('cabins', array($field, '=', $cabin));
			else
				$data = $this->_db->query("SELECT wards.ward_name, rooms.room_name FROM wards INNER JOIN rooms ON wards.id = rooms.ward_id where rooms.id = ?",array($cabin));

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
			$this->cabin_no = $result->cabin_no; 
			$this->cabin_price = $result->cabin_price; 
			$this->status = $result -> status; 
		    return $this;
	
	}
	
	 public function delete($cabin = null) {
        if($cabin) {
			if(is_numeric($cabin)){
				$field = 'id'; 
			}else{
				throw new Exception('Bad parameter');
            
			}
			
            if(!$this->_db->delete('cabins', array($field, '=', $cabin))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
	
	public function get_all_beds(){
		
		 $r_id =$this->data()->id; 
		 $data = $this->_db->query("SELECT * FROM beds where beds.room_id=?",array($r_id));
		
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
	
}

 