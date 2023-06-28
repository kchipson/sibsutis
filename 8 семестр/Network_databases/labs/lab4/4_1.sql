DROP TABLE lab4_task1_sal;
CREATE TABLE lab4_task1_sal(
    SNUM number(4) NOT NULL PRIMARY KEY,
    SNAME varchar2(10) NOT NULL,
    CITY  varchar2(15) NOT NULL,
    COMM  number(7,2) NOT NULL
);

DROP TABLE lab4_task1_history;
CREATE TABLE lab4_task1_history (
    command_name varchar2(20) NOT NULL,
    table_name varchar2(20) NOT NULL,
    user_name varchar2(50) NOT NULL,
    data_insert  date
);

CREATE TRIGGER dummy_task1
AFTER INSERT ON lab4_task1_sal
BEGIN
    INSERT INTO lab4_task1_history(command_name, table_name, user_name, data_insert) 
    VALUES ('INSERT', 'lab4_task1_sal', user, sysdate);
END;
/


INSERT INTO lab4_task1_sal VALUES (1001, 'Peel', 'London', .12);
INSERT INTO lab4_task1_sal VALUES (1002, 'Serres', 'San Jose', .13);
INSERT INTO lab4_task1_sal VALUES (1004, 'Motica', 'London', .11);
INSERT INTO lab4_task1_sal VALUES (1007, 'Rifkin', 'Barcelona', .15);
INSERT INTO lab4_task1_sal VALUES (1003, 'Axelrod', 'New York', .10);
INSERT INTO lab4_task1_sal VALUES (1005, 'Qwerty', 'Karaganda', .01);
INSERT INTO lab4_task1_sal VALUES (1006, 'Ytrewq', 'Novosibirsk', .90);