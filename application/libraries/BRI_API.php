<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BRI_API {

	/*
	 * Variable to hold an insatance of CodeIgniter so we can access CodeIgniter features
	 */
	protected $CI;
	
	/*
	 * Create an array of the urls to be used in api calls
	 * The urls contain conversion specifications that will be replaced by sprintf in the functions
	 * @var string
	 */
	protected $_api_urls = array(
		// This endpoint is used to generate token. This token is required for making an API call.
		// POST https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials
		'url_token'					=> 'https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials',
		
		/* ---- Account Information ---- */

		// This endpoint is used to get inquiry information.
		// GET https://sandbox.partner.api.bri.co.id/v1/inquiry/{{ACCOUNT_NUMBER}}
		'url_inquiry'				=> 'https://sandbox.partner.api.bri.co.id/v1/inquiry/%s',
		
		/* ---- Account Transaction History ---- */

		// This API will show your company account transaction history with maximum one month period each request.
		// GET https://sandbox.partner.api.bri.co.id/v1/statement/{{ACCOUNT_NUMBER}}/{{START_DATE}}/{{END_DATE}}
		'url_history'				=> 'https://sandbox.partner.api.bri.co.id/v1/statement/%s/%s/%s',

		/* ---- Fund Transfer ---- */

		// [ ACCOUNT VALIDATION ]
		// This endpoint is used to validate source and destination account that will be used in transfer. Usually, it is called before making fund tranfer request to ensure the account are correct.
		// GET https://sandbox.partner.api.bri.co.id/v2/transfer/internal/accounts?sourceaccount={{SOURCE_ACCOUNT}&beneficiaryaccount={{DESTINATION_ACCOUNT}}
		'url_acc_validation'		=> 'https://sandbox.partner.api.bri.co.id/v2/transfer/internal/accounts?sourceAccount=%s&beneficiaryAccount=%s',
		
		// [ ACCOUNT TRANSFER ]
		// This endpoint is used to make fund transfer between two accounts. There is maximum total transaction limit and daily limit that will be set by BRI.
		// POST https://sandbox.partner.api.bri.co.id/v2/transfer/internal
		'url_fund_transfer'			=> 'https://sandbox.partner.api.bri.co.id/v2/transfer/internal',

		// [ CHECK TRANSFER STATUS ]
		// This endpoint is used to check the status of transfer transaction that has been made.
		// GET https://sandbox.partner.api.bri.co.id/v2/transfer/internal?noreferral={{NO_REFERRAL}}
		'url_check_transfer_status'	=> 'https://sandbox.partner.api.bri.co.id/v2/transfer/internal?noreferral=%s',

		/* ---- Other Bank Fund Transfer ---- */

		// [ ACCOUNT VALIDATION ]
		// This endpoint is used to to validate destination account that will be used in transfer. Usually, it is called before making fund tranfer request to ensure the account are correct.
		// GET https://sandbox.partner.api.bri.co.id/sandbox/v2/transfer/external?bankcode={{BANK_CODE}}&beneficiaryaccount={{BENEFICIARY_ACCOUNT}}
		'url_acc_validation_ex'		=> 'https://sandbox.partner.api.bri.co.id/sandbox/v2/transfer/external?bankcode=%s&beneficiaryaccount=%s',

		// [ ACCOUNT TRANSFER ]
		// This endpoint is used to make fund transfer from BRI account to other bank account. There is maximum total transaction limit and daily limit that will be set by BRI. The source account cannot be virtual account.
		// POST https://sandbox.partner.api.bri.co.id/v2/transfer/external
		'url_fund_transfer_ex'		=> 'https://sandbox.partner.api.bri.co.id/v2/transfer/external',

		// [ LIST BANK CODE ]
		// This endpoint is used to show bank code list that is available.
		// GET https://sandbox.partner.api.bri.co.id/v2/transfer/external/accounts
		'url_list_bank_code'		=> 'https://sandbox.partner.api.bri.co.id/v2/transfer/external/accounts',

		/* ---- BRIVA ---- */

		// This endpoint is used to create new virtual account.
		// POST https://sandbox.partner.api.bri.co.id/v1/briva
		'url_briva_create'			=> 'https://sandbox.partner.api.bri.co.id/v1/briva',
		
		// This endpoint is used to get virtual account information that has been created.
		// GET https://sandbox.partner.api.bri.co.id/v1/briva/{{INSTITUTION_CODE}}/{{BRIVA_NO}}/{{CUSTOMER_CODE}}
		'url_briva_get'				=> 'https://sandbox.partner.api.bri.co.id/v1/briva/%s/%s/%s',

		// All BRIVA account have statusBayar or payment status. This endpoint is used to get the payment status from an existing BRIVA account.
		// GET https://sandbox.partner.api.bri.co.id/v1/briva/status/{{INSTITUTION_CODE}}/{{BRIVA_NO}}/{{CUSTOMER_CODE}}
		'url_briva_get_status'		=> 'https://sandbox.partner.api.bri.co.id/v1/briva/status/%s/%s/%s',

		// This endpoint is used to maintain payment status of an existing BRIVA account.
		// PUT https://sandbox.partner.api.bri.co.id/v1/briva/status
		'url_briva_update_status'	=> 'https://sandbox.partner.api.bri.co.id/v1/briva/status',
		
		// This endpoint is used to update the detail of existing BRIVA account.
		// PUT https://sandbox.partner.api.bri.co.id/v1/briva
		'url_briva_update'			=> 'https://sandbox.partner.api.bri.co.id/v1/briva',

		// This endpoint is used to delete existing BRIVA account.
		// DELETE https://sandbox.partner.api.bri.co.id/v1/briva
		'url_briva_delete'			=> 'https://sandbox.partner.api.bri.co.id/v1/briva',

		// This endpoint is used to get all BRIVA account transaction history registered in your BRIVA number.
		// GET https://partner.api.bri.co.id/sandbox/v1/briva/report/{{INSTITUTION_CODE}}/{{BRIVA_NO}}/{{START_DATE}}/{{END_DATE}}
		'url_get_report'			=> 'https://partner.api.bri.co.id/sandbox/v1/briva/report/%s/%s/%s/%s'

	);
	

	/*
	 * Construct function
	 * Sets the codeigniter instance variable and loads the lang file
	 */
	public function __construct() {
	
		// Set the CodeIgniter instance variable
		$this->CI =& get_instance();
		
		// Load the  API language file
		$this->CI->load->config('bri_api');
	
	}

	/*
	 * The api call function is used by all other functions
	 * It accepts a parameter of the url to use
	 * And an optional string of post parameters
	 * @param string api url
	 * @param array post parameters for curl call
	 * @return std_class data returned form curl call
	 */
	public function __apiCall($url, $header, $post_parameters, $verb) {

		// Initialize the cURL session
		$curl_session = curl_init();
			
		// Set the URL of api call
		curl_setopt($curl_session, CURLOPT_URL, $url);
				
		//set the content type to application/json
		curl_setopt($curl_session, CURLOPT_HTTPHEADER, $header);
		if($verb=="PUT") curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "PUT");
		// If there are post fields add them to the call
		if($post_parameters !== FALSE) {
			if($verb!="GET" && $verb!="DELETE") {curl_setopt ($curl_session, CURLOPT_POSTFIELDS, json_encode($post_parameters));}
			else if ($verb=="DELETE") {curl_setopt ($curl_session, CURLOPT_POSTFIELDS, $post_parameters);}
			else 			 {curl_setopt ($curl_session, CURLOPT_POSTFIELDS, http_build_query($post_parameters));}
		}

		// Return the curl results to a variable
		curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, 1);
		
		// There was issues with some servers not being able to retrieve the data through https
		// The config variable is set to TRUE by default. If you have this problem set the config variable to FALSE
		//curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, $this->CI->config->item('server_ssl_verify'));
		
		// Execute the cURL session
		$contents = curl_exec($curl_session);
			
		// Close cURL session
		curl_close ($curl_session);

		// Return the response
		return json_decode($contents);
	
	}

	private function convertQueryParamtoJSON($input) {
		$keywords = preg_split("/[\s,=,&]+/", $input);
		$arr=array();
		for($i=0;$i<sizeof($keywords);$i++)
		{
			$arr[$keywords[$i]] = $keywords[++$i];
		}
		$output = (object)$arr;
		return json_encode($output);
	}

	public function exec_header($fn_name,$url,$path,$verb,$token,$content_type,$post_params)
	{
		$secret = $this->CI->config->item('secret_key');
		
		date_default_timezone_set('UTC');
		//$verb = 'GET';

		$temp_token = $token;

		$token = 'Bearer '.$temp_token;
		$h_token = $temp_token;
		$timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
		if($verb!="GET" && $verb!="DELETE") $body=json_encode($post_params);
		else if ($verb == "DELETE") $body=$post_params;
		else $body = '';

		//echo 'path : '.$path.'<br>';
		//echo 'verb : '.$verb.'<br>';
		//echo 'h_token : '.$h_token.'<br>';
		//echo 'timestamp : '.$timestamp.'<br>';

		echo '<br>>> Token : '.$temp_token.'<br>';
		echo '>> Body : '.$body.'<br>';
		$payload = "path=$path&verb=$verb&token=$token"."&timestamp=$timestamp&body=$body";
		//if($verb!="DELETE") 
		//else {
		//	$temp_body = $body;
		//	$temp_body = $this->convertQueryParamtoJSON($temp_body);
		//	$payload = "path=$path&verb=$verb&token=$token"."&timestamp=$timestamp&body=$temp_body";
		//}
		echo '>> Payload : '.$payload.'<br>';

		$signPayload = hash_hmac('sha256', $payload, $secret, true);
		$base64sign = base64_encode($signPayload);
		//$url = sprintf($this->_api_urls[$fn_name], $ACCOUNT_NUMBER);
		$header = array(
			'Authorization: Bearer '.$h_token,
			'BRI-Signature: '.$base64sign,
			'BRI-Timestamp: '.$timestamp,
		);
		if($content_type!=null) array_push($header, $content_type);
		//echo ">> HEader: ";
		//var_dump($header);
		return $header;
	}


	public function exec_api($fn_name,$verb,$content_type,$url_params,$post_params)
	{
		$token=$this->url_token()->access_token;
		//$url=sprintf($this->_api_urls['url_inquiry'], $ACCOUNT_NUMBER);
		//echo $path;
		//die();
		$url=$this->$fn_name($url_params);
		$path = substr($url, 9+strpos($url, "bri.co.id"),strlen($url));
		$path = preg_replace('/\?.*/', '', $path);
		echo '>> Path : '.$path;
		echo '<br>>> URL : '.$url;
		$header=$this->exec_header($fn_name,$url,$path,$verb,$token,$content_type,$post_params);		
		return $this->__apiCall($url, $header, $post_params, $verb);
	}

	// START

	public function url_token() {
		$verb = 'GET';
		$url = $this->_api_urls['url_token'];
		$header = array('Content-Type: application/x-www-form-urlencoded');
		$post_parameters = array(
			'client_id'			=> $this->CI->config->item('id_key'),
			'client_secret'	=> $this->CI->config->item('secret_key'),
		);

		return $this->__apiCall($url, $header, $post_parameters, $verb);
	}

	public function url_inquiry($params) 
	{
		extract($params);
		$url = sprintf($this->_api_urls['url_inquiry'], $ACCOUNT_NUMBER);
		return $url;
	}

	public function url_history($params) 
	{
		extract($params);
		$url = sprintf($this->_api_urls['url_history'], $ACCOUNT_NUMBER, $START_DATE, $END_DATE);
		return $url;
	}
	
	/* ---- Fund Transfer ---- */

	public function url_acc_validation($params) {
		extract($params);
		$url = sprintf($this->_api_urls['url_acc_validation'], $sourceaccount, $destinationaccount);
		return $url;
	}
	
	public function url_fund_transfer($params) {
		extract($params);
		$url = $this->_api_urls['url_fund_transfer'];
		return $url;
	}
	
	public function url_check_transfer_status($params) {
		extract($params);
		$url = sprintf($this->_api_urls['url_check_transfer_status'], $noreferral);
		return $url;
	}

	/* ---- BRIVA Start ---- */

	public function url_briva_create($params) 
	{
		extract($params);
		$url = $this->_api_urls['url_briva_create'];
		return $url;
	}

	public function url_briva_get($params) 
	{
		extract($params);
		$url = sprintf($this->_api_urls['url_briva_get'], $INSTITUTION_CODE, $BRIVA_NO, $CUSTOMER_CODE);
		return $url;
	}

	public function url_briva_get_status($params) 
	{
		extract($params);
		$url = sprintf($this->_api_urls['url_briva_get_status'], $INSTITUTION_CODE, $BRIVA_NO, $CUSTOMER_CODE);
		return $url;
	}

	public function url_briva_update_status($params) 
	{
		extract($params);
		$url = $this->_api_urls['url_briva_update_status'];
		return $url;
	}

	public function url_briva_update($params) 
	{
		extract($params);
		$url = $this->_api_urls['url_briva_update'];
		return $url;
	}

	public function url_briva_delete($params) 
	{
		extract($params);
		$url = $this->_api_urls['url_briva_delete'];
		return $url;
	}

	public function url_get_report($params) 
	{
		extract($params);
		$url = sprintf($this->_api_urls['url_get_report'], $INSTITUTION_CODE, $BRIVA_NO, $START_DATE, $END_DATE);
		return $url;
	}


}