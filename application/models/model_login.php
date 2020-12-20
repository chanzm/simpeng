<?php
class Model_login extends CI_Model{

		function admin_login($username,$password)
    {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('login_session');
		$row = $query->row_array();
		if($query->num_rows() > 0){
        return array(
			'data' => $row,
			'status' => true
		);
      	}
      else{
        return false;
      }
		}
    
  }
?>
