<?php defined('BASEPATH') OR exit('No direct script access allowed');

class App_Core_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->check_error();
	}

	public function check_login()
	{
		if ($this->session->userdata('stpn_simva_session')==null)
		{
			redirect('');
		}else{
			redirect('main/dashboard');
		}
	}

	public function check_access()
	{
		//if (!$this->session->userdata('stpn_simva_session')['jenis'])
		//{
		//	http_response_code(403);
		//	die($this->error403());
		//}
	}

	public function error403(){
		$html = '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<title>Data DAPEN | Error 404</title>
					<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
					<link rel="stylesheet" href="'.base_url().'assets/components/bootstrap/dist/css/bootstrap.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/components/font-awesome/css/font-awesome.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/components/Ionicons/css/ionicons.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/dist/css/theme.css">
					<link rel="stylesheet" href="'.base_url().'assets/dist/css/error_bg.css">
					<link rel="stylesheet" href="'.base_url().'assets/plugins/iCheck/square/blue.css">

					<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
					<!-- WARNING: Respond.js doesn\'t work if you view the page via file// -->
					<!--[if lt IE 9]>
					<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
					<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
					<![endif]-->

					<!-- Google Font -->
					<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
					<link rel="icon" href="'.base_url().'assets/img/logo.ico"/>
				</head>
				
				<body class="hold-transition login-page" style="overflow-y:hidden">
					<div class="login-box">
						<div class="login-logo" onclick="location.href=\''.base_url().'\'">
							<img height="120px" src="'.base_url().'assets/img/403.png">
							<br>
							<br>
							<button type="button" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back to Dashboard</button>
						</div>
						<div class="login-box-body" style="background-color: white">
							<h2 class="text-yellow" style="margin-top: 0px">403 Forbidden Access</h2>
							Anda tidak mempunyai hak akses halaman ini.</div>
						<br><span>2019 &copy; <a href="https://www.stpn.ac.id/">Sekolah Tinggi Pertanahan Nasional</a></span>
					</div>
					<script src="'.base_url().'assets/components/jquery/dist/jquery.min.js"></script>
					<script src="'.base_url().'assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
				</body>
			</html>';

		return $html;
	}

	private function errorDB($error){
		$html = '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<title>Data DAPEN | Error 404</title>
					<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
					<link rel="stylesheet" href="'.base_url().'assets/components/bootstrap/dist/css/bootstrap.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/components/font-awesome/css/font-awesome.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/components/Ionicons/css/ionicons.min.css">
					<link rel="stylesheet" href="'.base_url().'assets/dist/css/theme.css">
					<link rel="stylesheet" href="'.base_url().'assets/plugins/iCheck/square/blue.css">

					<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
					<!-- WARNING: Respond.js doesn\'t work if you view the page via file// -->
					<!--[if lt IE 9]>
					<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
					<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
					<![endif]-->

					<!-- Google Font -->
					<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
					<link rel="icon" href="'.base_url().'assets/img/logo.ico"/>
				</head>
				
				<body class="hold-transition login-page" style="overflow-y:hidden">
					<div class="login-box">
						<div class="login-logo" onclick="location.href=\''.base_url().'\'">
							<img height="120px" src="'.base_url().'assets/img/500.png">
							<br>
							<br>
							<button type="button" class="btn btn-sm btn-default">Back to Dashboard</button>
						</div>
						<div class="login-box-body" style="background-color: white">
							<h2 class="text-yellow" style="margin-top: 0px">Koneksi Database Bermasalah</h2>
							Hubungi tim IT mengenai permasalahan ini.
							<div class="alert alert-danger no-padding" style="margin:12px 0px 0px 0px">
                '.$error['message'].'
              </div>
						</div>
						<br><span>2019 &copy; <a href="https://www.stpn.ac.id/">Sekolah Tinggi Pertanahan Nasional</a></span>
					</div>
					<script src="'.base_url().'assets/components/jquery/dist/jquery.min.js"></script>
					<script src="'.base_url().'assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
				</body>
			</html>';

		return $html;
	}

	public function check_error(){
		$error = $this->db->error();
		if(gettype($error['code'])=="integer"){
			http_response_code(500);
			die($this->errorDB($error));
		}
		else{
			return true;
		}
	}

}