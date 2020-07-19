<?php
class Ward {
    private $_db,
            $_data,
			$id,
			$ward_name,
			$bed_id,
			$bed_no,
			$bed_price,
			$status;
			
            
    public function __construct($ward = null) {
        $this->_db = DB::getInstance();
        
        if($ward) {
            $this->find($ward);
        }
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('wards', $fields)) {
            throw new Exception('Sorry, there was a problem creating your ward;');
        }
    }

    public function update($fields = array(), $id = null) {
	
		if(!$this->_db->update('wards', $id, $fields)) {
			throw new Exception('There was a problem updating');
		}
	}

    public function find($ward = null) {
        if($ward) {
            $field = (is_numeric($ward)) ? 'id' : 'ward_name';
            $data = $this->_db->get('wards', array($field, '=', $ward));

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
			$this->ward_name = $result->ward_name; 
		    return $this;
	
	}
	
	 public function delete($ward = null) {
        if($ward) {
			if(is_numeric($ward)){
				$field = 'id'; 
			}else{
				throw new Exception('Bad parameter');
            
			}
			
            if(!$this->_db->delete('wards', array($field, '=', $ward))) {
               throw new Exception('Sorry, there was a problem in deleting ;');
            }
        
        }
    }
	
	public function get_all_beds(){
		
		    $w_id =$this->data()->id; 
			$data = $this->_db->query("SELECT * FROM beds where beds.ward_id=?",array($w_id));
	  
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

 