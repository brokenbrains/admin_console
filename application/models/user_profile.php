<?php
class user_profile extends CI_Model{
	function __construct() {
		parent::__construct();
	}
	function add_user($data){
		// Inserting in Table(students) of Database(college)
		$this->db->insert('user_profile', $data);
	}
}