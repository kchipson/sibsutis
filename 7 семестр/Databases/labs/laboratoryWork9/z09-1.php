<!-- 
№ 1
Создайте скрипт z09-1.php, в котором в СУБД MySQL в базе данных sample с помощью функций РНР создайте таблицу notebook_brNN (здесь NN - номер бригады) со следующими полями:

id - целое, непустое, автоинкремент, первичный ключ,
name - строка переменной длины, но не более 50 символов,
city - строка переменной длины, но не более 50 символов,
address - строка переменной длины, но не более 50 символов,
birthday - значение даты (DATE), т.е. год, месяц и число,
mail - строка переменной длины, но не более 20 символов. 

Обязательно предусмотрите в случае ошибки вывод предупреждения:"Нельзя создать таблицу notebook_brNN". 
Совет. Перед командами создания таблицы добавьте две РНР-команды, в первой из которых содержится SQL-запрос, уничтожающий таблицу, если она уже есть: 
"DROP TABLE IF EXISTS notebook_brNN" 
(для того, чтобы при повторном выполнении скрипта z09-1.php не появлялось сообщения об ошибке). 

-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №1</title>
</head>
<body>
	<?php

		$mysqli_user = "root";
		$mysqli_password = "";
		$conn = mysqli_connect("127.0.0.1", $mysqli_user, $mysqli_password);
		if(!$conn) 
			die("Нет соединения с MySQL");

		$resultSelectDB = mysqli_select_db($conn,"sample");

		if(!$resultSelectDB)
			die("<p>Не удалось выбрать базу данных</p>" . mysqli_error($conn));

		$queryDropTable = "DROP TABLE IF EXISTS notebook_br06";

		$resultDropTable = mysqli_query($conn, $queryDropTable);

		if(!$resultDropTable)
			die("<p>Нельзя уничтожить таблицу notebook_br06</p>" . mysqli_error($conn));

		$queryCreateTable = "CREATE TABLE notebook_br06 (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(50), city VARCHAR(50), address VARCHAR(50), birthday DATE, mail VARCHAR(50))";

		$resultCreateTable = mysqli_query($conn, $queryCreateTable);

		if(!$resultCreateTable)
			die("<p>Нельзя создать таблицу notebook_br06</p>" . mysqli_error($conn));

	?>
</body>
</html>