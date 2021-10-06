#include "funcOut.hpp"
#include "functions.hpp"
#include "struct.hpp"
#include <fstream>
#include "windows.h"
#include <iostream>
int main(int argc, char const *argv[]){
  /*SetConsoleCP(866);
  SetConsoleOutputCP(866);*/
  setlocale(LC_ALL,"866");

  std::fstream *file = new std::fstream;
  listDataBase * list = nullptr;
  unsigned int sizeDataBase = 0;
  itemDataBase **arr = nullptr;

  /* Чтение из БД и формирование исходного списка */
  if(!openDataBase((char*)"DataBase.dat",file)){
    std::cout << "File not found!" << std::endl;
    return 1;
  }
  list = readDataBase(file, sizeDataBase);
  file->close();
  delete(file);
 output(list);
  digitalSort(list,0);
  arr = createIndexArr(list, sizeDataBase);
  //output(arr, sizeDataBase);

  /* Бинарный поиск с формированием очереди и ее выводом */
  listDataBase * search;
  char keySearch[30];
 /* std::cin.getline(keySearch, 30, '\n');
  if (std::cin.fail()) {
    std::cin.clear();
    while (std::cin.get() != '\n')
      ;
  }*/
/*  if (search = binarySearch(arr, sizeDataBase, keySearch))
    outputDB_Full(search);
  else
    std::cout
        << std::endl
        << "< No values were found for the given key in the database >"
        << std::endl;*/
  char k1[10];
  std::cin.getline(keySearch, 10, '\n');
  char k2[10];
  std::cin.getline(keySearch, 10, '\n');

  std::cout<< comparator(k1,k2);

  pauseAtTheEnd();
  return 0;
}