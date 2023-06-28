CREATE TABLE log_upds_orders (
  l_name VARCHAR(50),
  l_time TIMESTAMP WITH TIME ZONE,
  old_amt NUMBER(10, 2),
  new_amt NUMBER(10, 2)
);

CREATE OR REPLACE TRIGGER update_order_trigger
BEFORE UPDATE ON ord
FOR EACH ROW
BEGIN
    IF :NEW.amt > :OLD.amt THEN
        INSERT INTO log_upds_orders(l_name, l_time, old_amt, new_amt)
            VALUES (user, CURRENT_TIMESTAMP, :OLD.amt, :NEW.amt);
    ELSE
        raise_application_error(-20001,'Malo');
    END IF;
  
END;
/ 

CREATE OR REPLACE VIEW view_table AS
    SELECT sal.snum, sal.sname, sal.city, ma.minAmt FROM sal INNER JOIN  (SELECT ord.snum, MIN(ord.amt) AS minAmt FROM ord GROUP BY ord.snum) ma ON sal.snum = ma.snum;


GRANT SELECT ON view_table TO public;

SELECT * FROM view_table;

UPDATE ord SET amt = 9999 WHERE ONUM = 3003;

UPDATE ord SET amt = 0 WHERE ONUM = 3003;