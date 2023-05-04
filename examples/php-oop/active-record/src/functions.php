<?php

function redirect($location)
{
	header('Location: ' . $location);
	exit();
}

// Log to php built-in server console
date_default_timezone_set('Asia/Ho_Chi_Minh');
function server_log(string $content)
{
	if (PHP_SAPI === 'cli-server') {
		defined('STDOUT') || define('STDOUT', fopen('php://stdout', 'w'));
		fwrite(STDOUT, '[' . date('D M  j H:i:s Y') . ']' . " $content\n");
	}
}
