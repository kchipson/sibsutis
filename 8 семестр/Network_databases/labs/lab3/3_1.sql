DROP TABLE lab3_task1;

create table lab3_task1(
    num number(20) NOT NULL,
    city varchar2(20) NOT NULL
);

INSERT INTO lab3_task1
    VALUES (1, 'Moscow');
INSERT INTO lab3_task1
    VALUES (1, 'Boston');
INSERT INTO lab3_task1
    VALUES (2, 'Paris');
INSERT INTO lab3_task1
    VALUES (3, 'Novosibirsk');
INSERT INTO lab3_task1
    VALUES (3, 'London');

SELECT * FROM lab3_task1;

CREATE OR REPLACE PROCEDURE update_num (oldnum NUMBER, newnum NUMBER)
AS BEGIN
    UPDATE lab3_task1 SET num = newnum WHERE num = oldnum;
END;
/

BEGIN
    update_num(1, 3);
END;
/

SELECT * FROM lab3_task1;
