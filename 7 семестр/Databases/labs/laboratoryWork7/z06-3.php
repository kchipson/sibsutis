<!-- 
№ 3
Отобразите на экране таблицу Пифагора 30×30 (border=1, отступ содержимого ячеек от границы равен 0, ширина ячейки 14 пикселов, высота ячейки 15 пикселов, размер символов в ячейке size=1, но вместо чисел поставьте неразрывный пробел: &nbsp;). Фон ячеек определяется в зависимости от того, чему равен остаток от деления числа в ячейке на 7 следующим образом: 
если остаток равен 0, то фон белый, если 1 — голубой (aqua), 
если 2 — синий, если 3 — желтый, если 4 — фиолетовый (purple), 
если 5 — красный и если 6 — лимонный (lime). Здесь используйте просто оператор if.

-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №3</title>
</head>
<body>
	<?php
		$size = 30;

		print "<table cellpadding=0 border=1>";
		for($i=1;$i<=$size;$i++){
			print "<tr>";
			for($j=1;$j<=$size;$j++){
				if($i*$j%7==0){
					print "<td style=\"background-color:white;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}elseif($i*$j%7==1){
					print "<td style=\"background-color:aqua;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}elseif($i*$j%7==2){
					print "<td style=\"background-color:blue;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}elseif($i*$j%7==3){
					print "<td style=\"background-color:yellow;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}elseif($i*$j%7==4){
					print "<td style=\"background-color:purple;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}elseif($i*$j%7==5){
					print "<td style=\"background-color:red;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}else{
					print "<td style=\"background-color:lime;\" width=\"14px\" height=\"15px\"><font size=\"1\">&nbsp;</font></td>";
				}
			}
			print "</tr>";
		}
		print "</table>";
		

	?>
</body>
</html>