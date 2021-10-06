#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP
#include <fstream>
#include <iostream>
#include <conio.h>
#include "struct.hpp"


/* Открытие файла с БД */
bool openDataBase(char* filename, std::fstream*& file);

/* Считывание БД и формирование исходного списка */
listDataBase* readDataBase(std::fstream*& file, unsigned int & size);

/* Цифровая сортировка */
void digitalSort(listDataBase *(&S), int dec);

/* Пауза в конце программы */
void pauseAtTheEnd();

/* Инициализация индексного массива */
itemDataBase** createIndexArr(listDataBase* p ,unsigned int size);

short int comparator(char *word1, char *word2);
/* Бинарный поиск (ver#2) */
listDataBase *binarySearch(itemDataBase **arr, int size, const char *keySearch);

#endif // FUNCTIONS_HPP
