drop database if exists rgr;
create database rgr;
use rgr;

create table T2(
    n INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(20) NOT NULL,
    type VARCHAR(20) NOT NULL,
    firm VARCHAR(20) NOT NULL,
    PRIMARY KEY(n)
);


INSERT INTO T2(name, type, firm) VALUES ('Win95', 'Win', 'Microsoft');
INSERT INTO T2(name, type, firm) VALUES ('Win98', 'Win', 'Microsoft');
INSERT INTO T2(name, type, firm) VALUES ('WinNT', 'Win', 'UnixF');
INSERT INTO T2(name, type, firm) VALUES ('WinXP', 'Win', 'Apple');
INSERT INTO T2(name, type, firm) VALUES ('Unix', 'Unix', 'UnixF');
INSERT INTO T2(name, type, firm) VALUES ('FreeBSD', 'Unix', 'Jobbs');
INSERT INTO T2(name, type, firm) VALUES ('Linux', 'Unix', 'UnixF');
INSERT INTO T2(name, type, firm) VALUES ('MacOS1', 'Mac', 'Apple');
INSERT INTO T2(name, type, firm) VALUES ('MacOS2', 'Mac', 'Apple');
INSERT INTO T2(name, type, firm) VALUES ('MacOS3', 'Mac', 'Jobbs');

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --


-- # 1. Вывести список ОС, начинающихся с буквы, задаваемой в запросе

SELECT * FROM t2 WHERE name LIKE 'W%';
-- # 1. Вывести список ОС, начинающихся с буквы, задаваемой в запросе

SELECT * FROM t2 WHERE name LIKE 'm%';

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --


-- # 2. Вывести список таких фирм, которые разрабатывают OC первого по алфавиту типа

SELECT DISTINCT firm FROM t2 WHERE type=(SELECT MIN(type) FROM t2);

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

-- # 3. Вывести типы ОС, разрабатываемых теми же фирмами, которые разрабатывают ОС,
-- не содержащие в названии букву, указанную в запросе.
SELECT DISTINCT type FROM t2 WHERE firm NOT IN (SELECT DISTINCT firm FROM t2 WHERE name LIKE '%s%');
SELECT DISTINCT type FROM t2 WHERE firm NOT IN (SELECT DISTINCT firm FROM t2 WHERE name LIKE '%i%');