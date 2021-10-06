#ifndef FUNCTIONS_HPP
#define FUNCTIONS_HPP
#include <fstream>
#include <iostream>
#include <conio.h>
#include "struct.hpp"


/* �������� ����� � �� */
bool openDataBase(char* filename, std::fstream*& file);

/* ���������� �� � ������������ ��������� ������ */
listDataBase* readDataBase(std::fstream*& file, unsigned int & size);

/* �������� ���������� */
void digitalSort(listDataBase *(&S), int dec);

/* ����� � ����� ��������� */
void pauseAtTheEnd();

/* ������������� ���������� ������� */
itemDataBase** createIndexArr(listDataBase* p ,unsigned int size);

short int comparator(char *word1, char *word2);
/* �������� ����� (ver#2) */
listDataBase *binarySearch(itemDataBase **arr, int size, const char *keySearch);

#endif // FUNCTIONS_HPP
