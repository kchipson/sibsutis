SELECT 
    sal.snum AS ORDER_NUM,
    sal.sname AS ORDER_NAME,
    SUM(DECODE(ord.odate, '01/03/2010', ord.amt, 0)) "3 January",
    SUM(DECODE(ord.odate, '01/04/2010', ord.amt, 0)) "4 January",
    SUM(DECODE(ord.odate, '01/05/2010', ord.amt, 0)) "5 January",
    SUM(DECODE(ord.odate, '01/06/2010', ord.amt, 0)) "6 January",
    SUM(DECODE(ord.odate, '01/07/2010', ord.amt, 0)) "7 January"
FROM sal, ord WHERE sal.snum = ord.snum GROUP BY sal.snum, sal.sname ORDER BY sal.snum ASC;
