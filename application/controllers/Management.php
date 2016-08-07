<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Management extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}
	public function user_management()
	{
		$this->load->library('../controllers/access');
		if( $this->require_role('admin') )
		{
			echo $this->load->view('templates/template_header', '', TRUE);
	
			//echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view('manager/user_management', '', TRUE);
	
			echo $this->load->view('templates/template_footer', '', TRUE);
		}
	}
	public function user_register()
	{
		$this->load->library('../controllers/access');
		if( $this->require_role('admin') )
		{
			echo $this->load->view('templates/template_header', '', TRUE);
	
			//echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view('manager/user_register', '', TRUE);
	
			echo $this->load->view('templates/template_footer', '', TRUE);
		}
	}
	public function costumer_management()
	{
		$this->load->library('../controllers/access');
		if( $this->require_role('admin') )
		{
			echo $this->load->view('templates/template_header', '', TRUE);
	
			//echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view('manager/costumer_management', '', TRUE);
	
			echo $this->load->view('templates/template_footer', '', TRUE);
		}
	}
	public function costumer_register()
	{
		$this->load->library('../controllers/access');
		if( $this->require_role('admin') )
		{
			echo $this->load->view('templates/template_header', '', TRUE);
	
			//echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view('manager/costumer_register', '', TRUE);
	
			echo $this->load->view('templates/template_footer', '', TRUE);
		}
	}	
	public function game_register()
	{
		$this->load->library('../controllers/access');
		if( $this->require_role('admin') )
		{
			echo $this->load->view('templates/template_header', '', TRUE);
	
			//echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view('manager/user_register', '', TRUE);
	
			echo $this->load->view('templates/template_footer', '', TRUE);
		}
	}
}