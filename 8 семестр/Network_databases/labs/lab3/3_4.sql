CREATE OR REPLACE PACKAGE Pack_master IS
    PROCEDURE min_surname (surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2);
    PROCEDURE max_surname (surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2);
END Pack_master;
/

CREATE OR REPLACE PACKAGE Pack_slave IS
    PROCEDURE information(surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2);
END Pack_slave;
/

CREATE OR REPLACE PACKAGE BODY Pack_master IS

    PROCEDURE min_surname (surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2) IS
    BEGIN
        IF LENGTH(surname1) >= LENGTH(surname2) THEN
            IF LENGTH(surname1) >= LENGTH(surname3) THEN
                DBMS_OUTPUT.PUT_LINE('The longest surname = ' || surname1);
            ELSE
                DBMS_OUTPUT.PUT_LINE('The longest surname = ' || surname3);
            END IF;
        ELSE
            IF LENGTH(surname2) >= LENGTH(surname3) THEN
                DBMS_OUTPUT.PUT_LINE('The longest surname = ' || surname2);
            ELSE
                DBMS_OUTPUT.PUT_LINE('The longest surname = ' || surname3);
            END IF;
        END IF;
    END min_surname;

    PROCEDURE max_surname (surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2) IS
    BEGIN
        IF LENGTH(surname1) <= LENGTH(surname2) THEN
            IF LENGTH(surname1) <= LENGTH(surname3) THEN
                DBMS_OUTPUT.PUT_LINE('The shortest surname = '||surname1);
            ELSE
                DBMS_OUTPUT.PUT_LINE('The shortest surname = '||surname3);
            END IF;
        ELSE
            IF LENGTH(surname2) <= LENGTH(surname3) THEN
                DBMS_OUTPUT.PUT_LINE('The shortest surname = '||surname2);
            ELSE
                DBMS_OUTPUT.PUT_LINE('The shortest surname = '||surname3);
            END IF;
        END IF;
    END max_surname;
END Pack_master;
/

CREATE OR REPLACE PACKAGE BODY Pack_slave IS
    PROCEDURE information (surname1 IN varchar2, surname2 IN varchar2, surname3 IN varchar2) IS
    BEGIN
        Pack_master.min_surname (surname1, surname2, surname3);
        Pack_master.max_surname (surname1, surname2, surname3);
    END information;
END Pack_slave;
/

BEGIN
    Pack_slave.information('Mironenko', 'Leskovec', 'Stoyak');
END;
