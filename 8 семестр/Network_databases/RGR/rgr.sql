DROP TABLE rgr_conferences;
DROP TABLE rgr_participants;

drop sequence rgr_seq_c;
drop sequence rgr_seq_p;

create sequence rgr_seq_c start with 1 increment by 1;
create sequence rgr_seq_p start with 1 increment by 1;

CREATE TABLE rgr_participants(
    p_id INTEGER NOT NULL,
    p_surname VARCHAR2(20) NOT NULL,
    p_name VARCHAR2(20) NOT NULL,
    p_patronymic VARCHAR2(30),

    CONSTRAINT rgr_p_id_pk PRIMARY KEY(p_id)
);

CREATE TABLE rgr_conferences (
    c_id INTEGER NOT NULL, 
    c_name VARCHAR2(50) NOT NULL, 
    c_speaker INTEGER NOT NULL,
    c_country VARCHAR2(35) NOT NULL, 
    c_city  VARCHAR2(25) NOT NULL,
    c_date DATE NOT NULL,

    CONSTRAINT rgr_c_id_pk PRIMARY KEY(c_id),
    CONSTRAINT rgr_c_speaker_fk FOREIGN KEY(c_speaker) REFERENCES rgr_participants(p_id) ON DELETE CASCADE
);


CREATE OR REPLACE PACKAGE dataPack AS
    PROCEDURE filling;
    PROCEDURE cleaning;
END;
/

CREATE OR REPLACE PACKAGE BODY dataPack AS
    PROCEDURE filling IS
    BEGIN
        dataPack.cleaning;
        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Худякова', 'Дарья', 'Ярославовна');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'FutureTech Conference', rgr_seq_p.CURRVAL, 'США', 'Сан-Франциско', to_date('15.06.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'Energy Summit', rgr_seq_p.CURRVAL, 'Канада', 'Ванкувер', to_date('05.11.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'International Finance Forum', rgr_seq_p.CURRVAL, 'Германия', 'Берлин', to_date('20.09.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Анисимова', 'Милана', 'Данииловна');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'Global Healthcare Conference', rgr_seq_p.CURRVAL, 'Великобритания', 'Лондон', to_date('25.04.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'GreenTech Expo', rgr_seq_p.CURRVAL, 'Япония', 'Токио', to_date('10.08.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Евдокимов', 'Арсений', 'Эмирович');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Cybersecurity Forum', rgr_seq_p.CURRVAL, 'Россия', 'Москва', to_date('16.09.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Авдеева', 'Александра', 'Васильевна');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'Womens Leadership Symposium', rgr_seq_p.CURRVAL, 'Австралия', 'Сидней', to_date('30.03.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Куликова', 'Сара', 'Артемьевна');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'Data Science Conference', rgr_seq_p.CURRVAL, 'Франция', 'Париж', to_date('12.10.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Смирнов', 'Тимофей', 'Даниэльевич');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'International Marketing Forum', rgr_seq_p.CURRVAL, 'Сингапур', 'Сингапур', to_date('14.05.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, 'Human Resources Summit', rgr_seq_p.CURRVAL, 'Катар', 'Доха', to_date('08.07.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Маслов', 'Роман', 'Артёмович');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Diversity and Inclusion Conference', rgr_seq_p.CURRVAL, 'Южная Африка', 'Кейптаун', to_date('18.06.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Tourism and Hospitality Conference', rgr_seq_p.CURRVAL, 'Испания', 'Барселона', to_date('02.11.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Supply Chain Symposium', rgr_seq_p.CURRVAL, 'Китай', 'Шанхай', to_date('21.04.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Artificial Intelligence Summit', rgr_seq_p.CURRVAL, 'США', 'Нью-Йорк', to_date('09.09.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Дмитриев', 'Савелий', 'Арсентьевич');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Education Conference', rgr_seq_p.CURRVAL, 'Канада', 'Торонто', to_date('07.03.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Oil and Gas Forum', rgr_seq_p.CURRVAL, 'Саудовская Аравия', 'Рияд', to_date('29.05.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1International Trade Summit', rgr_seq_p.CURRVAL, 'Великобритания', 'Манчестер', to_date('11.12.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Иванов', 'Сергей', 'Матвеевич');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Creative Industries Conference', rgr_seq_p.CURRVAL, 'Италия', 'Милан', to_date('17.08.2022', 'dd.mm.yyyy'));
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '1Social Responsibility Forum', rgr_seq_p.CURRVAL, 'Австрия', 'Вена', to_date('26.01.2022', 'dd.mm.yyyy'));

        INSERT INTO rgr_participants VALUES(rgr_seq_p.NEXTVAL, 'Зуева', 'Майя', 'Романовна');
        INSERT INTO rgr_conferences VALUES(rgr_seq_c.NEXTVAL, '2Real Estate Symposium', rgr_seq_p.CURRVAL, 'США', 'Лас-Вегас', to_date('04.07.2022', 'dd.mm.yyyy'));
    EXCEPTION WHEN OTHERS THEN
        ROLLBACK;
        RAISE_APPLICATION_ERROR(-20001, 'Не удалось заполнить таблицы данными', TRUE);
    END filling;
    
    PROCEDURE cleaning IS
    BEGIN
        -- DELETE FROM rgr_conferences;
        -- DELETE FROM rgr_participants;
        EXECUTE IMMEDIATE 'TRUNCATE TABLE rgr_conferences';
        EXECUTE IMMEDIATE 'TRUNCATE TABLE rgr_participants';
        EXECUTE IMMEDIATE 'DROP SEQUENCE rgr_seq_c';
        EXECUTE IMMEDIATE 'DROP SEQUENCE rgr_seq_p';
        EXECUTE IMMEDIATE 'CREATE SEQUENCE rgr_seq_c';
        EXECUTE IMMEDIATE 'CREATE SEQUENCE rgr_seq_p';
    EXCEPTION WHEN OTHERS THEN
            ROLLBACK;
            RAISE_APPLICATION_ERROR(-20002, 'Не удалось очистить таблицы', TRUE);
    END cleaning;
END;
/

CREATE OR REPLACE PACKAGE workPack AS
    TYPE T_VALIDITY_RECORD IS RECORD (
        p_id INTEGER,
        p_surname VARCHAR2(20),
        p_name VARCHAR2(20),
        p_patronymic VARCHAR2(30)
    );
    TYPE T_VALIDITY_TABLE IS TABLE OF T_VALIDITY_RECORD;
    PROCEDURE filling_data;
    PROCEDURE clearing_data;
    PROCEDURE delete_participant(del_id IN INTEGER);
    PROCEDURE participants_with_min_conference;
END;
/

CREATE OR REPLACE PACKAGE BODY workPack AS

    PROCEDURE filling_data IS
    BEGIN
        dataPack.filling;
        COMMIT;
    EXCEPTION
        WHEN OTHERS THEN
            ROLLBACK;
            RAISE_APPLICATION_ERROR(-20005, 'Ошибка заполнения', TRUE);
    END filling_data;

    PROCEDURE clearing_data IS
    BEGIN
        dataPack.cleaning;
        COMMIT;
    EXCEPTION
        WHEN OTHERS THEN
            ROLLBACK;
            RAISE_APPLICATION_ERROR(-20005,'Ошибка очистки', TRUE);
    END clearing_data;

    PROCEDURE delete_participant(del_id IN INTEGER) IS
    BEGIN
        DELETE FROM rgr_participants WHERE rgr_participants.p_id = del_id;
        -- DELETE FROM rgr_conferences WHERE rgr_conferences.c_speaker = del_id;
        -- DELETE FROM rgr_participants WHERE rgr_participants.p_id = del_id;
        COMMIT;
    EXCEPTION
        WHEN NO_DATA_FOUND THEN
            RAISE_APPLICATION_ERROR(-20404, 'Данные об участнике с id #' || del_id || ' не найдены в таблице "rgr_participants"', TRUE);
        WHEN OTHERS THEN
            RAISE_APPLICATION_ERROR(-20005, 'Ошибка при удалении участника #' || del_id, TRUE);

    END delete_participant;

    PROCEDURE participants_with_min_conference IS
    RET_TABLE  T_VALIDITY_TABLE;
    MIN_COUNT INTEGER;
    BEGIN
        EXECUTE IMMEDIATE '
            SELECT MIN(cnt) AS min_counts
                FROM (
                    SELECT COUNT(conferences.c_speaker) AS cnt
                        FROM rgr_conferences conferences
                        GROUP BY conferences.c_speaker
                    )
        ' INTO MIN_COUNT;
        EXECUTE IMMEDIATE '
            SELECT * FROM rgr_participants participants 
                WHERE participants.p_id IN (
                    SELECT conferences.c_speaker
                    FROM rgr_conferences conferences GROUP BY conferences.c_speaker
                    HAVING COUNT(conferences.c_speaker) = ' || MIN_COUNT || ')
        ' BULK COLLECT INTO RET_TABLE;
        
        DBMS_OUTPUT.PUT_LINE('Научные работники, принимающие участие в минимальном количестве конференций('|| MIN_COUNT ||'):');
        FOR i IN 1 .. RET_TABLE.COUNT LOOP
            DBMS_OUTPUT.PUT_LINE( i || ': #'|| ret_table(i).p_id || ' ' || ret_table(i).p_surname || ' ' || ret_table(i).p_name || ' ' || ret_table(i).p_patronymic);
        END LOOP;
    END participants_with_min_conference;
END;
/

CREATE OR REPLACE TRIGGER del_trigger
BEFORE DELETE ON rgr_participants
DECLARE
    start_work_time TIMESTAMP;
    end_work_time TIMESTAMP;
    curr_time TIMESTAMP;
BEGIN
    curr_time := current_timestamp at time zone 'Asia/Novosibirsk';

    start_work_time := (trunc(curr_time) + 9/24);
    end_work_time := (trunc(curr_time) + 18/24);
    
    IF ((curr_time < start_work_time) OR (curr_time > end_work_time)) THEN
        RAISE_APPLICATION_ERROR(-20003, 'Удаление возможно только в рабочее время', TRUE);
    END IF;
    -- DBMS_OUTPUT.PUT_LINE(TO_CHAR(curr_time, 'HH24:MI:SS'));
    -- DBMS_OUTPUT.PUT_LINE(TO_CHAR(start_work_time, 'HH24:MI:SS'));
    -- DBMS_OUTPUT.PUT_LINE(TO_CHAR(end_work_time, 'HH24:MI:SS'));
END;
/

CREATE OR REPLACE VIEW view_table AS
    SELECT 
        rgr_conferences.c_id, rgr_conferences.c_name AS Название_конференции,
        rgr_conferences.c_date AS Дата,
        rgr_conferences.c_country AS Страна,
        rgr_conferences.c_city AS Город,
        rgr_participants.p_surname AS Фамилия_спикера,
        rgr_participants.p_name AS Имя_спикера,
        rgr_participants.p_patronymic AS Отчество_спикера
    FROM rgr_conferences, rgr_participants 
    WHERE rgr_conferences.c_speaker = rgr_participants.p_id  
    ORDER BY rgr_conferences.c_date ASC;

-- Права
GRANT SELECT ON view_table TO public;
GRANT EXECUTE ON workPack TO WKSP_KCHIPSON;
SELECT * FROM USER_TAB_PRIVS;

-- Заполение данными
BEGIN
    workPack.filling_data;
    workPack.clearing_data;
    workPack.clearing_data;
    workPack.filling_data;
    workPack.filling_data;
    
END;
/

BEGIN
    workPack.participants_with_min_conference;
END;
/

SELECT * FROM view_table;

-- Удаление
BEGIN
    workPack.delete_participant(1);
END;
/

-- BEGIN
--     workPack.participants_with_min_conference;
-- END;
-- /

SELECT * FROM view_table;

-- Удаление несуществующего участника
BEGIN
    workPack.delete_participant(1337);
END;
/

-- BEGIN
--     workPack.clearing_data;
--     workPack.participants_with_min_conference;
-- END;
-- /

