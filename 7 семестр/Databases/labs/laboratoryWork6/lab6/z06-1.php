<!-- 
№ 1
В переменной min лежит число от 0 до 59 
(значение переменной вводится в строке вызова скрипта z06-1.php?min=1).
Определите, в какую четверть часа попадает это число (в первую, вторую, третью или четвертую).
-->


<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание #1</title>
</head>
<body>
    <?php
    // var_dump($_GET);
    if (is_null($_GET['min'])){
        print "Error: Переменная min не задана";
    }
    elseif (! is_numeric($_GET['min'])){
        print "Error: Переменная min не является числом";
    }
    else{
        $min = (Integer)$_GET['min'];
        if ($min >= 0 and $min < 15) {print "Первая четверть";} 
        elseif ($min >= 15 and $min < 30) {print "Вторая четверть";}
        elseif ($min >= 30 and $min < 45) {print "Третья четверть";}
        elseif ($min >= 45 and $min < 60) {print "Четвертая четверть";} 
        else {print "Error: Некорректная переменная min, возможное значение min от 0 до 59";}
    }
    ?>
</body>
</html>
