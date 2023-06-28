DECLARE
    last_name varchar2(20);
    status varchar2(50);
    return_code varchar2(20);
BEGIN
    DBMS_OUTPUT.enable;
    SELECT sname INTO last_name FROM sal WHERE snum = 5000;
    EXCEPTION
    when OTHERS then
    status := 'Data not found';
    return_code := 5;
    DBMS_OUTPUT.PUT_LINE('code='||return_code||', '||status);
END;
