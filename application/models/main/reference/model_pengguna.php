<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengguna extends CI_Model {

	private $column_order 	= array('id_user');
	private $column_search 	= array('username','nama_user');

	public function __construct() {
		parent::__construct();
	}

	public function _get_query(){
		$this->db->select("sec_user.*",false);
		$this->db->from('sec_user');

		$i = 0;
		foreach ($this->column_search as $item) {
			if($_POST['search']['value']) {
				if($i===0){ 
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else{
					$this->db->or_like($item, $_POST['search']['value']);
				}				
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order'])){
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}else{
			$this->db->order_by('sec_user.id_user','ASC');
		}
	}

	public function get_pengguna(){
		$this->_get_query();
		if($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered() {
		$this->_get_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all() {
		$this->_get_query();
		return $this->db->count_all_results();
	}

	public function get_pengguna_single($id){
		$this->db->select("sec_user.*", false);
		$this->db->from('sec_user');
		$this->db->where('id_user', $id);

		$query = $this->db->get();
		return $query->row();
	}
	

	public function add_pengguna($data){
		extract($data);
		$this->db->set('username',$username);
		$this->db->set('password',md5($password));
		$this->db->set('nama_user',$nama_user);
		$this->db->set('foto_profil',$foto_profil);
		$this->db->set('jenis',0);
		$this->db->insert('sec_user');
	}

	public function edit_pengguna($data){
		extract($data);
		$this->db->set('id_user',$id_user);
		$this->db->set('username',$username);
		if(($temp!=$password) && ($password!='')){
			$this->db->set('password',md5($password));
		}
		$this->db->set('nama_user',$nama_user);
		$this->db->set('foto_profil',$foto_profil);
		$this->db->set('jenis',$jenis);
		$this->db->where('id_user', $id_user);
		$this->db->update('sec_user');
	}

	public function delete_pengguna($data){
		extract($data);
		$this->db->query("delete from sec_user where id_user = '".$id_user."'");
	}
}
