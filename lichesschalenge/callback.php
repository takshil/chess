<?php
session_start();

function sendChallenge($token) {
	$api_url = "https://lichess.org/api/challenge/".$_SESSION['adversaire'];
	$headers = array("Authorization: Bearer {$token}");
	//$content = "{clock :{limit: " . $_SESSION['limit'] .",increment: " . $_SESSION['increment'] ."}, color: '" . $_SESSION['color'] ."'}";

	
	$postdata = http_build_query(
		array(
			'clock.limit' => $_SESSION['limit'],
			'clock.increment' => $_SESSION['increment'],
			'color' => 'white',
			'rated' => 'true'
		)
	);
	$options = array(
		'http' => array(
			'header'  => "Authorization: Bearer " .$token ,
			'method'  => 'POST',
			'content' => $postdata
		)
	);
	
	$context  = stream_context_create($options);
	$result = file_get_contents($api_url, false, $context);
	if ($result === FALSE) { /* Handle error */ }

	return json_decode($result)->challenge->id;


}

function getAccessToken($authorization_code) {
	include_once('config.php');
	$token_url = 'https://oauth.lichess.org/oauth';
	$authorization = base64_encode("$client_id:$client_secret");
	$header = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");
	$content = "grant_type=authorization_code&code=$authorization_code&redirect_uri=$redirect_uri&client_id=$client_id&client_secret=$client_secret";

	//$response = post_http($token_url, $content, $headers);
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => $token_url,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $content
	));
	$response = curl_exec($curl);
	curl_close($curl);
	return json_decode($response)->access_token;
}



$access_token = getAccessToken($_GET["code"]);

$challenge_id = sendChallenge($access_token);
$challengeUrl = "https://lichess.org/" . $challenge_id;


header('Location: '.$challengeUrl);
exit;

 die();