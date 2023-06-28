<!-- 
№ 2
1. Создайте массив $treug[] «треугольных» чисел (для n от 1 до 30) и массив квадратов $kvd[] (для n от 1 до 30).
2. Используя вложенные циклы for отобразите на экране таблицу Пифагора 30×30 (размер чисел в ячейках: size=1).
В этой таблице фон у ячеек с квадратами чисел должен быть синим, а у ячеек с «треугольными» числами — зеленым. У ячеек, в которых стоят числа, одновременно являющиеся и квадратами и «треугольными» (здесь это числа 1 и 36) фон должен быть красным. У остальных ячеек фон белый. Для проверки правильности закрашивания ячеек, под таблицей выведите «треугольные» числа в строку. В результате должно получиться как на рисунке.

-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №2</title>
</head>
<body>
	<?php
		$size = 30;
		$trClr = "green";
		$kvdClr = "blue";
		$trkvdClr = "red";


		function output($array){
			for($i=0;$i<count($array);$i++){
				print "$array[$i]  ";
			}
		}

		for($i=1;$i<=$size;$i++){
			$treug[]=$i*($i+1)/2;
			$kvd[]=$i*$i;
		}

		print "<table cellpadding=5 border=1>";
		for($i=1;$i<=$size;$i++){
			print "<tr>";
			for($j=1;$j<=$size;$j++){
				$istreug = in_array($i*$j,$treug);
				$iskvd = in_array($i*$j,$kvd);
				
				if($istreug && $iskvd){
					print "<td style=\"background-color:$trkvdClr;\"><font size=\"1\">". ($i*$j) . "</font></td>";
				}elseif($istreug){
					print "<td style=\"background-color:$trClr;\"><font size=\"1\">". ($i*$j) . "</font></td>";
				}elseif($iskvd){
					print "<td style=\"background-color:$kvdClr;\"><font size=\"1\">". ($i*$j) . "</font></td>";
				}else{
					print "<td><font size=\"1\">". ($i*$j) . "</font></td>";
				}
			}
			print "</tr>";
		}
		print "</table>";
		
		print "<p>1. \$treug[] = ";
		output($treug);
		print "</p>";

		print "<p>2. \$kvd[] = ";
		output($kvd);
		print "</p>";

	?>
</body>
</html>