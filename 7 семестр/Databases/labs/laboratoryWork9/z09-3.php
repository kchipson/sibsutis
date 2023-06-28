<!-- 
№ 3
Создайте скрипт z09-3.php для вывода всех записей таблицы notebook_brNN (NN - номер бригады). 
В форме для заполнения таблицы (z09-2.php) введите дату с нарушением формата (или вообще не число) и посмотрите, что будет занесено в таблицу. 

-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №3</title>
</head>
<body>
	<table cellpadding=0 border=1>
		<tr>
			<td>Имя</td>
			<td>Город</td>
			<td>Адрес</td>
			<td>Дата рождения</td>
			<td>E-Mail</td>
		</tr>
		<?php
			$mysqli_user = "root";
			$mysqli_password = "";
			$conn = mysqli_connect("127.0.0.1", $mysqli_user, $mysqli_password);
			if(!$conn) 
				die("Нет соединения с MySQL" . mysqli_error($conn));

			$resultSelectDB = mysqli_select_db($conn,"sample");

			if(!$resultSelectDB)
				die("<p>Не удалось выбрать базу данных</p>" . mysqli_error($conn));

			$querySelect = "SELECT name, city, address, birthday, mail FROM `notebook_br06`";
			
			$resultSelect = mysqli_query($conn, $querySelect);

			if(!$resultSelect)
				die("<p>Не удалось выбрать записи из таблицы notebook_br06</p>" . mysqli_error($conn));


			foreach ($resultSelect as $row) {
				print "<tr>";
				foreach ($row as $column){
					print "<td>$column</td>";
				}
				print "</tr>";
			}
		?>
	</table>
</body>
</html>