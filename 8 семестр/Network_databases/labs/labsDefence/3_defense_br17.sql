DROP TABLE kontrol;
DROP TABLE matrix;
drop sequence kontrol_seq;

CREATE TABLE kontrol(
    d_id NUMBER(4) NOT NULL PRIMARY KEY,
    discipline_name VARCHAR2(50),
    day_of_week VARCHAR2(25),
    form_of_testing VARCHAR2(30)
);

CREATE SEQUENCE kontrol_seq
    START WITH 1
    INCREMENT BY 1;

INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Математика', 'Понедельник', 'РГЗ');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Математика', 'Вторник', 'РГЗ');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Физика', 'Вторник', 'Курсовая работа');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Информатика', 'Среда', 'Зачет');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Химия', 'Четверг', 'Экзамен');
INSERT INTO Kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (Kontrol_seq.NEXTVAL, 'Биология', 'Понедельник', 'РГЗ');
INSERT INTO Kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'История', 'Вторник', 'Курсовая работа');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Философия', 'Среда', 'Зачет');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Литература', 'Четверг', 'Экзамен');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Журналистика', 'Пятница', 'РГЗ');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'География', 'Понедельник', 'Зачет');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Экономика', 'Среда', 'Курсовая работа');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Политология', 'Четверг', 'РГЗ');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Психология', 'Пятница', 'Экзамен');
INSERT INTO kontrol(d_id, discipline_name, day_of_week, form_of_testing)
    VALUES (kontrol_seq.NEXTVAL, 'Социология', 'Понедельник', 'Курсовая работа');

COMMIT;

SELECT * FROM kontrol;

CREATE TABLE matrix (
    discipline_name VARCHAR2(50),
    monday VARCHAR2(30),
    tuesday VARCHAR2(30),
    wednesday VARCHAR2(30),
    thursday VARCHAR2(30),
    friday VARCHAR2(30)
);

SELECT * FROM matrix;

CREATE OR REPLACE PACKAGE matrixPackage AS
    PROCEDURE filling;
END;
/

CREATE OR REPLACE PACKAGE BODY matrixPackage AS
    PROCEDURE filling IS
        CURSOR cur IS
            SELECT discipline_name, day_of_week, form_of_testing FROM kontrol;

        l_discipline_name kontrol.discipline_name%TYPE;
        l_day_of_week kontrol.day_of_week%TYPE;
        l_form_of_testing kontrol.form_of_testing%TYPE;

        count_rows INTEGER;
    BEGIN
        FOR rec IN cur LOOP
            DBMS_OUTPUT.PUT_LINE('test');
            l_discipline_name := rec.discipline_name;
            l_day_of_week := rec.day_of_week;
            l_form_of_testing := rec.form_of_testing;
            -- Проверяем, существует ли запись для данной дисциплины
            SELECT COUNT(*) INTO count_rows
                FROM Matrix WHERE discipline_name = l_discipline_name;
  
            IF count_rows = 0 THEN
                INSERT INTO matrix(discipline_name, Monday, Tuesday, Wednesday, Thursday, Friday)
                VALUES (l_discipline_name, NULL, NULL, NULL, NULL, NULL);
            END IF;
    
        -- Обновляем значения в таблице
            
            IF l_day_of_week = 'Понедельник' THEN
                UPDATE matrix SET monday = l_form_of_testing WHERE discipline_name = l_discipline_name;
            ELSIF l_day_of_week = 'Вторник' THEN
                UPDATE matrix SET tuesday = l_form_of_testing WHERE discipline_name = l_discipline_name;
            ELSIF l_day_of_week = 'Среда' THEN
                UPDATE matrix SET wednesday = l_form_of_testing WHERE discipline_name = l_discipline_name;
            ELSIF l_day_of_week = 'Четверг' THEN
                UPDATE matrix SET thursday = l_form_of_testing WHERE discipline_name = l_discipline_name;
            ELSIF l_day_of_week = 'Пятница' THEN
                UPDATE matrix SET friday = l_form_of_testing WHERE discipline_name = l_discipline_name;
            END IF;
        END LOOP;
    END filling;
END;
/

BEGIN
    matrixPackage.filling;
END;
/
SELECT * FROM matrix;