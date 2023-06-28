<!-- 
№ 5
1. Создайте ассоциативный массив $cust[] с ключами cnum, cname, city, snum и rating и значениями: 2001, Hoffman, London, 1001 и 100. Выведите этот массив (вместе с именами ключей) на экран.
2. Отсортируйте этот массив по значениям. Выведите результат на экран.
3. Отсортируйте этот массив по ключам. Выведите результат на экран.
4. Выполните сортировку массива с помощью функции sort().
   Выведите результат на экран и объясните, что получилось.
-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание №5</title>
</head>
<body>
	<?php
		$size = 30;

		$cust = array(
			'cnum' => 2001,
			'cname' => "Hoffman",
			'city' => "London",
			'snum' => 1001,
			'raiting' => 100
		);



		print "1.\$cust = {";
		foreach($cust as $key => $value){
			print "<p>$key => $value</p>";
		}
		print "}</br>";


		asort($cust);

		print "2.\$cust = {";
		foreach($cust as $key => $value){
			print "<p>$key => $value</p>";
		}
		print "}</br>";

		ksort($cust);

		print "3.\$cust = {";
		foreach($cust as $key => $value){
			print "<p>$key => $value</p>";
		}
		print "}</br>";

		sort($cust);

		print "4.\$cust = {";
		foreach($cust as $key => $value){
			print "<p>$key => $value</p>";
		}
		print "}";

	?>
</body>
</html>