<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_barang extends CI_Controller {

	function __construct(){
	parent:: __construct();
    
    $this->load->model('model_data','barang');

	}
	
	public function index()
	{

		$isi['content'] = 'admin/data_barang';
		$isi['data'] = $this->model_data->Getbarang();
		$this->load->view('admin/tampilan',$isi);
	}

	public function hapus($id_barang)
	{
		$where = array ('id_barang' => $id_barang);
		$this->model_data->hapus_data($where, 'barang');
		redirect('admin/data_barang/');
	}
}

