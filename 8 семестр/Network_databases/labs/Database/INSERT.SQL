--	Заполнение таблиц учебной БД
--
--
--	заполнение таблицы sal
--
INSERT INTO sal
  VALUES (1001, 'Peel', 'London', .12);
INSERT INTO sal
  VALUES (1002, 'Serres', 'San Jose', .13);
INSERT INTO sal
  VALUES (1004, 'Motica', 'London', .11);
INSERT INTO sal
  VALUES (1007, 'Rifkin', 'Barcelona', .15);
INSERT INTO sal
  VALUES (1003, 'Axelrod', 'New York', .10);
--
--	заполнение таблицы cust
--
INSERT INTO cust
  VALUES (2001, 'Hoffman', 'London', 100, 1001);
INSERT INTO cust
  VALUES (2002, 'Giovanni', 'Rome', 200, 1003);
INSERT INTO cust
  VALUES (2003, 'Liu', 'San Jose', 200, 1002);
INSERT INTO cust
  VALUES (2004, 'Grass', 'Berlin', 300, 1002);
INSERT INTO cust
  VALUES (2006, 'Clemens', 'London', 100, 1001);
INSERT INTO cust
  VALUES (2008, 'Cisneros', 'San Jose', 300, 1007);
INSERT INTO cust
  VALUES (2007, 'Pereira', 'Rome', 100, 1004);
--
--	заполнение таблицы ord
--
INSERT INTO ord
  VALUES (3001, 18.69,   to_date('03.01.2010','dd.mm.yyyy'), 2008, 1007);
INSERT INTO ord
  VALUES (3003, 767.19,  to_date('03.01.2010','dd.mm.yyyy'), 2001, 1001);
INSERT INTO ord
  VALUES (3002, 1900.11, to_date('03.01.2010','dd.mm.yyyy'), 2007, 1004);
INSERT INTO ord
  VALUES (3005, 5160.45, to_date('03.01.2010','dd.mm.yyyy'), 2003, 1002);
INSERT INTO ord
  VALUES (3006, 1098.16, to_date('03.01.2010','dd.mm.yyyy'), 2008, 1007);
INSERT INTO ord
  VALUES (3009, 1713.23, to_date('04.01.2010','dd.mm.yyyy'), 2002, 1003);
INSERT INTO ord
  VALUES (3007, 75.75,   to_date('04.01.2010','dd.mm.yyyy'), 2004, 1002);
INSERT INTO ord
  VALUES (3008, 4723.00, to_date('05.01.2010','dd.mm.yyyy'), 2006, 1001);
INSERT INTO ord
  VALUES (3010, 1309.95, to_date('06.01.2010','dd.mm.yyyy'), 2004, 1002);
INSERT INTO ord
  VALUES (3011, 9891.88, to_date('06.01.2010','dd.mm.yyyy'), 2006, 1001);
--
COMMIT;
--
--
--     SNUM SNAME      CITY            COMM
----------- ---------- ---------- ---------
--     1001 Peel       London           .12
--     1002 Serres     San Jose         .13
--     1004 Motica     London           .11
--     1007 Rifkin     Barcelona        .15
--     1003 Axelrod    New York          .1
--
--     CNUM CNAME      CITY          RATING      SNUM
----------- ---------- ---------- --------- ---------
--     2001 Hoffman    London           100      1001
--     2002 Giovanni   Rome             200      1003
--     2003 Liu        San Jose         200      1002
--     2004 Grass      Berlin           300      1002
--     2006 Clemens    London           100      1001
--     2008 Cisneros   San Jose         300      1007
--     2007 Pereira    Rome             100      1004
--
--     ONUM       AMT ODATE          CNUM      SNUM
----------- --------- --------- --------- ---------
--     3001     18.69 03.01.2010      2008      1007
--     3003    767.19 03.01.2010      2001      1001
--     3002    1900.1 03.01.2010      2007      1004
--     3005   5160.45 03.01.2010      2003      1002
--     3006   1098.16 03.01.2010      2008      1007
--     3009   1713.23 04.01.2010      2002      1003
--     3007     75.75 04.01.2010      2004      1002
--     3008      4723 05.01.2010      2006      1001
--     3010   1309.95 06.01.2010      2004      1002
--     3011   9891.88 06.01.2010      2006      1001
--
select * from sal;
select * from cust;
select * from ord;
