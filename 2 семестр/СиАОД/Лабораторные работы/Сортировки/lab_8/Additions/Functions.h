#ifndef FUNCTIONS_H
#define FUNCTIONS_H

#include "Structure.h"
#include <string>
using namespace std;

void SortByField(phone_book*, int* , string);
void InsertSort (phone_book* , int* , string);
bool Field(phone_book, phone_book, string);

#endif