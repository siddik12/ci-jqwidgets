<?php
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	
	function __construct(){
            parent::__construct();
	}
	
        public function get($num_rows = FALSE, $limit = FALSE, $offset = FALSE){
		
		if($num_rows == TRUE){
                    $method = 'num_rows';
		}else{
                    $method = 'result';
                }
		
                if($limit !== FALSE && $offset !== FALSE){
                    $this->db->limit($limit, $offset);
                }
                		
		return $this->db->get($this->_table_name)->$method();
	}
	
	
}