DECLARE
    sname VARCHAR2(10);
    comm NUMBER(7,2);
    CURSOR cur IS SELECT sname, comm FROM sal WHERE city != 'London';
    
BEGIN
    -- OPEN cur;
    -- IF NOT cur%ISOPEN 
    --     THEN OPEN cur; 
    -- END IF;
    -- LOOP
    --     FETCH cur INTO sname, comm;

    --     IF cur%NOTFOUND
    --         THEN exit; 
    --     END IF;

    --     IF cur%ROWCOUNT > 2 
    --         THEN exit; 
    --     END IF;

    --     DBMS_OUTPUT.PUT_LINE(sname || ':   ' || comm);
    -- END LOOP;
    FOR rec IN cur LOOP
        IF cur%NOTFOUND
            THEN exit; 
        END IF;
        IF cur%ROWCOUNT > 2 
            THEN exit; 
        END IF;
        DBMS_OUTPUT.PUT_LINE(rec.sname||':'||rec.comm);
    END LOOP;

END;
