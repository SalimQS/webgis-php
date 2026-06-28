<?php
$mysqli = new mysqli('127.0.0.1','root','','webgis-php');
if ($mysqli->connect_errno) { fwrite(STDERR, 'ERR '.$mysqli->connect_error); exit(1); }
$tables = $mysqli->query("SHOW TABLES");
while ($row = $tables->fetch_array()) { echo $row[0].PHP_EOL; }
