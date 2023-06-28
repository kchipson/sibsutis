 DROP TABLE lab4_task4_ord;
 DROP TABLE lab4_task4_cust;
 DROP TABLE lab4_task4_sal;

--	Построение таблиц для учебной базы данных
--
--
--
--	создание таблицы продавцов - lab4_task4_sal
--
CREATE TABLE lab4_task4_sal
  (SNUM number(4),
   SNAME varchar2(10) NOT NULL,
   CITY  varchar2(10) NOT NULL,
   COMM  number(7,2) NOT NULL);
--
--	создание таблицы заказчиков - lab4_task4_cust
--
CREATE TABLE lab4_task4_cust
  (CNUM number(4),
   CNAME varchar2(10) NOT NULL,
   CITY  varchar2(10) NOT NULL,
   RATING number(3) NOT NULL,
   SNUM number(4));
--
--	создание таблицы заказов - lab4_task4_ord
--
CREATE TABLE lab4_task4_ord
  (ONUM number(4),
   AMT  number(7,2) NOT NULL,
   ODATE date NOT NULL,
   CNUM number(4),
   SNUM number(4));
--
--	определение первичного ключа таблицы lab4_task4_sal
--
ALTER TABLE lab4_task4_sal
   ADD (CONSTRAINT lab4_task4_sal_pk_snum PRIMARY KEY (snum));
--
--	определение первичного и внешнего ключей таблицы lab4_task4_cust
--
ALTER TABLE lab4_task4_cust
   ADD (CONSTRAINT lab4_task4_cust_pk_cnum PRIMARY KEY (cnum),
        CONSTRAINT lab4_task4_cust_fk_snum FOREIGN KEY (snum)
        REFERENCES lab4_task4_sal(snum));
--
--	определение первичного и внешних ключей таблицы lab4_task4_ord
--
ALTER TABLE lab4_task4_ord
   ADD (CONSTRAINT lab4_task4_ord_pk_onum PRIMARY KEY (onum),
        CONSTRAINT lab4_task4_ord_fk_cnum FOREIGN KEY (cnum)
        REFERENCES lab4_task4_cust(cnum),
        CONSTRAINT lab4_task4_ord_fk_snum FOREIGN KEY (snum)
        REFERENCES lab4_task4_sal(snum));
--
select table_name, column_name, constraint_name
       from user_cons_columns;
--	Заполнение таблиц учебной БД
--
--
--	заполнение таблицы lab4_task4_sal
--
INSERT INTO lab4_task4_sal
  VALUES (1001, 'Peel', 'London', .12);
INSERT INTO lab4_task4_sal
  VALUES (1002, 'Serres', 'San Jose', .13);
INSERT INTO lab4_task4_sal
  VALUES (1004, 'Motica', 'London', .11);
INSERT INTO lab4_task4_sal
  VALUES (1007, 'Rifkin', 'Barcelona', .15);
INSERT INTO lab4_task4_sal
  VALUES (1003, 'Axelrod', 'New York', .10);
--
--	заполнение таблицы lab4_task4_cust
--
INSERT INTO lab4_task4_cust
  VALUES (2001, 'Hoffman', 'London', 100, 1001);
INSERT INTO lab4_task4_cust
  VALUES (2002, 'Giovanni', 'Rome', 200, 1003);
INSERT INTO lab4_task4_cust
  VALUES (2003, 'Liu', 'San Jose', 200, 1002);
INSERT INTO lab4_task4_cust
  VALUES (2004, 'Grass', 'Berlin', 300, 1002);
INSERT INTO lab4_task4_cust
  VALUES (2006, 'Clemens', 'London', 100, 1001);
INSERT INTO lab4_task4_cust
  VALUES (2008, 'Cisneros', 'San Jose', 300, 1007);
INSERT INTO lab4_task4_cust
  VALUES (2007, 'Pereira', 'Rome', 100, 1004);
--
--	заполнение таблицы lab4_task4_ord
--
INSERT INTO lab4_task4_ord
  VALUES (3001, 18.69,   to_date('03.01.2010','dd.mm.yyyy'), 2008, 1007);
INSERT INTO lab4_task4_ord
  VALUES (3003, 767.19,  to_date('03.01.2010','dd.mm.yyyy'), 2001, 1001);
INSERT INTO lab4_task4_ord
  VALUES (3002, 1900.11, to_date('03.01.2010','dd.mm.yyyy'), 2007, 1004);
INSERT INTO lab4_task4_ord
  VALUES (3005, 5160.45, to_date('03.01.2010','dd.mm.yyyy'), 2003, 1002);
INSERT INTO lab4_task4_ord
  VALUES (3006, 1098.16, to_date('03.01.2010','dd.mm.yyyy'), 2008, 1007);
INSERT INTO lab4_task4_ord
  VALUES (3009, 1713.23, to_date('04.01.2010','dd.mm.yyyy'), 2002, 1003);
INSERT INTO lab4_task4_ord
  VALUES (3007, 75.75,   to_date('04.01.2010','dd.mm.yyyy'), 2004, 1002);
INSERT INTO lab4_task4_ord
  VALUES (3008, 4723.00, to_date('05.01.2010','dd.mm.yyyy'), 2006, 1001);
INSERT INTO lab4_task4_ord
  VALUES (3010, 1309.95, to_date('06.01.2010','dd.mm.yyyy'), 2004, 1002);
INSERT INTO lab4_task4_ord
  VALUES (3011, 9891.88, to_date('06.01.2010','dd.mm.yyyy'), 2006, 1001);
--
COMMIT;



TRUNCATE TABLE lab4_task4_ord;
DELETE FROM lab4_task4_sal;
DELETE FROM lab4_task4_cust;

ROLLBACK;

SELECT * FROM lab4_task4_sal;
SELECT * FROM lab4_task4_cust;
SELECT * FROM lab4_task4_ord;
