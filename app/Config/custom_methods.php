<?php

/**
 * App specific custom methods go here
 */

function encode_data($data) {
	return base64_encode(convert_uuencode($data));
}

function decode_data($data) {
	return convert_uudecode(base64_decode($data));
}

function isDebugModeOn() {
	if (Configure::read('debug') == '2' || Configure::read('debug') == '1') {
		return true;
	}
	return false;
}

function prx($x, $message = '') {
	pr($x);
	die($message);
}

function dpr($x) {
	if (isDebugModeOn()) {
		pr($x);
	}
}


function vd($x, $message = '') {
	var_dump($x);
}

function vdx($x, $message = '') {
	vd($x);
	die($message);
}

function dvd($x) {
	if (isDebugModeOn()) {
		var_dump($x);
	}
}

function decho($x) {
	if(isDebugModeOn()) {
		echo $x;
	}
}


function ifset($var) {
	if(isset($var)) {
		return $var;
	} else {
		return '';
	}
}