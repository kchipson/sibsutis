#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP

#include <conio.h>
#include <iostream>
#include <cstring>
#include "struct.hpp"

/* Вывести элемент БД */
void printItemDB(itemDataBase item);

/* Постраничный вывод БД */
void outputDB_PbyP(listDataBase *head, unsigned short int numOfElemsPerPage);
void outputDB_PbyP(itemDataBase **arr, unsigned short int size,
                   unsigned short int numOfElemsPerPage);

/* Полный вывод БД */
void outputDB_Full(listDataBase *p);
void outputDB_Full(itemDataBase **arr, unsigned short int size);

/* Выбор вывода БД */
short int choiceOutput();

/* Цифровая сортировка */
void digitalSort(listDataBase *(&S), int dec = 0);

short int comparator(const char *word1, const char *word2);
/* Бинарный поиск (ver#2) */
listDataBase *binarySearch(itemDataBase **arr, int size, const char *keySearch);

/* Да | Нет */
int selectionCheck();

/* Пауза в конце программы */
void pauseAtTheEnd();

#endif // !FUNCTIONS_HPP