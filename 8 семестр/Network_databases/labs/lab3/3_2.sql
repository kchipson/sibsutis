CREATE OR REPLACE FUNCTION money(amt IN NUMBER) RETURN VARCHAR2
IS
    fract NUMBER;
    integ NUMBER;
    str VARCHAR2(50);
BEGIN
    integ := trunc(amt);
    fract := (amt - integ) * 100;
    IF mod(integ, 10) = 1 AND mod(integ, 100) != 11 THEN
        str := integ || ' ' || 'рубль';
    ELSIF mod(integ, 10) < 5 AND mod(integ, 10) > 1 AND mod(integ, 100) != 12 AND mod(integ, 100) != 13 AND mod(integ, 100) != 14 THEN
        str := integ || ' ' || 'рубля';
    ELSE 
        str := integ || ' ' || 'рублей';
    END IF;

    IF mod(fract, 10) = 1 AND mod(fract, 100) != 11 THEN
        str := str || ' ' || fract || ' ' || 'копейка';
    ELSIF mod(fract, 10) < 5 AND mod(fract, 10) > 1 AND mod(fract, 100) != 12 AND mod(fract, 100) != 13 AND mod(fract, 100) != 14 THEN
        str := str || ' ' || fract || ' ' || 'копейки';
    ELSE 
        str := str || ' ' || fract || ' ' || 'копеек';
    END IF;
    
    DBMS_OUTPUT.put_line(str);
    RETURN (str);
END;
/
SELECT ord.onum, money(ord.amt) FROM ord;