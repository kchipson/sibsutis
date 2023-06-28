DECLARE
    rat NUMBER(10);
    custname varchar2(10);
    low_rating exception;
BEGIN
    custname := 'qwerty'; -- unknown name
    -- custname := 'Hoffman'; -- rating 100
    -- custname := 'Grass'; -- rating300
    

    SELECT rating INTO rat FROM cust WHERE cname = custname;
    IF rat < 200 THEN RAISE low_rating; END IF;
    EXCEPTION 
        WHEN low_rating THEN DBMS_OUTPUT.PUT_LINE('Rating is lower than 200');
        WHEN OTHERS THEN DBMS_OUTPUT.PUT_LINE('UNKNOWN ERROR');
END;
