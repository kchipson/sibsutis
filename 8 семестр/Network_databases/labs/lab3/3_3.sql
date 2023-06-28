CREATE OR REPLACE PACKAGE Pack IS
    PROCEDURE Sal_city_cnt (cityname IN varchar2);
    PROCEDURE Cust_city_cnt (cityname IN varchar2);
END Pack;

/
CREATE OR REPLACE PACKAGE BODY Pack IS
    cnt NUMBER(3);
    PROCEDURE Sal_city_cnt(cityname IN varchar2) IS
        CURSOR cur(v_city varchar2) IS SELECT snum FROM sal WHERE city = v_city;
    BEGIN
        cnt := 0;
        FOR rec in cur(cityname) LOOP
            IF cur%NOTFOUND
                THEN exit; 
            END IF;
            cnt := cnt + 1;
        END LOOP;

        DBMS_OUTPUT.PUT_LINE('Number of sellers in '||cityname||' = '||cnt);
        cnt := 0;
    END Sal_city_cnt;

    PROCEDURE Cust_city_cnt(cityname IN varchar2) IS
        CURSOR cur(v_city varchar2) IS SELECT snum FROM sal WHERE city = v_city;
    BEGIN
        cnt := 0;
        FOR rec in cur(cityname) LOOP
            IF cur%NOTFOUND
                THEN exit; 
            END IF;
            cnt := cnt + 1;
        END LOOP;

        DBMS_OUTPUT.PUT_LINE('Number of customers in '||cityname||' = '||cnt);
        cnt := 0;
    END Cust_city_cnt;
END Pack;
/

BEGIN
    Pack.Sal_city_cnt('London');
    Pack.Cust_city_cnt('London');
END;
