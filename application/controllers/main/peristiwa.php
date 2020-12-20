<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peristiwa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
  		$this->load->model('model_data','peristiwa');
	}

	// list penghargaan
	public function penghargaan(){
	$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
	   	$data['content'] = 'main/view_penghargaan';
		$data['penghargaan']=$this->model_data->fetch_kategori_penghargaan();   	
		$data['data'] = $this->model_data->Getpenghargaan();
		$this->load->view('main/tampilan_utama',$data);		
		}
	}

	public function penghargaan_taruna(){
	$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
	   	$data['content'] = 'taruna/view_penghargaan_tar';
		$data['penghargaan']=$this->model_data->fetch_kategori_penghargaan();   	
		$data['data'] = $this->model_data->Getpenghargaan();
		$this->load->view('taruna/tampilan_utama_tar',$data);		
		}
	}

	// list pelanggaran
	public function pelanggaran()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'main/view_pelanggaran';
		$data['pelanggaran']=$this->model_data->fetch_kategori_pelanggaran();
		$data['data'] = $this->model_data->Getpelanggaran();
		$this->load->view('main/tampilan_utama',$data);
		}
	}

	public function pelanggaran_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'taruna/view_pelanggaran_tar';
		$data['pelanggaran']=$this->model_data->fetch_kategori_pelanggaran();
		$data['data'] = $this->model_data->Getpelanggaran();
		$this->load->view('taruna/tampilan_utama_tar',$data);
		}
	}

	// entry penghargaan maupun pelanggaran setiap individu
	public function entry_individu()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'main/view_entry_individu';		
	    $data['penghargaan']=$this->model_data->fetch_kategori_penghargaan();   	
	    $data['pelanggaran']=$this->model_data->fetch_kategori_pelanggaran();
		$data['data'] = $this->model_data->getIndividu();
		$this->load->view('main/tampilan_utama',$data);
		}
	}

	// entry penghargaan maupun pelanggaran secara massal dengan filter kelas, angkatan maupun prodi
	public function entry_massal()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'main/view_entry_massal';
		$kelas=$this->input->post('kelas_sr');
		$tahun=$this->input->post('tahun_sr');
	    $prodi=$this->input->post('prodi_sr');
	    $data['data']=$this->model_data->cari_kl_pr_ang($kelas,$tahun,$prodi);
	    $data['penghargaan']=$this->model_data->fetch_kategori_penghargaan();   	
		$data['pelanggaran']=$this->model_data->fetch_kategori_pelanggaran();
		// $data['data'] = $this->model_data->getIndividu();
		$this->load->view('main/tampilan_utama',$data);
		}
	}
	
	//list data taruna
	public function rekap_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			
			// $url = 'http://10.0.21.30/stpn_sso/public/ApiSharingController/get_mahasiswa_list';
		
			// $opts = array(
			// 	'http'=>array(
			// 		'method'=>"GET",
			// 		'header'=>"Accept-language: en\r\n" .
			// 				"Cookie: foo=bar\r\n"
			// 	)
			// 			
			// $context = stream_context_create($opts);
			
			// Open the file using the HTTP headers set above
			//  $file = file_get_contents($url, false, $context);
			
			// $json = explode("<",$file); 

			// $json_array = json_decode($json[0]);
			// $array = json_decode(json_encode($json_array), true);
			// var_dump($json_array);

			$data['content'] = 'main/view_rekap_taruna';
			$data['taruna'] = $this->model_data->getIndividu();
			// var_dump($data['taruna']);
			// echo json_last_error();
			// die();

			$this->load->view('main/tampilan_utama',$data);
		}
	}

	private function removeBomUtf8($s){
		if(substr($s,0,3)==chr(hexdec('EF')).chr(hexdec('BB')).chr(hexdec('BF'))){
			return substr($s,3);
		}else{
			return $s;
		}	
	}
	 

	//untuk mengekspor data taruna
	public function export(){
    	$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		    header("Content-type: application/vnd-ms-excel");
		    header("Content-Disposition: attachment; filename=Data_Taruna.xls");
		    header("Pragma: no-cache");
 			header("Expires: 0");
		    
		    $data['taruna'] = $this->model_data->getIndividu();
		    $this->load->view('main/view_export', $data);
		}
	}

	//detail setiap taruna dalam melakukan penghargaan dan pelanggaran 
	public function detil_taruna($id)
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
		$data['content'] = 'main/view_detilsiswa';
			$data['ini']=$this->model_data->show_detail($id);
			$data['kat']=$this->model_data->kat_detail($id);
			
		$data['data']=$this->model_data->detil_taruna($id);
		// var_dump($data);
		$this->load->view('main/tampilan_utama',$data);
		}
	}

	//print detail taruna
	public function print_id($id){
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$data['content'] = 'main/print_detilsiswa';
			$ini=$this->model_data;
			$data['ini']=$ini->show_detail($id);
			$data['data']=$this->model_data->detil_taruna($id);
			$this->load->view('main/tampilan_print',$data);
		}
	}

	//rekap penghargaan yang pernah dilakukan 
	public function rekap_harga()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$data['content'] = 'main/view_rekapharga';
			$data['data'] = $this->model_data->get_harga();
			$data['total']=$this->model_data->get_total_penghargaan();
			$this->load->view('main/tampilan_utama',$data);
		}
	}

	//rekap penghargaan yang pernah dilakukan 
	public function rekap_harga_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
	  		$id_peristiwa=$this->input->post('peristiwa');
	  		$nim=$this->input->post('nim');
	  		$smt_melakukan=$this->input->post('smt_melakukan');
	  		// $counter_melakukan=$this->model_data->get_counter($id_peristiwa);
	  		$this->model_data->entry_individu_harga_tar($id_peristiwa,$nim,$smt_melakukan);

			$data['content'] = 'taruna/view_rekapharga_tar';
			$data['data'] = $this->model_data->get_harga();
			$data['total']=$this->model_data->get_total_penghargaan();
			$this->load->view('taruna/tampilan_utama_tar',$data);
		}
	}

	//rekap pelanggaran yang pernah dilakukan
	public function rekap_langgar()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$data['content'] = 'main/view_rekaplanggar';
			$data['data'] = $this->model_data->get_langgar();
			$data['total']=$this->model_data->get_total_pelanggaran();
			$this->load->view('main/tampilan_utama',$data);
		}
	}

	public function rekap_langgar_taruna()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$data['content'] = 'taruna/view_rekaplanggar_tar';
			$data['data'] = $this->model_data->get_langgar();
			$data['total']=$this->model_data->get_total_pelanggaran();
			$this->load->view('taruna/tampilan_utama_tar',$data);
		}
	}

	//menambah dan melakukan update data penghargaan 
	public function simpan_penghargaan(){
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
	        $id_kategori=$this->input->post('kategori');
			$nama_peristiwa=$this->input->post('nama_peristiwa');
			$counter_peristiwa=1;
	        $poin=$this->input->post('point');
			$this->model_data->simpan_peristiwa($id_kategori,$nama_peristiwa,$poin,$counter_peristiwa);
			$id_peristiwa=$this->model_data->getId($nama_peristiwa);
			$data_update=array(
				"id_peristiwa"=>$id_peristiwa,
				"id_kategori"=>$id_kategori,
				"nama_peristiwa"=>$nama_peristiwa,
				"point"=>$poin,
				"counter_peristiwa"=>$counter_peristiwa
			);
			// $this->model_data->insert_history($data_update);
			redirect('main/peristiwa/penghargaan');
		}
	}

	//menambah dan melakukan update data pelanggaran
	public function simpan_pelanggaran(){
	$username = $this->session->userdata('username'); 	
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
	        $id_kategori=$this->input->post('kategori');
	        $nama_peristiwa=$this->input->post('nama_peristiwa');
	        $counter_peristiwa=1;
	        $poin=$this->input->post('point');
			$this->model_data->simpan_peristiwa($id_kategori,$nama_peristiwa,$poin,$counter_peristiwa);
			$id_peristiwa=$this->model_data->getId($nama_peristiwa);
			$data_update=array(
				"id_peristiwa"=>$id_peristiwa,
				"id_kategori"=>$id_kategori,
				"nama_peristiwa"=>$nama_peristiwa,
				"point"=>$poin,
				"counter_peristiwa"=>$counter_peristiwa
			);
			// $this->model_data->insert_history($data_update);
			redirect('main/peristiwa/pelanggaran');	
		}
	}

	//menghapus data perghargaan
	public function hapus_penghargaan($id_peristiwa)
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
		else{
			$this->model_data->delete($id_peristiwa);
			redirect('main/peristiwa/penghargaan');
		}
	}

	//hapus data pelanggaran
	public function hapus_pelanggaran($id_peristiwa)
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$this->model_data->delete($id_peristiwa);
			redirect('main/peristiwa/pelanggaran');	
		}
	}

	//mengedit data penghargaan
	public function update_penghargaan()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('id_peristiwa');	
			$id_kategori=$this->input->post('kategori');
			$nama_peristiwa=$this->input->post('nama_peristiwa');
			$poin=$this->input->post('point');	
	        $counter_peristiwa=$this->input->post('counter_peristiwa')+1;

			$data_update=array(
				"id_peristiwa"=>$id_peristiwa,
				"id_kategori"=>$id_kategori,
				"nama_peristiwa"=>$nama_peristiwa,
				"point"=>$poin,
				"counter_peristiwa"=>$counter_peristiwa
			);

			// $this->model_data->insert_history($data_update);
			$this->model_data->update($id_peristiwa,$data_update);
			redirect('main/peristiwa/penghargaan');
		}
	}

	//mengedit data pelanggaran
	public function update_pelanggaran()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('id_peristiwa');	
			$id_kategori=$this->input->post('kategori');
			$nama_peristiwa=$this->input->post('nama_peristiwa');
			$poin=$this->input->post('point');	
	        $counter_peristiwa=$this->input->post('counter_peristiwa')+1;

			$data_update=array(
				"id_peristiwa"=>$id_peristiwa,
				"id_kategori"=>$id_kategori,
				"nama_peristiwa"=>$nama_peristiwa,
				"point"=>$poin,
				"counter_peristiwa"=>$counter_peristiwa
			);

			// $this->model_data->insert_history($data_update);
			$this->model_data->update($id_peristiwa,$data_update);
		
			redirect('main/peristiwa/pelanggaran');
		}
	}
	
	//menambah data penghargaan pada entry individu
	public function entry_penghargaan()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('peristiwa');
			$nim=$this->input->post('nim');
			$smt_melakukan=$this->input->post('smt_melakukan');
			$counter_melakukan=$this->model_data->get_counter($id_peristiwa);
			$this->model_data->entry_individu_harga($id_peristiwa,$nim,$smt_melakukan,$counter_melakukan);
			redirect('main/peristiwa/entry_individu');
		}
	}

	//menambah data pelanggaran pada entry individu
	public function entry_pelanggaran()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('peristiwa');
			$nim=$this->input->post('nim');
			$smt_melakukan=$this->input->post('smt_melakukan');
			$counter_melakukan=$this->model_data->get_counter($id_peristiwa);
			$this->model_data->entry_individu_langgar($id_peristiwa,$nim,$smt_melakukan,$counter_melakukan);
			redirect('main/peristiwa/entry_individu');
		}
	}

	//mengambil data peristiwa pada setiap kategori
	public function fetch_peristiwa(){
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			if($this->input->post('id_kategori')){
				echo $this->model_data->fetch_peristiwa($this->input->post('id_kategori'));
			}
		}
	}

	//mengambil poin pada setiap peristiwa
	public function fetch_poin(){
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			if($this->input->post('id_peristiwa')){
				echo $this->model_data->fetch_poin($this->input->post('id_peristiwa'));
			}
		}
	}

	//entry penghargaan taruna secara massal 
	public function entry_penghargaan_massal()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('peristiwa');
			$nim=$this->input->post('nim_form1');
			$nim_entry=explode(",",$nim);
			$smt_melakukan=$this->input->post('smt_melakukan');
			$counter_melakukan=$this->model_data->get_counter($id_peristiwa);
			foreach($nim_entry as $n){
				$this->model_data->entry_individu_harga($id_peristiwa,$n,$smt_melakukan,$counter_melakukan);	
			}
			redirect('main/peristiwa/entry_massal');
		}
	}

	//entry pelanggaran taruna secara massal
	public function entry_pelanggaran_massal()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$id_peristiwa=$this->input->post('peristiwa_pel');
			$nim=$this->input->post('nim_form2');
			$nim_entry=explode(",",$nim);
			$smt_melakukan=$this->input->post('smt_melakukan');
			$counter_melakukan=$this->model_data->get_counter($id_peristiwa);
			foreach($nim_entry as $n){
				$this->model_data->entry_individu_langgar($id_peristiwa,$n,$smt_melakukan,$counter_melakukan);	
			}
			redirect('main/peristiwa/entry_massal');
		}
	}

	//filter pencarian data kelas, prodi, maupun angkatan pada entry massal
	public function search_kl_pr_ang()
	{
		$username = $this->session->userdata('username');
		if($username==""){
	   		$this->load->view('view_login');
	  	}
	  	else{
			$data['content'] = 'main/print_entry_massal';
			$ini=$this->model_data->cari_kl_pr_ang($_POST);
			echo json_encode($ini);
		}
	}

}
