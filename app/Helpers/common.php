<?php

function pr($a) {
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}

function pex($a) {
	pr($a);
	exit('Pex');
}

function api_response($data = array(), $status = 200, $message = null) {
	$type = strstr($message, 'error:') ? 'error' : 'message';
	return response()->json([
		$type => $message,
		'status' => $status,
		'data' => $data
	], $status);
}

function api_response_message($message, $status) {
	return api_response(false, $status, $message);
}