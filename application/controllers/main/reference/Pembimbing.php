			<?php
			defined('BASEPATH') OR exit('No direct script access allowed');

			class Pembimbing extends CI_Controller {

				public function __construct() {
					parent::__construct();
					if ($this->session->userdata('stpn_simva_session')==null) {redirect('');}
					$this->load->model('main/reference/model_pembimbing');
				}

				public function index()
				{
					$data['page_title'] = 'Pembimbing';
					$this->load->view('main/reference/view_pembimbing',$data);
				}
				
				public function get_pembimbing(){
					$list = $this->model_pembimbing->get_pembimbing();
					$data = array();
					$no = $_POST['start'];
					foreach ($list as $grid) {
						$row = array();
						/*Id Pembimbing*/		$row[] = $grid->id_pembimbing;
						/*Nama Pembimbing*/		$row[] = $grid->nama_pembimbing;
						/*Pass Pembimbing*/		$row[] = $grid->pass_pembimbing;
						/*User Pembimbing*/		$row[] = $grid->user_pembimbing;
						/*Button*/				$row[] = 	'<td>
																<button type="button" onclick="viewModal(\''.$grid->id_pembimbing.'\')" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> View</button>
																<button type="button" onclick="editModal(\''.$grid->id_pembimbing.'\')" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</button>
																<button type="button" onclick="deleteData(\''.$grid->id_pembimbing.'\')"  class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
															</td>';

						$data[] = $row;
					}
					$output = array(
						"draw" 				=> $_POST['draw'],
						"recordsTotal" 		=> $this->model_pembimbing->count_all(),
						"recordsFiltered" 	=> $this->model_pembimbing->count_filtered(),
						"data" 				=> $data,
					);

					echo json_encode($output);
				}

				public function get_pembimbing_single($id){
					$result = $this->model_pembimbing->get_pembimbing_single($id);
					echo json_encode($result);
				}

				public function add_pembimbing(){
					$this->model_pembimbing->add_pembimbing($_POST);
					echo 'ok';
				}

				public function update_pembimbing(){
					$this->model_pembimbing->edit_pembimbing($_POST);
					echo 'ok';
				}

				public function delete_pembimbing(){
					$this->model_pembimbing->delete_pembimbing($_POST);
					echo 'ok';
				}


			}
		