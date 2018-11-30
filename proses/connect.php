<?php

$host="localhost";
$user="postgres";
$password="toor";
$port="5432";
$dbname="bdl_2018";

 
$link= pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$password) or die("Koneksi gagal");


?>