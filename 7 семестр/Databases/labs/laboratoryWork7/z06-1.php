<!-- 
№ 1
1.	Создайте массив $treug[] «треугольных» чисел, т.е. чисел вида n(n+1)/2 (где n=1,2,… 10) и выведите значения этого массива на экран в строку (через 2 пробела).
2.	Создайте массив $kvd[] квадратов натуральных чисел от 1 до 10, выведите значения этого массива на экран в строку.
3.	Объедините эти 2 массива в массив $rez[], выведите результат на экран.
4.	Отсортируйте массив $rez[], выведите результат на экран.
5.	Удалите в массиве $rez[] первый элемент, выведите результат на экран.
6.	С помощью функции array_unique() удалите из массива $rez[] повторяющиеся элементы, результат занесите в массив $rez1[] и выведите его на экран.
-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №1</title>
</head>
<body>
	<?php

		function output($array){
			for($i=0;$i<count($array);$i++){
				print "$array[$i]  ";
			}
		}

		for($i=1;$i<=10;$i++){
			$treug[]=$i*($i+1)/2;
			$kvd[]=$i*$i;
		}

		print "<p>1. \$treug[] = ";
		output($treug);
		print "</p>";

		print "<p>2. \$kvd[] = ";
		output($kvd);
		print "</p>";

		$rez = array_merge($treug,$kvd);

		print "<p>3. \$rez[] = ";
		output($rez);
		print "</p>";

		sort($rez);

		print "<p>4. \$rez[] = ";
		output($rez);
		print "</p>";

		array_shift($rez);

		print "<p>5. \$rez[] = ";
		output($rez);
		print "</p>";

		$rez1 = array_unique($rez);
		
		print "<p>6. \$rez1[] = ";
		output($rez1);
		print "</p>";

	?>
</body>
</html>