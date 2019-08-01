<?php

function parseBlock($file) {
	$fd = fopen($file, "rb");
	$block = fread($fd, 10);

	$identifier = substr($block, 0, 3); //Tag Identifier
	
	//ID3v2
	if ($identifier == "ID3") {
		
		// ID3v2.{majorVersion}.{minorVersion}
		$majorVersion = ord($block[3]); //Major tag version
		$minorVersion = ord($block[4]); //Minor tag version
		
		$flags = ord($block[5]); //Flags
		$size = (substr($block, 6, 4));
		
		$bits = "";
		for ($i = 0; $i < strlen($size); $i++) {
			$bin = sprintf("%07d", decbin(ord($size[$i]))); //Eliminate encoded top bits
			$bits = $bits . $bin;
		}
        $bitsize = bindec($bits) + 10; //Add header length (10 byte)
		
		fseek($fd, $bitsize);
		$frames = fread($fd, 4);
	}
	
}

parseBlock("preview.mp3", $block);
