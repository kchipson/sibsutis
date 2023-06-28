<html> 
<head>
	<title> Листинг 4. Обработка данных формы из листинга 3 </title> 
</head> 
<body>
	<?php

	// 4
	print "<h1>4</h1>";
	$user = $_POST["user"];
	$hobby = $_POST["hobby"];
	print "<p>$user, оказывается, вы предпочитаете";
	print "<ul>\n";
	foreach ($hobby as $value){
	print "<li>$value\n";
	}
	print "</ul>\n";

	// 5
	print "<h1>5</h1>";
	foreach ($_POST as $key=>$value) {
		print "$key = $value<br>\n";
	}
	// 6
	print "<h1>6</h1>";
	foreach ($_POST as $key=>$value){
		if (gettype($value) == "array"){
		print "$key = <br>\n";
		foreach ($value as $v ){
		print "$v<br>";
		}
		}
		else{
		print "$key = $value<br>\n";
		}
	}

	// 7
	print "<h1>7</h1>";
	$PARAMS = (isset($_POST))? $_POST : $_GET;
	foreach ($PARAMS as $key=>$value){
		if (gettype($value) == "array"){
		print "$key = <br>\n";
		foreach ($value as $v)
		print "$v<br>";
		}
		else{
		print "$key = $value<br>\n";
		}	
	} 
	?>
</body> 
</html>