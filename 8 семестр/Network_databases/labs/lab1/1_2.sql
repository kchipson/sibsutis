DROP TABLE n_sal;
CREATE TABLE n_sal (
    text VARCHAR2 (20), 
    cnt VARCHAR2 (20)
);
DECLARE 
    town VARCHAR2(20); 
    count_sal VARCHAR2(20);
BEGIN 
    town := 'London';
    -- town := 'Paris';
    -- town := 'San Jose';
    SELECT count(*) INTO count_sal 
        FROM sal WHERE city = town;
    DBMS_OUTPUT.PUT_LINE('Count of Sals is '||count_sal);
    IF count_sal > 0 THEN
        INSERT INTO n_sal
            VALUES ('In '||town, count_sal);
        COMMIT;
    ELSE
        INSERT INTO n_sal
            values ('No data', 0);
        COMMIT;
    END IF;
 END;
/
 SELECT * FROM n_sal;
