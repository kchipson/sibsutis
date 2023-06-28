<!-- 
№ 3
Используя вложенные циклы for отобразите на экране таблицу сложения чисел от 1 до 10.
При этом цвет цифр в верхней строке и левом столбце должен быть задан через $color вне циклов,
а в левой верхней ячейке должен стоять знак "+" красного цвета. 
Ширина рамки таблицы равна 1, отступ содержимого ячеек от границы равен 5.
-->


<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание #3</title>
</head>
<body>
    <?php
        $color = "rgb(0,100,255)";
        print "<table border=1 cellpadding=10 style='text-align: center;'>";
        for ($i = 1; $i < 11; $i++) {
            print "<tr>";
            for ($j = 1; $j < 11; $j++) {
                if ($i == 1 and $j == 1){
                    print "<td style='color: red'>+</td>";
                }
                elseif ($i == 1 or $j == 1){
                    print "<td style='color:$color'>";
                    if ($j == 1){
                        print "$i";
                    }
                    else{
                        print "$j";
                    }
                    print "</td>";
                    
                    }
                else
                    {print "<td>".($i+$j)."</td>";}
            }
            print "</tr>";
        }
        print"</table>";
    ?>
</body>
</html>
