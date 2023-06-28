<?php
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'sample');

	$mysql = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

	if(!$mysql) 
		die("<p>Нет соединения с MySQL</p>" . mysqli_error($mysql));

	$resultSelectDB = mysqli_select_db($mysql,DB_DATABASE);

	if(!$resultSelectDB)
		die("<p>Не удалось выбрать базу данных</p>" . mysqli_error($mysql));

?>