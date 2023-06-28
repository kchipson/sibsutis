DECLARE
    CURSOR cur(var_date DATE) IS SELECT onum, amt, odate FROM ord WHERE odate >= var_date;
BEGIN
    FOR rec IN cur('01/04/2010') LOOP
        DBMS_OUTPUT.PUT_LINE('#' || rec.onum || '  ' || rec.odate || ' amount = ' || rec.amt);
    END LOOP;
END;
