<!-- 
№ 4
Создайте 4 функции с именами Ru(), En(), Fr(), De(). Каждая функция выводит на экран приветствие на соответствующем языке:
Ru() — "Здравствуйте!", En() — "Hello!",
Fr() — "Bonjour!" и De() — "Guten Tag!".

Эти функции имеют аргумент $color, который определяет цвет выводимого текста. 
Используя функцию-переменную $lang(), отобразить на экране одно из приветствий, 
причем какое приветствие будет выведено и каким цветом — задать как параметры в строке вызова скрипта.
-->


<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание #4</title>
</head>
<body>
    <?php
        function ru($color='black')
            {print "<p style='color:$color;'>Здравствуйте!</p>";}
        function en($color='red')
            {print "<p style='color:$color;'>Hello!</p>";}
        function fr($color)
            {print "<p style='color:$color;'>Bonjour!</p>";}
        function de($color)
            {print "<p style='color:$color;'>Guten Tag!</p>";}

        $color = $_GET['color'];
        $lang= $_GET['lang'];
        if (is_null($color) and is_null($lang)){
            print "Error: Переменные color и lang не заданы";
        }
        elseif (is_null($color)){
            print "Error: Переменная color не задана";
        }
        elseif (is_null($lang)){
            print "Error: Переменная lang не задана";
        }
        else{
            switch ($lang) {
                case "ru":
                    $lang = ru;
                    $lang($color);
                    break;
                case "en":
                    $lang = en;
                    $lang($color);
                    break;
                case "fr":
                    $lang = fr;
                    $lang($color);
                    break;
                case "de":
                    $lang = de;
                    $lang($color);
                    break;
                default:
                    echo "Error: неизвестный язык";
            }
        }

    ?>
</body>
</html>
