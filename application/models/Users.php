<?php
class Users extends CI_Model 
{
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function getAllUser() {
		return $this->db->get('Users')->result();
	}
	
	function getNumOfUser() {
		return $this->db->get('Users')->num_rows();
	}
	
	function getUserEmail($email) {
		$this->db->where('email', $email);
		$this->db->limit(1);
		
		return $this->db->get('Users')->result();
	}
	
	function getThisUser($usr, $pwd) {
		$this->db->where('name', $usr);
		$this->db->where('password', hash( "sha256", $pwd));
		$this->db->limit(1);
		
		return $this->db->get('Users')->result();
	}
	
	function insertUser($usr, $email, $pwd) {
		$insert_data = array(
			'name' => $usr,
			'email' => $email,
			'password' => hash( "sha256", $pwd)
		);
		
		$insert = $this->db->insert('Users', $insert_data);
		print_r($insert);
		
		return $this->db->insert_id();
	}
	
	function updateUser($id, $usr, $email, $pwd) {
		$update_data = array(
			'name' => $usr,
			'email' => $email,
			'password' => hash( "sha256", $pwd)
		);

		$this->db->where('id', $$id);
		$this->db->limit(1);
		
		$this->db->update('Users', $update_data);
		return $this->db->affected_rows();
	}
}
?>