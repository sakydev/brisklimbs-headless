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
	$pre_built_messages = array(
		'no_results' => 'No results found'
	);

	$type = strstr($message, 'error:') ? 'error' : 'message';
	if ($type == 'error') {
		$message = str_replace('error:', '', $message);
	}

	// when data is missing, send out a message automatically
	if (isset($pre_built_messages[$message])) {
		if (empty($data)) {
			$message = $pre_built_messages[$message];
		} else {
			$message = null;
		}
	}

	return response()->json([
		$type => $message,
		'status' => $status,
		'data' => $data
	], $status);
}

function api_response_message($message, $status) {
	return api_response(false, $status, $message);
}

function api_response_error($message, $status) {
	return api_response(false, $status, 'error: ' . $message);
}