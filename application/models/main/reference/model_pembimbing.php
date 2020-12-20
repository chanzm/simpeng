		<?php defined('BASEPATH') OR exit('No direct script access allowed');

		class Model_pembimbing extends CI_Model {

			private $column_order 	= array('id_pembimbing');
			private $column_search 	= array('id_pembimbing','nama_pembimbing','pass_pembimbing','user_pembimbing');

			public function __construct() {
				parent::__construct();
			}

			public function _get_query(){
				$this->db->select('*');
				$this->db->from('pembimbing');
				$this->db->where('FLAG_AKTIF', 1);

				$i = 0;
				foreach ($this->column_search as $item) {
					if(isset($_POST['search']['value'])) {
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
					$this->db->order_by('id_pembimbing','ASC');
				}
			}

			public function get_pembimbing(){
				$this->_get_query();
				if(isset($_POST['length'])&&$_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
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

			public function get_pembimbing_single($id){
				$this->db->select('*');
				$this->db->from('pembimbing');
				$this->db->where('id_pembimbing', $id);

				$query = $this->db->get();
				return $query->row();
			}
			

			public function add_pembimbing($data){
				extract($data);
				$this->db->set('id_pembimbing',$id_pembimbing);
				$this->db->set('nama_pembimbing',$nama_pembimbing);
				$this->db->set('pass_pembimbing',$pass_pembimbing);
				$this->db->set('user_pembimbing',$user_pembimbing);
				$this->db->insert('pembimbing');
			}

			public function edit_pembimbing($data){
				extract($data);
				$this->db->set('id_pembimbing',$id_pembimbing);
				$this->db->set('nama_pembimbing',$nama_pembimbing);
				$this->db->set('pass_pembimbing',$pass_pembimbing);
				$this->db->set('user_pembimbing',$user_pembimbing);
				$this->db->where('id_pembimbing', $id_pembimbing);
				$this->db->update('pembimbing');
			}

			public function delete_pembimbing($data){
				extract($data);
				$this->db->query("delete from pembimbing where id_pembimbing = '".$id_pembimbing."'");
			}


		}
		