<html>
<head>
    <title>
        Расчетно-графическое задание
    </title>
    <?php
        $HOST = "localhost";  
        $USER = "root";
        $PASS = "";
        $DB   = "rgr";
    
        $conn = mysqli_connect($HOST, $USER, $PASS);
        
        if(!$conn) 
            die("<p>Нет соединения с MySQL</p>");

        //     if(!mysqli_query($conn, "DROP DATABASE IF EXISTS $DB"))
        //     die("<p>Не удалось удалить базу данных $DB</p>" . mysqli_error($conn));
    
        // if(!mysqli_query($conn, "CREATE DATABASE $DB"))
        //     die("<p>Не удалось создать базу данных $DB</p>" . mysqli_error($conn));

    
        if(!mysqli_select_db($conn, "$DB"))
            die("<p>Не удалось выбрать базу данных</p>" . mysqli_error($conn));
        
        $TABLE  = "T4";
    
        if(!mysqli_query($conn, "DROP TABLE IF EXISTS $TABLE"))
            die("<p>Не удалось удалить таблицу $TABLE</p>" . mysqli_error($conn));
        
        $sql = "CREATE TABLE $TABLE(
            n INT AUTO_INCREMENT NOT NULL,
            command VARCHAR(20) NOT NULL,
            commandType VARCHAR(20) NOT NULL,
            PRIMARY KEY(n)
        );";
        
        if(!mysqli_query($conn, $sql))
            die("<p>Не удалось создать таблицу $TABLE</p>" . mysqli_error($conn));

        $sql = "
        INSERT INTO $TABLE(command, commandType) VALUES 
            ('ALTER SESSION', 'Управления'),
            ('ALTER SYSTEM', 'Управления'),
            ('COMMIT', 'Управления'),
            ('ROLLBACK', 'Управления'),
            ('DELETE', 'DML'),
            ('INSERT', 'DML'),
            ('SELECT', 'DML'),
            ('UPDATE', 'DML'),
            ('ALTER ROLE', 'DDL'),
            ('ALTER VIEW', 'DDL'),
            ('CREATE ROLE', 'DDL'),
            ('CREATE TABLE', 'DDL'),
            ('DROP', 'DDL'),
            ('GRANT', 'DDL'),
            ('REVOKE', 'DDL'),
            ('TRUNCATE', 'DDL');  
        ";

        if(!mysqli_query($conn, $sql))
            die("<p>Не удалось заполнить таблицу $TABLE</p>" . mysqli_error($conn));

	?>
</head>
<body>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <p>Выберите имя столбца таблицы:</p>
    <p><input type="radio" name="column" value="n" checked>number<br>
    <input type="radio" name="column" value="command">command<br>
    <input type="radio" name="column" value="commandType">commandType</p>
    <p><input type="submit" value="Выполнить"></p>
</form>

<?php
    $column = $_POST["column"];

    if($column)
    {
        print "<p style='font-weight:bold'>Значения колонки '$column':</p>";
        $sql = "SELECT $column FROM $TABLE";
        $result = mysqli_query($conn, $sql);
        if(!$result)
			die("<p>Не удалось выбрать записи из таблицы $table</p>" . mysqli_error($conn));
        print "<ul type='square'>";

        while($row = mysqli_fetch_array($result)) {
            print "<li>" . $row[0] . "</li>";
        }
        print "</ul>";
        
    }
?>
</body>
</html>