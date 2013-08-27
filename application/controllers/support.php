<?php

class support extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// Load libraries
		$this->load->database();

		// Load helpers
		$this->load->helper('url');
                $this->load->library('session');
		// Load models
		$this->load->model('support_model', 'support');
	}
        public function index()
        {
         if($this->session->userdata('logged_in'))
                {
         
                
                $session_data = $this->session->userdata('logged_in');
                $userid = $session_data['userid'];
                $id = $this->uri->segment(3);
		        
                $support->userid=$userid;
                $support->id=$id;
                if ($support->support()) {
				redirect(base_url(), 'location');
			}
                }
                else
                {
                redirect('login','refresh');
                
                }
        }
}
?>
