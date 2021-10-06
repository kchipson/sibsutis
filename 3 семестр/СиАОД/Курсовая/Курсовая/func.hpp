#ifndef FUNC_HPP
#define FUNC_HPP
#include <fstream>
#include <iostream>
#include <iomanip>
#include <conio.h>
#include <afxres.h> // STD_INPUT_HANDLE (Извлекает дескриптор указанного стандартного устройства)

#include "struct.hpp"
#include "rotationsAVL.hpp"

void readDataBase(listDataBase *&p, unsigned int & size);

void digitalSort(listDataBase *(&S), int reverse);

void delList(listDataBase *&p);

void createIndexArr(itemDataBase** &arr, listDataBase* p ,unsigned int size);
void delArr(itemDataBase** &arr, unsigned int size);

short int comparator(const char *word1, const char * word2);
listDataBase *binarySearch(itemDataBase **arr, unsigned int size, char *keySearch);

void addAVL(treeLawyer *&p, itemDataBase data, bool &growth);
treeLawyer *findVertexWithKey(treeLawyer *p, char *key);
void delTree(treeLawyer *&p);

void tableSymbols(coding* &code, int &numsUnique);

void pause();
bool selectionCheck();
void clearBuffer();
#endif // FUNC_HPP
