<?php
$mysqli = new mysqli('127.0.0.1','root','','webgis-php');
if ($mysqli->connect_errno) { fwrite(STDERR, 'ERR '.$mysqli->connect_error); exit(1); }
echo 'OK';
