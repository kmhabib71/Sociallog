<?php
$dsn = 'mysql:host=localhost; dbname=socialbd';
$user = 'root';
$pass = '';

try {
	$pdo = new PDO($dsn,$user,$pass);
} catch (PDOExecption $e){
	echo 'Connection error!' . $e->getMessage();
}
?>