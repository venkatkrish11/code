<?php

class post extends CI_Controller
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
		$this->load->model('post_model', 'post');
	}
	
	public function index()
	{	if($this->session->userdata('logged_in'))
                {
         

                $session_data = $this->session->userdata('logged_in');
                $data['pname'] = $session_data['pname'];
                $data['userid'] = $session_data['userid'];
		// Get data from model
		$data['posts'] = $this->post->getAll();
		
		// Load views
		$this->load->view('header');
                
		$this->load->view('index', $data);
		$this->load->view('footer');
                }
                else
                {
                redirect('login','refresh');
                
                }
 	}

	public function read()
	{       
                if($this->session->userdata('logged_in'))
                {
         

                $session_data = $this->session->userdata('logged_in');
                $data['pname'] = $session_data['pname'];
                $data['userid'] = $session_data['userid'];
		// Get id from uri
		$id = $this->uri->segment(3);
		
		// Get data from model
		$data['post'] = $this->post->getById($id);
		
		// Load views
		$this->load->view('header');
		$this->load->view('read', $data);
		$this->load->view('footer');
                }
               else
                {
                redirect('login','refresh');
                
                }
	}
	
	public function create()
	{	
		if($_POST)
		{
			// Build post object
			$post = new Post_model();
			$post->title = $this->input->post('title', TRUE);
			$post->content = $this->input->post('content', TRUE);
			
			// Save post to database
			if ($post->save()) {
				redirect(base_url(), 'location');
			}
		}
	
		// Load helpers
		$this->load->helper('form');
	
		// Initialize form
		$data['action'] = site_url('post/create');
		$data['title'] = NULL;
		$data['content'] = NULL;
		
		// Load views	
		$this->load->view('header');
		$this->load->view('upsert', $data);
		$this->load->view('footer');
	}
		
	public function update()
	{
		if ($_POST) 
		{
			// Build post object
			$post = new Post_model();
			$post->id = $this->uri->segment(3);
			$post->title = $this->input->post('title', TRUE);
			$post->content = $this->input->post('content', TRUE);
			
			// Save post to database
			if ($post->save()) {
				redirect(base_url(), 'location');
			}
		}
		
		// Get post from database
		$id = $this->uri->segment(3);
		$post = $this->post->getById($id);
		
		// Initialize form
		$this->load->helper('form');
		$data['action'] = site_url('post/update/'.$id);
		$data['title'] = $post->title;
		$data['content'] = $post->content;

		// Load views	
		$this->load->view('header');
		$this->load->view('upsert', $data);
		$this->load->view('footer');
	}
	
	public function delete()
	{
		$post = new Post_model();
		$post->id = $this->uri->segment(3);
		if ($post->delete()) {
			redirect(base_url(), 'location');
		}
	}	
}
