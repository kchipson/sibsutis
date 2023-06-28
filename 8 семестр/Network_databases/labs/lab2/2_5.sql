DROP SEQUENCE seq;
DROP TABLE lab2_task5;

CREATE SEQUENCE seq
    START WITH 5000
    MAXVALUE 999999
    INCREMENT BY 2;


CREATE TABLE lab2_task5(
    id NUMBER(6) NOT NULL PRIMARY KEY,
    sname VARCHAR2(30) NOT NULL,
    min_amt NUMBER(10,3) NOT NULL
);
DECLARE
    CURSOR cur IS 
        SELECT sname, MIN(amt) AS min_ant FROM sal INNER JOIN ord ON ord.snum = sal.snum GROUP BY sname ORDER BY min_ant;
    
BEGIN
    -- OPEN cur;
    FOR rec IN cur LOOP
        IF cur%NOTFOUND
            THEN exit; 
        END IF;
        -- DBMS_OUTPUT.PUT_LINE(seq.NEXTVAL||rec.sname||rec.min_ant);
        INSERT INTO lab2_task5 VALUES(seq.NEXTVAL, rec.sname, rec.min_ant);
    END LOOP;
    COMMIT;
END;

/
SELECT * FROM lab2_task5;


