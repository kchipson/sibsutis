<!-- 
№ 1

Используя переменные $color и $size сформировать php-скрипт z05-1.php, который выводит на экран строку текста заданным цветом и размером
-->


<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 1</title>
</head>
<body>
    <?php
        $color = "rgb(255,0,0)";
        $size = "32pt";
        $align = "center";
        print "<p style=\"color:$color;font-size:$size;text-align:$align\">Лабораторная работа №5 Задание 1</p>"
    ?>
</body>
</html>
