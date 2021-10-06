% Автор kchipson
% Дата 13.11.2020

/*
 1. Списки (списки вводятся с клавиатуры во время выполнения программы)
1.13. Удалите из списка все вхождения элемента X.*/


del([], _, []).

del([H|T], H, Res) :- 
    !, 
    del(T, H, Res).

del([H|T], X, [H|Res]) :-
    del(T, X, Res).

print_del :-
    format('~n~t~w~t~85~n~n~t~w~t~85~n~`t~85', ['1. Списки (списки вводятся с клавиатуры во время выполнения программы)','1.13. Удалите из списка все вхождения элемента X.']),
    format('~nВведите список  ~n'), read(List),
    format('~nВведите удаляемый элемент ~n'), read(D),
	del(List, D, List_new), format('~nРезультат ~n~t~w~n',[List_new]).

t1 :- print_del.

/*
 2. Строки, файлы
2.13. Переставьте строки текстового файла в обратном порядке. Сформируйте новый файл.
% reverseLinesOfFile(Input, Output) -
*/

reverseLinesOfFile(In, Out) :-
    repeat,
    read_line_to_string(In, S),
    (S == end_of_file, !;
    reverseLinesOfFile(In, Out),
    writeln(Out, S), fail).

print_reverseLinesOfFile :-
    format('~n~t~w~t~85~n~n~t~w~t~85~n~`t~85', ['2. Строки, файлы','2.13. Переставьте строки текстового файла в обратном порядке. Сформируйте новый файл.']),
    format('~nВведите название входного файла (Файл должен находиться в директории программы и иметь расширение .txt) ~n'), read(I),
    format('~nВведите название выходного файла (Файл будет находиться в директории программы и иметь расширение .txt) ~n'), read(O),
    concat(I, '.txt', Input),
    concat(O, '.txt', Output),
    open(Input, read, In),
    open(Output, write, Out),
    reverseLinesOfFile(In, Out),
    close(In),
    close(Out).

t2 :- print_reverseLinesOfFile.

