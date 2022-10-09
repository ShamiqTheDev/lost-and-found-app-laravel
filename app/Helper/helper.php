<?php 

function call_curl($url,$method,$data="")
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	if ($method=='POST') {
		curl_setopt($ch, CURLOPT_POST, 1);
	}
	else{
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	}

	if (!empty($data)) {
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	}
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	if (Session::has("payspace_token")) {
		$token = Session::get('payspace_token');
	}
	else{
		$token = get_payspace_token();
	}

	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:  application/json','Authorization: Bearer '.$token));

	$return_data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);

	if ($httpcode == 401) {
		get_payspace_token();
		return call_curl($url,$method,$data="");
	}
	return ["return_data"=> $return_data, 'httpcode'=> $httpcode ];
}


function get_payspace_token()
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,"https://identity.payspace.com/connect/token");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
		'client_id=mynac&client_secret=4074d00a-6f83-4af2-94f7-001bd1e52ac8&scope=api.full_access'
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:  application/x-www-form-urlencoded'));

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = json_decode(curl_exec($ch));

	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	curl_close ($ch);
	$token = $server_output->access_token;
	Session::put('payspace_token',$token);

	return $token;
	
	
}
?>
