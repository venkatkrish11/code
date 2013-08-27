<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login extends CI_Controller
{
public function __construct()
	{
		parent::__construct();
		
                  $this->load->model('account_model','account',TRUE);

                 $this->load->library('session');

		// Load libraries
		$this->load->database();

		// Load helpers
		$this->load->helper('url');
			
		// Load models
		$this->load->model('account_model', 'account');

	}
public function index()
{
		$this->load->view('html/login/login');
}
public function validate()
{
 $this->load->library('form_validation');

   $this->form_validation->set_rules('emailid', 'emailid', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     
     $this->load->view('html/login/login');
   }
   else
   {
     //Go to private area
     redirect('home', 'refresh');
}}
function check_database($password)
 {
   //Field validation succeeded.&nbsp; Validate against database
   $emailid = $this->input->post('emailid');
   $password = $this->input->post('password');
   //query the database
   $result = $this->account->login($emailid, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'userid' => $row->userid,
         'pname' => $row->pname
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}

?>





 

 


