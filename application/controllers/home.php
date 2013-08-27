
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class home extends CI_Controller {


 function __construct()
 {
   parent::__construct();
   $this->load->library('session');
     $this->load->helper('url');
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {


     $session_data = $this->session->userdata('logged_in');
     $data['pname'] = $session_data['pname'];
     $data['userid'] = $session_data['userid'];
     
         redirect('post', 'refresh'); 
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('login', 'refresh');
 }

}

?>


