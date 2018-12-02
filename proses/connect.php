<?php

$host="localhost";
$user="postgres";
$password="toor";
$port="5432";
$dbname="bdl_2018";

 
$link= pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$password) or die("Koneksi gagal");


// $db_url = getenv("DATABASE_URL") ?: "postgres://fwlgvjjdrflhrg:06b843ff855a2ffe86cc98332b98a60a7a70f3a5299bbde96c6d794408bec168@ec2-54-243-46-32.compute-1.amazonaws.com:5432/d5ibb05sft09ae";

// $link=pg_connect($db_url);

?>