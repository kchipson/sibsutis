DROP SEQUENCE seq;
DROP TABLE lab2_task4;

CREATE SEQUENCE seq 
    START WITH 5 
    MAXVALUE 9999;
create table lab2_task4(
    num number(4) NOT NULL PRIMARY KEY,
    name varchar2(10) NOT NULL
);

INSERT INTO lab2_task4
    VALUES (seq.NEXTVAL, 'qwerty' || seq.CURRVAL);
INSERT INTO lab2_task4
    VALUES (seq.NEXTVAL, 'qwerty' || seq.CURRVAL);
INSERT INTO lab2_task4
    VALUES (seq.NEXTVAL, 'qwerty' || seq.CURRVAL);

COMMIT;
