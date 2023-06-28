DECLARE
    maxdate DATE;
BEGIN
    SELECT MAX(ODATE) INTO maxdate FROM ORD;
    DBMS_OUTPUT.put_line('Max date is :'||maxdate);
END;
