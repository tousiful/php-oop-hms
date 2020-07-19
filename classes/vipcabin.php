<?php
class Vipcabin {
    private $_db,
            $_data,
			$id,
			$vipcabin_no;
			
    public function __construct($vipcabin = null, $associate = false) {
        $this->_db = DB::getInstance();
        
        if($vipcabin) {
            $this->find($vipcabin, $associate );
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('vipcabins', $fields)) {
            throw new Exception('Sorry, there was a problem creating your vipcabin;');
        }
    }

    public function update($fields = array(), $id = null) {
	
		if(!$this->_db->update('vipcabins', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($vipcabin = null, $associate = false) {
        if($vipcabin) {
            $field = (is_numeric($vipcabin)) ? 'id' : 'vipcabin_no';
            if(!$associate)
				$data = $this->_db->get('vipcabins', array($field, '=', $vipcabin));
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
			$this->vipcabin_no = $result->vipcabin_no; 
			$this->vipcabin_price = $result->vipcabin_price; 
			 $this->status = $result->status; 
		    return $this;
	
	}
	
	 public function delete($vipcabin = null) {
        if($vipcabin) {
			if(is_numeric($vipcabin)){
				$field = 'id'; 
			}else{
				throw new Exception('Bad parameter');
            
			}
			
            if(!$this->_db->delete('vipcabins', array($field, '=', $vipcabin))) {
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

 