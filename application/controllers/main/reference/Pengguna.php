<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends App_Core_Controller {

	public function __construct() {
		parent::__construct();
		$this->check_access();
		$this->load->model('main/reference/model_pengguna');
	}

	public function index()
	{
		$data['page_title'] = 'Pengguna';
		$this->load->view('main/reference/view_pengguna',$data);
	}
	
	public function get_pengguna(){
		$list = $this->model_pengguna->get_pengguna();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $grid) {
			$row = array();
			/*Id User*/			//$row[] = $grid->id_user;;
			/*Nama User*/		$row[] = $grid->nama_user;
			/*Username*/		$row[] = $grid->username;
			/*Password*/		//$row[] = 'xxxx';
			/*Foto Profil*/		//$row[] = $grid->foto_profil;
			/*Jenis*/			$row[] = $grid->jenis;
			/*Button*/			$row[] = '<td>
											<button type="button" onclick="viewModal(\''.$grid->id_user.'\')" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> View</button>
											<button type="button" onclick="editModal(\''.$grid->id_user.'\')" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</button>
											<button type="button" onclick="deleteData(\''.$grid->id_user.'\')"  class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
										</td>';

			$data[] = $row;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->model_pengguna->count_all(),
			"recordsFiltered" 	=> $this->model_pengguna->count_filtered(),
			"data" 				=> $data,
		);

		echo json_encode($output);
	}

	public function get_pengguna_single($id){
		$result = $this->model_pengguna->get_pengguna_single($id);
		echo json_encode($result);
	}

	public function add_pengguna(){
		$this->model_pengguna->add_pengguna($_POST);
		echo 'ok';
	}

	public function update_pengguna(){
		$this->model_pengguna->edit_pengguna($_POST);
		echo 'ok';
	}

	public function delete_pengguna(){
		$this->model_pengguna->delete_pengguna($_POST);
		echo 'ok';
	}

	/* ---- Tabel Ref Dapen  ----------------------------------------------------------------------------------------- */
	public function get_fk_id_dapen(){
		$result = $this->model_pengguna->get_fk_id_dapen();
		echo json_encode($result);
	}
}
