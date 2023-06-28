<?php
	$correct__answers = array(3, 4, 2, 3, 2, 1, 2, 1, 3, 3);
	if (!empty($_POST['name'])) {
		$name = (string)($_POST['name']);
		$str = "$name";
	} else {
		$str = "Username";
	}
	if (!empty($_POST['answers'])) {
		$answers = $_POST['answers'];
		$count = 0;
		for ($i=0; $i < count($answers); $i++) { 
			if ($answers[$i] == $correct__answers[$i]) {
				$count++;
			}
		}
		print "Ваш результат $count / " . count($correct__answers) . "<br>";
		switch ($count) {
			case 9:
				print "$str, Вы великолепен!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1";
				break;

			case 8:
				print "$str, отлично";
				break;

			case 7:
				print "$str, очень хорошо";
				break;

			case 6:
				print "$str, хорошо";
				break;

			case 5:
				print "$str, удовлетворительно";
				break;

			case 4:
				print "$str, ну не оч";
				break;

			case 3:
				print "$str, плохо";
				break;

			case 3:
				print "$str, очень плохо";
				break;
			
			default:
				print "$str, ну это БАН!";
				break;
		}
	}
?>