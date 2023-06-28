<!-- 
№ 2

В php-скрипте z05-2.php создайте переменную $var1 со значением "Alice", переменную var2 = "My friend is $var1", переменную var3 = 'My friend is $var1'. Объясните, чем отличаются результаты присваиваний в var2 и var3. Создайте переменную $var4, являющуюся ссылкой на переменную $var1. Отобразите на экране значения всех переменных до, а затем после присвоения переменной $var1 значения "Bob".

Затем создайте переменную $user со значением "Michael" и динамическую переменную $$user со значением "Jackson".
-->

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Задание 2</title>
</head>
<body>
    <center>
    <?php
        $var1 = "Alice";
        $var2 = "My friend is $var1";
        $var3 = 'My friend is $var1';
        $var4 = &$var1;

        print "<p>\$var1 = $var1</p>";
        print "<p>\$var2 = $var2</p>";
        print "<p>\$var3 = $var3</p>";
        print "<p>\$var4 = $var4</p>";

        $var1 = "Bob";

        print "<p>\$var1 = $var1</p>";
        print "<p>\$var2 = $var2</p>";
        print "<p>\$var3 = $var3</p>";
        print "<p>\$var4 = $var4</p>";

        $user = "Michael";
        $$user = "Jackson";

        print "<p>\$user = $user</p>";
        print "<p>\$\$user = "; print $$user; print "<p>";
    ?>
    </center>
</body>
</html>
