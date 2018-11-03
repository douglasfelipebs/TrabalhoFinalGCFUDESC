<?php
$host = 'localhost';
$port = '5432';
$dbname = '0001_JRInformatica';
$user = 'postgres';
$password = 'root';

$con_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$conection = pg_connect($con_string);