<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Задание 1</title>
</head>

<body>
	<!-- <form action="<?=$_SERVER['PHP_SELF'] ?>" method="GET"> -->
	<form action="<?=$_SERVER['PHP_SELF'] ?>" method="POST">

		<p><b>Выберите горизонтальное положение:</b></br></p>
		<input type="radio" name="align" value="left" checked>Слева</br>

		<input type="radio" name="align" value="center">По центру</br>

		<input type="radio" name="align" value="right">Справа</br>

		<p><b>Выберите вертикальное расположение:</b></br></p>
		<input type="checkbox" name="valign" value="top">Сверху</br>

		<input type="checkbox" name="valign" value="middle">По центру</br>

		<input type="checkbox" name="valign" value="bottom">Снизу</br>
		
		</br>

		<button type="submit">Выполнить</button>
	</form>
	
	<?php
	$align = $_POST['align'];
	$valign = $_POST['valign'];
	// $align = $_GET['align'];
	// $valign = $_GET['valign'];
	if (is_null($align)) {
		$align = "left";
	}
	if (is_null($valign)) {
		$valign = "top";
	}
	print "<center>
				<table border=1>
					<td align=$align valign=$valign height=100 width=100>Text</td>
				</table>
			</center>";
	?>
</body>

</html>
