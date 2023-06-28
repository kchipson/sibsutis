--	ѕостроение таблиц дл€ учебной базы данных
--
--
--
--	создание таблицы продавцов - SAL
--
create table SAL
  (SNUM number(4),
   SNAME varchar2(10) NOT NULL,
   CITY  varchar2(10) NOT NULL,
   COMM  number(7,2) NOT NULL);
--
--	создание таблицы заказчиков - CUST
--
create table CUST
  (CNUM number(4),
   CNAME varchar2(10) NOT NULL,
   CITY  varchar2(10) NOT NULL,
   RATING number(3) NOT NULL,
   SNUM number(4));
--
--	создание таблицы заказов - ORD
--
create table ORD
  (ONUM number(4),
   AMT  number(7,2) NOT NULL,
   ODATE date NOT NULL,
   CNUM number(4),
   SNUM number(4));
--
--	определение первичного ключа таблицы sal
--
ALTER TABLE sal
   ADD (CONSTRAINT sal_pk_snum PRIMARY KEY (snum));
--
--	определение первичного и внешнего ключей таблицы cust
--
ALTER TABLE cust
   ADD (CONSTRAINT cust_pk_cnum PRIMARY KEY (cnum),
        CONSTRAINT cust_fk_snum FOREIGN KEY (snum)
        REFERENCES sal(snum));
--
--	определение первичного и внешних ключей таблицы ord
--
ALTER TABLE ord
   ADD (CONSTRAINT ord_pk_onum PRIMARY KEY (onum),
        CONSTRAINT ord_fk_cnum FOREIGN KEY (cnum)
        REFERENCES cust(cnum),
        CONSTRAINT ord_fk_snum FOREIGN KEY (snum)
        REFERENCES sal(snum));
--
select table_name, column_name, constraint_name
       from user_cons_columns;
