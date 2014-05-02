<?php ini_set('memory_limit', '2560M');
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller 
{	
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('musers');
	    $this->load->model('mcountry');
	    $this->load->theme('frontend');	
	    //$this->output->enable_profiler(TRUE);
	    $this->load->helper('auth');
	    $this->load->helper('cookie');
	    $this->load->library('pagination');
	    $this->load->library('image_lib');
	    $this->load->library('facebook');
	}
	
	public function index()
	{
	    $curr_url = htmlentities(base_url().'package'); 
	    $this->session->set_userdata('packageback', $curr_url);
	   
	    if(!isMemberLoggedIn()) 
	    {
		 redirect("home/signin");
	    }
	    
	    $data["packsDtls"] = $this->musers->getAllpack();
		$user_id = $this->session->userdata('user_id');
	    
		$data['user_details'] = $this->musers->getUserById($user_id);
		
	    //print_r($data);
	    $data["site_title"] = 'Cardsleaf';
	    $this->load->view('package', $data);
	}
	
	
	
	
   
	
	
}

/* end of file home.php*/