<?php

	function vid_structure($table){
		global $mysql;

		$typeNames = array(
						3 =>"int",
						5 => "double",
						10 => "date",
						253=>"string"
						);

		$flagsNames = array(
						1 => "not_null",
						2 => "primary_key",
						4 => "unique_key",
						8 => "multiple_key",
						16 => "blob",
						32 => "unsigned",
						64 => "zerofill",
						128 => "binary",
						256 => "enum",
						512 => "auto_increment",
						1024 => "timestamp",
						2048 => "set",
						16384 => "part_key",
						32768 => "group num",
						65536 => "unique"
						);

		print "<h4>Структура таблицы $table</h4>";

		$querySelect = "SELECT * FROM $table LIMIT 1";
		$resultSelect = mysqli_query($mysql, $querySelect);

		if(!$resultSelect)
			die("<p>Не удалось выбрать записи из таблицы $table</p>" . mysqli_error($mysql));

		$numFields = mysqli_num_fields($resultSelect);


		for ($i=0; $i<$numFields; $i++) {
			$properties = mysqli_fetch_field_direct($resultSelect, $i);
			print "<i>" . $typeNames[$properties->type] . "</i> <i>" . $properties->max_length . "</i> <b>" . $properties->name . "</b>";
			$flag = $properties->flags;

			foreach($flagsNames as $bit => $name) {
				if($flag & $bit){
					print " <i>" . $name . "</i>";
				}
			}

			print "<br>";
		}
	}

	function vid_content($table){
		global $mysql;

		$rus_name = array(
						"cnum" => "Номер покупателя", 
						"cname" => "Имя покупателя",
						"city" => "Город",
						"rating" => "Рейтинг покупателя",
						"snum" => "Номер продавца",
						"sname" => "Имя продавца",
						"comm" => "Комиссионные",
						"onum" => "Номер заказа",
						"amt" => "Стоимость заказа",
						"odate" => "Дата заказа"
						);


		print "<h4>Содержимое таблицы $table</h4>";

		$querySelect = "SELECT * FROM $table";
		$resultSelect = mysqli_query($mysql, $querySelect);

		if(!$resultSelect)
			die("<p>Не удалось выбрать записи из таблицы $table</p>" . mysqli_error($mysql));

		$numFields = mysqli_num_fields($resultSelect);
		print "<table border=1>";
		print "<tr>";

		for ($i = 0; $i < $numFields; $i++) {
			$fieldName = mysqli_fetch_field_direct($resultSelect, $i)->name;
			print "<th>$rus_name[$fieldName]<br>$fieldName</th>";
		}

		print "</tr>";

		while ($currentRow = mysqli_fetch_row($resultSelect)) {
			print "<tr>";

			foreach ($currentRow as $fieldValue)
				print "<td>$fieldValue</td>";

			print "</tr>";
		}

		print "</table>";
		print "<br>";
	}

	if(isset($_GET['structure'])){
		$tables = $_GET['structure'];
		foreach($tables as $table){
			vid_structure($table,$mysql);
		}
	}
	else{
		print "<h4>Значение переменной \"\$structure\" не задано</h4>";
	}

	if(isset($_GET['content'])){
		$tables = $_GET['content'];
		foreach($tables as $table){
			vid_content($table,$mysql);
		}
	}
	else{
		print "<h4>Значение переменной \"\$content\" не задано</h4>";
	}

?>
<br/>
<a href="z10-1.htm"><center>Возврат к выбору таблицы</center></a>