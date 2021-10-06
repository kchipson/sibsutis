#include <conio.h>
#include <iostream>
#include <windows.h>

#include "func.hpp"
#include "funcOut.hpp"
#include "struct.hpp"

int main(int argc, char const *argv[]) {
  setlocale(LC_ALL,".866");
  char choice;
  listDataBase * listBase = nullptr;
  unsigned int sizeBase = 0;
  itemDataBase **arr = nullptr;
  char keySearch[30];
  listDataBase * resSearch1 = nullptr;
  listDataBase * tempList = nullptr;
  treeLawyer * treeAVL = nullptr;
  bool growth = false;
  treeLawyer *resSearch2 = nullptr;

  do{
    system("CLS");
    std::cout << "1) Вывести исходную базу данных" << std::endl;
    std::cout << "2) Вывести отсортированную базу данных" << std::endl;
    std::cout << "3) Бинарный поиск по базе" << std::endl;
    std::cout << "4) Дерево" << std::endl;
    std::cout << "5) Бинарный поиск в дереве" << std::endl;
    std::cout << std::endl
              << "----------------------------------------"
              <<std::endl
              << "0) Выйти" << std::endl;
    switch(choice = getch()){
      case '1':{
        /* Чтение и вывод исходной БД */
        system("CLS");
        readDataBase(listBase, sizeBase);
        output(listBase);
        pause();
        break;
      }
      case '2':{
        /* Вывод отсортированной БД и построение массива адресов */
        system("CLS");
        if (listBase == nullptr)
          readDataBase(listBase, sizeBase);
        digitalSort(listBase, false);
        createIndexArr(arr, listBase, sizeBase);
        output(listBase);
        pause();
        break;
      }
      case '3':{
        /* Бинарный поиск с формированием очереди и ее выводом */
        system("CLS");
        if (listBase == nullptr)
          readDataBase(listBase, sizeBase);
        digitalSort(listBase, false);
        createIndexArr(arr, listBase, sizeBase);

        std::cout << "Вывести базу?  ";
        if (selectionCheck())
          output(listBase);
        else
          system("CLS");
        std::cout<< "Ключ поиска > ";
        clearBuffer();
        std::cin.getline(keySearch, 30, '\n');
        system("CLS");
        if (resSearch1 != nullptr)
          delList(resSearch1);
        if ((resSearch1 = binarySearch(arr, sizeBase, keySearch)))
          outputDB_Full(resSearch1);
        pause();
        break;
      }
      case '4':{
        /* Дерево на основе бинарного поиска по ключу lawyer(адвокат) */
        system("CLS");
        if (resSearch1 != nullptr){
          outputDB_Full(resSearch1);
          std::cout << "Использовать данный поиск для постоения дерева? ";
          if(!selectionCheck())
            delList(resSearch1);
          system("CLS");
        }
        if (resSearch1 == nullptr){
          if (listBase == nullptr)
            readDataBase(listBase, sizeBase);
          digitalSort(listBase, false);
          createIndexArr(arr, listBase, sizeBase);
          std::cout << "Вывести базу?  ";
          if (selectionCheck())
            output(listBase);
          else
            system("CLS");
          std::cout<< "Ключ поиска > ";
          clearBuffer();
          std::cin.getline(keySearch, 30, '\n');
          system("CLS");
          if ((resSearch1 = binarySearch(arr, sizeBase, keySearch)))
            outputDB_Full(resSearch1);
        }
        delTree(treeAVL);
        if(resSearch1){
          for (tempList = resSearch1; tempList; tempList = tempList->next) {
            addAVL(treeAVL, tempList->data, growth);
          }
          outputTree(treeAVL);
        }

        pause();
        break;
      }
    case '5':{
      /* Бинарный поиск по дереву */
      system("CLS");
      if (treeAVL != nullptr){
        outputTree_LR(treeAVL, false);
        std::cout << "Использовать данное дерево для поика? ";
        if(!selectionCheck()){
          delTree(treeAVL);
          delList(resSearch1);
        }
      }
      if (treeAVL == nullptr){
        if (listBase == nullptr)
          readDataBase(listBase, sizeBase);
        digitalSort(listBase, false);
        createIndexArr(arr, listBase, sizeBase);
        system("CLS");
        std::cout << "Вывести базу?  ";
        if (selectionCheck())
          output(listBase);
        else
          system("CLS");
        std::cout<< "Ключ поиска > ";
        clearBuffer();
        std::cin.getline(keySearch, 30, '\n');
        system("CLS");
        resSearch1 = binarySearch(arr, sizeBase, keySearch);
        if(resSearch1){
          for (tempList = resSearch1; tempList; tempList = tempList->next) {
            addAVL(treeAVL, tempList->data, growth);
          }
          outputTree(treeAVL);
        }

      }
      if (treeAVL){
        std::cout << "Ищем > ";
        std::cin.getline(keySearch, 22, '\n');
        clearBuffer();
        system("CLS");
        delTree(resSearch2);
        resSearch2 = findVertexWithKey(treeAVL, keySearch);
        if (resSearch2) {
          std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
                    << std::endl;
          std::cout << "< По ключу \"" << keySearch << "\" найдена вершина \"" << resSearch2->data << "\" по адресу " << resSearch2 << " >"
                    << std::endl;
          outputDB_Full(resSearch2->elems);
        } else
          std::cout << "< Вершина по ключу \"" << keySearch << "\" не найдена в дереве>" << std::endl;
      }

      pause();
      break;
    }
    }
  } while (choice != '0');
  return 0;
}