#include "Functions.h"
#include <iostream>
#include <cstdlib>
void SortByField(phone_book* data, int* index, string sortField)
{
    int i;
    for (i = 0; i < structSize; i += 1) {
        index[i] = i;
    }

    InsertSort(data, index, sortField);
}

void InsertSort(phone_book* data, int* index, string sortField)
{
    int i, j, temp;
    for (i = 1; i < structSize; i++) {
        temp = index[i];
        j = i - 1;
        while (j >= 0 && Field(data[temp],data[index[j]], sortField)) {
            index[j + 1] = index[j];
            j = j - 1;
        }
        index[j + 1] = temp;
    }
}

bool Field(phone_book firstStruct, phone_book secondStruct, string sortField)
{
    if (sortField == "surname")
        return (firstStruct.surname < secondStruct.surname);
    else if (sortField == "name")
        return (firstStruct.name < secondStruct.name);
    else if (sortField == "number")
        return (firstStruct.number < secondStruct.number);
    else if (sortField == "email")
        return (firstStruct.email < secondStruct.email);
    else{
    	cout<<endl<<"ОШИБКА! Поля "<<sortField<<" у структуры нет"<<endl;
       	exit(0);
    }
}

