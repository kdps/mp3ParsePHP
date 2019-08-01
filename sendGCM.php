function sendGCM($title, $body, $token) {
	$apiKey = "";

	$url = 'https://fcm.googleapis.com/fcm/send';

	$fields = array(
		"notification"=> array(
			"title" => $title,
			"body" => $body
		),
		"registration_ids"=> array($token),
		"data"=> array(
			"data" => "something",
		)
	);

	$fields = json_encode ($fields);
	$headers = array (
		'Authorization: key=' . $apiKey,
		'Content-Type: application/json'
	);

	echo print_r($fields);

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

	$result = curl_exec ( $ch );
	if (curl_error($ch)) { 
			exit('CURL Error('.curl_errno( $ch ).') '.
			curl_error($ch)); 
		}
		
	curl_close ( $ch );
	
	echo print_r($result);
}
