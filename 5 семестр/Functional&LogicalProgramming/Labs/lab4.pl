% Автор: kchipson
% Дата: 25.09.2020


/* Каждая бригада выполняет все задачи */


/* 1. Описать следующее дерево отношений с помощью предиката "родитель" */
% Родитель(родитель, ребенок)

parent(bob , liz).
parent(bob , paul).
parent(bob , sam).
parent(john , bob).
parent(mary , ann).
parent(mary , bob).
parent(paul , pat).
% pat - м

/* 2. Введите отношения "мужчина", "женщина" в форме фактов. */

man(bob).
man(john).
man(pat).
man(paul).
man(sam).

woman(ann).
woman(liz).
woman(mary).


/* 3. С помощью правил определите отношения "отец", "мать", "брат", "сестра", "внук",
"тетя", "иметь двух детей", "продолжатель рода" (мужчина, у которого есть сын).*/

father(Dad, Child) :- parent(Dad, Child), man(Dad).

mother(Mum, Child) :- parent(Mum, Child), woman(Mum).

brother(Bro, Human) :- parent(X, Bro), parent(X, Human), man(Bro), Bro \= Human.
sister(Chan, Human) :- parent(X, Chan), parent(X, Human), woman(Chan), Chan \= Human.

grandson(GSon, Human) :- parent(X, GSon), parent(Human, X), man(GSon).

aunt(Aunt, Human) :- parent(X, Human), sister(Aunt, X).

twoChildren(Human) :- parent(Human, X), parent(Human, Y), X @> Y, not((parent(Human, Z), Z \= X, Z \= Y)).

progenitorOfTheGenus(Man) :- parent(Man, X), man(X) ,man(Man).

/* 4. Задайте вопросы и получите ответы в Пролог-системе: 
    а) Кто отец Сэма?
father(Who, sam).
    б) Есть ли мать у Боба? (ответ должен быть true)
mother(_, bob). % TODO: Почему _ булевый ответ? 
    в) Кто сестра Сэма?
sister(Who, sam).
    г) Есть ли сестра у Лиз?
sister(_, liz).
    д) Кто брат Боба?
brother(Who, bob).
    е) Кто внуки Мэри?
grandson(Who, mary).
    ж) Чей внук Паул?
grandson(paul, Who).
    з) Кто тетя Сэма?
aunt(Who, sam).
    и) Есть ли племянники у Энн?
aunt(ann, _).
    к) У кого ровно двое детей? (Пролог-система должна находить только Мэри, и,
    причем, только один раз).
twoChildren(Who).
    л) Боб - продолжатель рода?
progenitorOfTheGenus(bob).
*/

а :-
    write('а) Кто отец Сэма?'), nl, father(Who, sam), write(Who).
б :-
    write('б) Есть ли мать у Боба? (ответ должен быть true)'), nl, mother(_, bob).
в :-
    write('в) Кто сестра Сэма?'), nl, sister(Who, sam), write(Who).
г :-
    write('г) Есть ли сестра у Лиз?'), nl, sister(_, liz).
д :-
    write('д) Кто брат Боба?'), nl, brother(Who, bob), write(Who).
е :-
    write('е) Кто внуки Мэри?'), nl, grandson(Who, mary), write(Who).
ж :-
    write('ж) Чей внук Паул?'), nl, grandson(paul, Who), write(Who).
з :-
    write('з) Кто тетя Сэма?'), nl, aunt(Who, sam), write(Who).
и :-
    write('и) Есть ли племянники у Энн?'), nl, aunt(ann, _).
к :-
    write('к) У кого ровно двое детей? (Пролог-система должна находить только Мэри, и, причем, только один раз).'), nl, twoChildren(Who), write(Who).
л :-
    write('л) Боб - продолжатель рода?'), nl, progenitorOfTheGenus(bob).
