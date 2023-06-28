DECLARE 
    tmp_num INTEGER;
    tmp INTEGER;
BEGIN 
    tmp_num := 2008;

    -- тупейшее решение
    LOOP
        SELECT count(cnum) INTO tmp FROM cust WHERE cnum = tmp_num;
        IF tmp = 0 THEN
            DBMS_OUTPUT.PUT_LINE(tmp_num);
            EXIT;
        END IF;
        tmp_num := tmp_num + 1;
           
    END LOOP;
 END;
/

DECLARE 
    name_sal VARCHAR2(10);
    orders404 EXCEPTION;
    CURSOR cur IS 
        SELECT sal.snum, sal.sname, sal.city, cnt
        FROM sal
        LEFT JOIN (
            SELECT ord.snum, COUNT(*) as cnt
                FROM ord 
                WHERE ord.odate > '01/03/2010'
                GROUP BY ord.snum
        ) ord_count ON sal.snum = ord_count.snum;
    
BEGIN 
    FOR rec IN cur LOOP
        IF cur%NOTFOUND
            THEN exit; 
        END IF;
        IF rec.cnt IS NULL THEN 
            name_sal := rec.sname;
            RAISE orders404; 
        END IF;
    END LOOP;
    EXCEPTION 
        WHEN orders404 
            THEN DBMS_OUTPUT.PUT_LINE(name_sal);
        WHEN OTHERS 
            THEN DBMS_OUTPUT.PUT_LINE('UNKNOWN ERROR');
END;

-- Человеческое решение, а мб и не совсем
-- SELECT sal.snum, sal.sname, sal.city, sal.comm, cnt
-- FROM sal
-- LEFT JOIN (
--     SELECT ord.snum, COUNT(*) as cnt
--         FROM ord 
--         WHERE ord.odate > '01/03/2010'
--         GROUP BY ord.snum
-- ) ord_count ON sal.snum = ord_count.snum 
-- WHERE ord_count.snum IS NULL FETCH FIRST 1 ROWS ONLY;