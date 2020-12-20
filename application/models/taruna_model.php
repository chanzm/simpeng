<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taruna_model extends CI_Model {

	public function get_pelanggaran_by_taruna($id){
		$query=$this->db->query("SELECT m.*, p.*, k.flag, k.nama_kategori from melakukan m left join history_peristiwa p on m.id_peristiwa=p.id_peristiwa join kategori k on k.id_kategori=p.id_kategori where p.counter_peristiwa=m.counter_melakukan and m.nim='".$id."' and k.flag = '2'");
		$ret_val= $query->result_array();
		
		return $ret_val;
	}

	public function get_penghargaan_by_taruna($id){
		$query=$this->db->query("SELECT  m.*, p.*, k.flag, k.nama_kategori from melakukan m left join history_peristiwa p on m.id_peristiwa=p.id_peristiwa join kategori k on k.id_kategori=p.id_kategori where p.counter_peristiwa=m.counter_melakukan and m.nim='".$id."' and k.flag = '1'");
		$ret_val= $query->result_array();
		
		return $ret_val;
	}
}
