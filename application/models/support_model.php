<?php

class support_model extends CI_Model
{		
	public function __construct() 
	{
		parent::__construct();
	}
        private function support($support) 
	{
		
		
		return $this->db->insert_string('support',$this);
	}
}
?>
