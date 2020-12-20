<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_data extends CI_Model 
{
  public $id_peristiwa;
  public $table='peristiwa';

  //menampilkan data table penghargaan
  public function Getpenghargaan(){

  $getperis=$this->db->query("SELECT peristiwa.id_peristiwa,peristiwa.id_kategori,peristiwa.nama_peristiwa,peristiwa.point,peristiwa.counter_peristiwa, kategori.nama_kategori from peristiwa join kategori on kategori.id_kategori=peristiwa.id_kategori where kategori.flag=1");
  	return $getperis->result();
  }

  //menampilkan data table pelanggaran
  public function Getpelanggaran(){

  $getperis=$this->db->query("SELECT peristiwa.id_peristiwa,peristiwa.id_kategori,peristiwa.nama_peristiwa,peristiwa.point,peristiwa.counter_peristiwa, kategori.nama_kategori from peristiwa join kategori on kategori.id_kategori=peristiwa.id_kategori where kategori.flag=2");
  	return $getperis->result();
  }

  //mengambil id dari setiap nama peristiwa 
  public function getId($nama_peristiwa){
     return $this->db->get_where($this->table,["nama_peristiwa" => $nama_peristiwa])->row()->id_peristiwa;
  }

  //menampilkan data untuk rekap taruna
  public function getIndividu(){
  $getInd=$this->db->query("SELECT * from mahasiswa");
  	return $getInd->result();
  }

  //menampilkan rekap penghargaan
  public function get_harga(){
    $getHarga=$this->db->query("SELECT ml.smt_melakukan, kt.nama_kategori, pr.nama_peristiwa, COUNT(ml.id_melakukan) as terserah from kategori kt join peristiwa pr on kt.id_kategori=pr.id_kategori join melakukan ml on ml.id_peristiwa=pr.id_peristiwa where kt.flag = '1' group by ml.smt_melakukan, pr.id_peristiwa");
        return $getHarga->result();
  }

  //menghitung jumlah rekap penghargaan
  public function get_total_penghargaan(){
    $totalHarga=$this->db->query("SELECT COUNT(ml.id_melakukan) as lala from kategori kt join peristiwa pr on kt.id_kategori= pr.id_kategori join melakukan ml on ml.id_peristiwa=pr.id_peristiwa where kt.flag = '1'");
    return $totalHarga->result() ;
  }

  //menghitung jumlah rekap pelanggaran
  public function get_total_pelanggaran(){
    $totalLanggar=$this->db->query("SELECT COUNT(ml.id_melakukan) as lala from kategori kt join peristiwa pr on kt.id_kategori= pr.id_kategori join melakukan ml on ml.id_peristiwa=pr.id_peristiwa where kt.flag = '2'");
    return $totalLanggar->result() ;
  }

  //menampilkan rekap pelanggaran
  public function get_langgar(){
    $getLanggar=$this->db->query("SELECT ml.smt_melakukan, kt.nama_kategori, pr.nama_peristiwa, COUNT(ml.id_melakukan) as terserah from kategori kt join peristiwa pr on kt.id_kategori=pr.id_kategori join melakukan ml on ml.id_peristiwa=pr.id_peristiwa where kt.flag = '2' group by ml.smt_melakukan, pr.id_peristiwa");
    return $getLanggar->result();
  }

  //menampilkan data mahasiswa berdasarkan idnya masing-masing
  public function show_detail($id){
    $this->db->where('nim',$id);
    $query=$this->db->get('mahasiswa');
    return $query->result();
  }

    public function kat_detail($id){
    // $this->db->where('nim',$id);
    $query=$this->db->query("SELECT p.nama_peristiwa,p.point,m.nim from melakukan m join peristiwa p on m.id_peristiwa=p.id_peristiwa where m.nim='".$id."'");
    return $query->result_array();
    // var_dump($query->result_array());
  }

  //menyimpan entry penghargaan dan pelanggaran baru
  public function simpan_peristiwa($id_kategori,$nama_peristiwa,$poin,$counter_peristiwa){
    $hasil=$this->db->query("INSERT INTO peristiwa (id_kategori,nama_peristiwa,point,counter_peristiwa) VALUES ('$id_kategori','$nama_peristiwa','$poin','$counter_peristiwa')");
    return $hasil;
  }

  //menampilakn detail setiap taruna dalam melakukan penghargaan dan pelanggaran 
  // public function detil_taruna($id){
  // //echo $id;
  // $query=$this->db->query("SELECT m.*, p.*, k.flag, k.nama_kategori from melakukan m left join history_peristiwa p on m.id_peristiwa=p.id_peristiwa join kategori k on k.id_kategori=p.id_kategori where p.counter_peristiwa=m.counter_melakukan and m.nim='".$id."'");
  // $ret_val= $query->result_array();
  //   $array=array();
  //   foreach ($ret_val as $v) {
  //     if(!isset($array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']])) $array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']]=array();
  //     array_push($array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']],$v);
  //   }
  //   return $array;
  // }

    public function detil_taruna($id){
  //echo $id;
  $query=$this->db->query("SELECT m.*, p.*, k.flag, k.nama_kategori from melakukan m left join peristiwa p on m.id_peristiwa=p.id_peristiwa join kategori k on k.id_kategori=p.id_kategori where p.counter_peristiwa=m.counter_melakukan and m.nim='".$id."'");
  $ret_val= $query->result_array();
    $array=array();
    foreach ($ret_val as $v) {
      if(!isset($array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']])) $array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']]=array();
      array_push($array[$v['smt_melakukan']][$v['flag']][$v['nama_kategori']],$v);
    }
    return $array;
  }



  //menghapus data pelanggaran dan penghargaan
  public function delete($id_peristiwa){
    $hapuz=$this->db->query("DELETE from peristiwa where id_peristiwa='$id_peristiwa'");
    return;
  }

  //melakukan update data penghargaan dan pelanggaran
  public function update($id_peristiwa,$data){
    $this->db->where('id_peristiwa', $id_peristiwa);
    $this->db->update('peristiwa',$data);
  }

  //menambahkan history pengeditan data penghargaan dan pelanggaran pada tabel history_peristiwa
  public function insert_history($data){
     $this->db->insert('history_peristiwa',$data);
  }

  //mengambil counter dari tabel peristiwa untuk digunakan pada entry individu maupun entry massal
  public function get_counter($id_peristiwa){
    $counter=$this->db->query("SELECT counter_peristiwa from peristiwa where peristiwa.id_peristiwa=".$id_peristiwa);
    return $counter->row()->counter_peristiwa;
  }

  //menambahkan penghargaan individu (taruna)
  public function entry_individu_harga($id_peristiwa,$nim,$smt_melakukan,$counter_melakukan){
    $hazil=$this->db->query("INSERT INTO melakukan(id_peristiwa,nim,smt_melakukan,counter_melakukan) VALUES ('$id_peristiwa','$nim','$smt_melakukan','$counter_melakukan')");
    return $hazil;
  }

  public function entry_individu_harga_tar($id_peristiwa,$nim,$smt_melakukan){
    $hazil=$this->db->query("INSERT INTO melakukan(id_peristiwa,nim,smt_melakukan) VALUES ('$id_peristiwa','$nim','$smt_melakukan')");
    return $hazil;
  }

  //menambhakan pelanggaran individu (taruna)
  public function entry_individu_langgar($id_peristiwa,$nim,$smt_melakukan,$counter_melakukan){
    $hazil=$this->db->query("INSERT INTO melakukan(id_peristiwa,nim,smt_melakukan,counter_melakukan) VALUES ('$id_peristiwa','$nim','$smt_melakukan','$counter_melakukan')");
    return $hazil;
  }

  //mengambil id dan nama kategori dari tabel kategori untuk digunakan pada form entry dan edit penghargaan
  public function fetch_kategori_penghargaan(){
    $query = $this->db->query("SELECT id_kategori,nama_kategori FROM kategori where flag=1");
    return $query->result();
  }

  //mengambil id dan nama kategori dari tabel kategori untuk digunakan pada form entry dan edit pelanggaran
  public function fetch_kategori_pelanggaran(){
    $query = $this->db->query("SELECT id_kategori,nama_kategori FROM kategori where flag=2");
    return $query->result();
  }

  //mengambil peristiwa yang sesuai dengan kategori yang dipilih pada form entry dan edit
  public function fetch_peristiwa($id_kategori){
    $this->db->where('id_kategori',$id_kategori);
    $this->db->order_by('nama_peristiwa','ASC');
    $query = $this->db->get('peristiwa');
    $output = '<option selected disabled hidden value="">Pilih peristiwa</option>';
    foreach ($query->result() as $row) {
      $output .= '<option value="' .$row->id_peristiwa.'">'.$row->nama_peristiwa.'</option>';     
    }
    return $output;
  }

  //mengambil poin peristiwa yang sesuai dengan nama peristiwa yang dipilih pada form edit
  public function fetch_poin($id_peristiwa){
    $query = $this->db->query("SELECT point FROM peristiwa where id_peristiwa = ".$id_peristiwa);   
    return $query->row()->point;
  }

	//mengambil hasil filter pencarian data kelas, prodi, maupun angkatan pada entry massal
  public function cari_kl_pr_ang($kelas,$tahun,$prodi){
    $clause_array=array();
    if($kelas!=''){
      array_push($clause_array, "kelas='".$kelas."'");
    }
    if($tahun!=''){
      array_push($clause_array, "tahun=".$tahun."");
    }
    if($prodi!=''){
      array_push($clause_array, "prodi='".$prodi."'");
    }
    $clause_string=implode(' and ', $clause_array);
    if(sizeof($clause_array)>0) 
      $clause_string="where ".$clause_string;
    $query_string="SELECT * FROM mahasiswa ".$clause_string;
    //echo $query_string;
    $query = $this->db->query($query_string);   
    return $query->result();
  }
}
