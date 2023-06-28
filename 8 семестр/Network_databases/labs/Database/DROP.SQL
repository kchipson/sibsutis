--	Удаление таблиц учебной базы данных
--
--
select table_name, column_name, constraint_name
       from user_cons_columns;
--
--
 DROP TABLE ord;
 DROP TABLE cust;
 DROP TABLE sal;
-- DROP TABLE opdb;
--
select table_name, column_name, constraint_name
       from user_cons_columns;