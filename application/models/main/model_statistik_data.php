<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_statistik_data extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_tahun_available(){
		$query=$this->db->query("select distinct tahun from rep_data order by tahun asc");
		return $query->result_array();
	}

	public function get_jenis_grafik($data){
		extract($data);
		$query=$this->db->query("select * from ref_jenis_data where id_data in (".$jenis.") order by id_data asc");
		return $query->result_array();
	}

	public function get_data_dapen($data){
		extract($data);
		$query=$this->db->query("select * from ref_dapen where id_dapen in (".$dapen.") order by id_dapen asc");
		return $query->result_array();
	}

	public function get_data_grafik($data){
		$jenis_grafik = $this->get_jenis_grafik($data);
		$temp_jenis_grafik = array();
		for ($y=0; $y < sizeof($jenis_grafik) ; $y++) { 
			$temp_jenis_grafik[$jenis_grafik[$y]['id_data']] = $jenis_grafik[$y]['nama_data'];
		}

		extract($data);
		$flag = array();
		$result = array();

		$res_dapen = explode(',', $dapen);
		$res_jenis = explode(',', $jenis);

		for ($i=0; $i < sizeof($res_dapen) ; $i++) {	
			for ($j=0; $j < sizeof($res_jenis) ; $j++) { 

				$raw['type'] 						= 'bar';
				$raw['label'] 					= $temp_jenis_grafik[$res_jenis[$j]];
				$raw['backgroundColor'] = 'rgb('.rand(124,255).', '.rand(0,255).', '.rand(124,255).')';
				//$raw['backgroundColor'] = 'rgb('.rand(0,255).', '.rand(0,255).', '.rand(0,255).')';

				//$query = 'select a.id_bulan, a.nama_bulan, COALESCE(res.data, 0) data from ref_bulan a left join (select b.tahun, b.bulan, b.data from rep_data b where ';
				$query = 'select COALESCE(res.data, 0) data from ref_bulan a left join (select b.tahun, b.bulan, b.data from rep_data b where ';

				if($tahun != '#'){
					$flag[0] = 1;
					$query .= " b.tahun = '".$tahun."'";
				}else{
					$flag[0] = 0;
				}

				if($bulan != '#'){
					$flag[1] = 1;
					if($flag[1]){ $query .= " and "; }
					$query .= " b.bulan = '".$bulan."'";
				}else{
					$flag[1] = 0;
				}

				if($res_dapen[$i] != '#'){
					$flag[2] = 1;
					if($flag[0] || $flag[1]){ $query .= " and "; }
					$query .= " b.id_dapen = '".$res_dapen[$i]."'";
				}else{
					$flag[2] = 0;
				}

				if($res_jenis[$j] != '#'){
					$flag[3] = 1;
					if($flag[0] || $flag[1] || $flag[2]){ $query .= " and "; }
					$query .= " b.id_data = '".$res_jenis[$j]."'";
				}else{
					$flag[3] = 0;
				}

				$query .= ' GROUP BY b.bulan order by bulan asc) res on res.bulan = a.id_bulan';
				$query=$this->db->query($query);

				// $result[$res_dapen[$i]][$res_jenis[$j]] = $query->result_array();

				$temp = $query->result_array();
				$temp_res = array();
				for ($x=0; $x < sizeof($temp) ; $x++) { 
					$temp_res[] = $temp[$x]['data'];
				}

				//var_dump($temp_res); die();
				$raw['data'] = $temp_res;
				$result[] = $raw;
			}
		}

		//var_dump($result);
		//echo json_encode($result); 
		//die();

		return $result;

	}

	private function random_rgb(){
		foreach(array('r', 'g', 'b') as $color){
    	$rgbColor[$color] = mt_rand(0, 255);
		}
		return $rgbColor;
	}

	public function get_download_grafik($data){
		$jenis_grafik = $this->get_jenis_grafik($data);
		$dapen_grafik = $this->get_data_dapen($data);
		$temp_jenis_grafik = array();
		for ($y=0; $y < sizeof($jenis_grafik) ; $y++) { 
			$temp_jenis_grafik[$jenis_grafik[$y]['id_data']] = $jenis_grafik[$y]['nama_data'];
		}

		extract($data);
		$flag = array();
		$result = array();

		$res_dapen = explode(',', $dapen);
		$res_jenis = explode(',', $jenis);


		for ($i=0; $i < sizeof($res_dapen) ; $i++) {	
			for ($j=0; $j < sizeof($res_jenis) ; $j++) { 

				//$raw['type'] 						= 'bar';
				$raw['jumlah_dapen'] 		= sizeof($res_dapen);
				$raw['jumlah_jenis'] 		= sizeof($res_jenis);
				$raw['label'] 					= $temp_jenis_grafik[$res_jenis[$j]];
				$raw['dapen'] 					= $dapen_grafik[$i]['nama_dapen'];
				//$raw['backgroundColor'] = 'rgb('.rand(124,255).', '.rand(0,255).', '.rand(124,255).')';
				//$raw['backgroundColor'] = 'rgb('.rand(0,255).', '.rand(0,255).', '.rand(0,255).')';

				//$query = 'select a.id_bulan, a.nama_bulan, COALESCE(res.data, 0) data from ref_bulan a left join (select b.tahun, b.bulan, b.data from rep_data b where ';
				$query = 'select COALESCE(res.data, 0) data from ref_bulan a left join (select b.tahun, b.bulan, b.data from rep_data b where ';

				if($tahun != '#'){
					$flag[0] = 1;
					$query .= " b.tahun = '".$tahun."'";
				}else{
					$flag[0] = 0;
				}

				if($bulan != '#'){
					$flag[1] = 1;
					if($flag[1]){ $query .= " and "; }
					$query .= " b.bulan = '".$bulan."'";
				}else{
					$flag[1] = 0;
				}

				if($res_dapen[$i] != '#'){
					$flag[2] = 1;
					if($flag[0] || $flag[1]){ $query .= " and "; }
					$query .= " b.id_dapen = '".$res_dapen[$i]."'";
				}else{
					$flag[2] = 0;
				}

				if($res_jenis[$j] != '#'){
					$flag[3] = 1;
					if($flag[0] || $flag[1] || $flag[2]){ $query .= " and "; }
					$query .= " b.id_data = '".$res_jenis[$j]."'";
				}else{
					$flag[3] = 0;
				}

				$query .= ' GROUP BY b.bulan order by bulan asc) res on res.bulan = a.id_bulan';
				$query=$this->db->query($query);

				// $result[$res_dapen[$i]][$res_jenis[$j]] = $query->result_array();

				$temp = $query->result_array();
				$temp_res = array();
				for ($x=0; $x < sizeof($temp) ; $x++) { 
					$temp_res[] = $temp[$x]['data'];
				}

				//var_dump($temp_res); die();
				$raw['data'] = $temp_res;
				$result[] = $raw;
			}
		}

		//var_dump($result);
		//echo json_encode($result); 
		//die();

		return $result;

	}

	/* ---- Tabel Ref Jenis Data  ----------------------------------------------------------------------------------------- */
	public function get_fk_id_data(){
		$this->db->select("ref_jenis_data.id_data, ref_jenis_data.nama_data, ref_jenis_data.jenis, ref_satuan.simbol", false);
		$this->db->from('ref_jenis_data');
		$this->db->join('ref_satuan', "ref_jenis_data.id_satuan = ref_satuan.id_satuan");
		$this->db->where('flag_aktif', 1);
		$this->db->order_by('ref_jenis_data.id_satuan', 'asc');

		$query = $this->db->get();
		return $query->result_array();
	}

	/* ---- Tabel Ref Dapen  ----------------------------------------------------------------------------------------- */
	public function get_fk_id_dapen(){
		$this->db->select('*');
		$this->db->from('ref_dapen');
		$this->db->where('jenis', 1);

		$query = $this->db->get();
		return $query->result_array();
	}

}
