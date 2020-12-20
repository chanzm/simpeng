<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Taruna extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
  		$this->load->model('taruna_model');
	}

	public function index(){
		$this->load->view('');
	}

	public function pelanggaran_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'taruna/view_rekaplanggar_tar';

		$id = $this->session->userdata('username')['nim'];
		//var_dump($id);
			
		$data['data'] = $this->taruna_model->get_pelanggaran_by_taruna($id);
		$this->load->view('taruna/tampilan_utama_tar',$data);
		}
	}

	public function penghargaan_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'taruna/view_rekapharga_tar';

		$id = $this->session->userdata('username')['nim'];
		//var_dump($id);
			
		$data['data'] = $this->taruna_model->get_penghargaan_by_taruna($id);
		$this->load->view('taruna/tampilan_utama_tar',$data);
		}
	}
}
