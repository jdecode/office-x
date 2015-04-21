<?php

/**
 * Custom methods
 */

	function encode_data($data){
		return base64_encode(convert_uuencode($data));
	}
	function decode_data($data){
		return convert_uudecode(base64_decode($data));
	}