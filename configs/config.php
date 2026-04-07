<?php
$env = parse_ini_file(__DIR__ . '/../.env');

define('_HOST', $env['HOST']);
define('_DB', $env['DB']);
define('_USER', $env['USER']);
define('_PASS', $env['PASS']);
define('_PORT', $env['PORT']);
define('_DRIVER', $env['DRIVER']);
?>
