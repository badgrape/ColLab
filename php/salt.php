<?php

function getSalt($string, $max) {

	if (strlen($string) == $max) {
		return $string;
	}
	
	else {
		$string .= chr(rand(0, 127));
		return getSalt($string, $max);
	}

}

echo "<pre>" . getSalt('', 12) . "</pre>";

?>
