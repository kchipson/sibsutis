#ifndef FUNC_OUT_HPP
#define FUNC_OUT_HPP

#include <iostream>
#include <conio.h>
#include "struct.hpp"

const unsigned short int itemsPage = 30; // Кол-во записей на странице

/* Вывод */
void output(listDataBase* p);
void output(itemDataBase** arr,unsigned int size);

/* Вывод элемента БД */
void printItemDB(itemDataBase item);
/* Постраничный вывод БД */
void outputDB_PbyP(listDataBase *head);
void outputDB_PbyP(itemDataBase **arr, unsigned int size);
/* Полный вывод БД */
void outputDB_Full(listDataBase *p);
void outputDB_Full(itemDataBase **arr, unsigned int size);


#endif // FUNC_OUT_HPP
