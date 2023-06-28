CREATE OR REPLACE PROCEDURE procedure1 (in_city IN VARCHAR2)
AS 
    CURSOR cur IS 
        SELECT * FROM cust WHERE cust.city = in_city;
    
BEGIN
    DBMS_OUTPUT.PUT_LINE(in_city || ':');
    FOR rec IN cur LOOP
        IF cur%NOTFOUND THEN 
            exit; 
        END IF;
        DBMS_OUTPUT.PUT_LINE(rec.cnum || ' ' || rec.cname);
    END LOOP;
END;
/

BEGIN
    procedure1('Rome');
    procedure1('London');
    procedure1('Novosibirsk');
END;
/

CREATE OR REPLACE PROCEDURE procedure2_cur
AS 
    average NUMBER(7,2);
    cnt INTEGER;
    CURSOR cur IS 
        SELECT * FROM sal;
    
BEGIN
    cnt := 0;
    SELECT AVG(comm) INTO average FROM sal;
    DBMS_OUTPUT.PUT_LINE('< ' || average || ': ');
    FOR rec IN cur LOOP
        IF rec.comm < average THEN
            DBMS_OUTPUT.PUT_LINE(rec.snum || ' ' || rec.sname || ' ' || rec.comm);
            cnt := cnt + 1;
        END IF;
        
        IF cur%NOTFOUND OR cnt > 4 THEN 
            exit; 
        END IF;

    END LOOP;
END;
/

CREATE OR REPLACE PROCEDURE procedure2
AS 
    snum number(4);
    sname varchar2(10);
    comm  number(7,2);
    average NUMBER(7,2);
    cnt INTEGER;
    CURSOR cur IS 
        SELECT snum, sname, comm FROM sal;
    
BEGIN
    cnt := 0;
    SELECT AVG(comm) INTO average FROM sal;

    OPEN cur;
    DBMS_OUTPUT.PUT_LINE('< ' || average || ': ');
    LOOP
        FETCH cur INTO snum, sname, comm;
        
        IF cur%NOTFOUND THEN 
            exit; 
        END IF;
        IF comm < average THEN
            DBMS_OUTPUT.PUT_LINE(snum || ' ' || sname || ' ' || comm);
            cnt := cnt + 1;
        END IF;
        IF cnt > 4 THEN 
            exit; 
        END IF;

    END LOOP;
END;
/

BEGIN
    procedure2;
    procedure2_cur;
END;
