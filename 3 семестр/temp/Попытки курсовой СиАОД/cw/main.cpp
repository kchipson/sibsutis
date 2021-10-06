#include <iostream>
#include <fstream>

#include "struct.hpp"
#include "functions.hpp"
#include "tree.hpp"

int main(int argc, char const *argv[]) {
  // SetConsoleOutputCP(65001);
  // SetConsoleCP(65001);
  // TODO: Как сделать кириллицу?!?!?!?!?!?!?!?!

  /* Константы */
  const unsigned short int itemsPage = 30; // Кол-во записей на странице

  /* Переменные */
  unsigned short int sizeBase = 0; // Кол-во записей в БД
  listDataBase *dataBase;
  char keySearch[30];
  itemDataBase **dataBaseSort;
  tree *treeAVL = nullptr;

  /* Временные переменные */
  listDataBase *p, *t;
  std::fstream *file = new std::fstream;
  itemDataBase *data = new itemDataBase;
  unsigned short int i;
  bool rost;

  /* Чтение из файла БД */
  (*file).open("DataBase.dat", std::ios::in | std::ios::binary);
  if (!(*file))
    return 1;
  dataBase = p = new listDataBase;
  (*file).read((char *)data, sizeof(*data)).eof();
  p->data = *data;
  sizeBase++;
  while (!(*file).read((char *)data, sizeof(*data)).eof()) {
    p->next = new listDataBase;
    p = p->next;
    p->data = *data;
    sizeBase++;
  }
  p->next = nullptr;
  (*file).close();
  // delete p; // ОАЛАОАОАОАОАОАОАО А_А_А_А_А_А_А_А_А_А_А_А_А_А_А_А
  delete file;
  delete data;

  /* Вывод исходной БД */
  std::cout << "Display the source database:" << std::endl;
  switch (choiceOutput()) {
  case 0:
    outputDB_PbyP(dataBase, itemsPage);
    break;
  case 1:
    outputDB_Full(dataBase);
    break;
  }

  /* Сортировка БД */
  digitalSort(dataBase);

  /* Массив адресов по отстортированной БД*/
  dataBaseSort = new itemDataBase *[sizeBase] { nullptr };
  for (p = dataBase, i = 0; p != nullptr; p = p->next, i++)
    dataBaseSort[i] = &(p->data);

  /* Вывод отсортированной БД */
  std::cout << std::endl
            << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
               "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
  std::cout << std::endl << "Display a sorted database:" << std::endl;
  switch (choiceOutput()) {
  case 0:
    outputDB_PbyP(dataBaseSort, sizeBase, itemsPage);
    break;
  case 1:
    outputDB_Full(dataBaseSort, sizeBase);
    break;
  }

  /* Бинарный поиск с формированием очереди и ее выводом */

  p = nullptr;
  std::cout << std::endl
            << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
               "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
  std::cout << std::endl
            << "                            Binary search in the list";
  std::cout << std::endl
            << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
               "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
  std::cout << std::endl << "Are you looking for? (y/n)" << std::endl;
  if (selectionCheck()) {
    do {
      std::cout << "Search: ";
      for (p; p != nullptr; p = t) {
        t = p->next;
        delete p;
      }
      std::cin.getline(keySearch, 30, '\n');
      if (std::cin.fail()) {
        std::cin.clear();
        while (std::cin.get() != '\n')
          ;
      }
  
      if (p = binarySearch(dataBaseSort, sizeBase, keySearch))
        outputDB_Full(p);
      else
        std::cout
            << std::endl
            << "< No values were found for the given key in the database >"
            << std::endl;
      std::cout << std::endl
                << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
                << std::endl;
      std::cout
          << std::endl
          << "Finish the search? (y/n)\n /* The last queue will be saved! */"
          << std::endl;
    } while (!selectionCheck());
  }
  std::cout << std::endl;

  if (p != nullptr) {
    /* Дерево на основе бинарного поиска по ключу lawyer(адвокат) */
    for (p; p; p = p->next) {
      addAVL(treeAVL, p->data, rost);
    }
    /* Вывод дерева */
    std::cout << std::endl
              << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
                 "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
    std::cout << std::endl << "Display the tree:" << std::endl;
    std::cout << "  1) Only the key" << std::endl;
    std::cout << "  2) Full tree traversal" << std::endl;
    int c;
    do {
      c = getch();
      c = c - 49;
    } while ((c != 0) && (c != 1));

    std::cout << std::endl
              << "Tree of lawyers from the created queue (Left to right):"
              << std::endl
              << std::endl;
    outputTree_LR(treeAVL, c);

    /* Поиск в дереве по ключу */
    std::cout << std::endl
              << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
                 "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
    std::cout << std::endl << "                      Binary tree search";
    std::cout << std::endl
              << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"
                 "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
    std::cout << std::endl << "Are you looking for? (y/n)" << std::endl;
    tree *res;
    while (selectionCheck()) {
      std::cout << "What are we looking for?  > ";
      std::cin.getline(keySearch, 22, '\n');
      if (std::cin.fail()) {
        std::cin.clear();
        while (std::cin.get() != '\n')
          ;
      }

      res = findVertexWithKey(treeAVL, keySearch);
      if (res) {
        std::cout << "< vertex found at " << res << " in AVL-tree> - "
                  << res->data << std::endl;
        outputDB_Full(res->elems);
      } else
        std::cout << "< vertex not in AVL-tree >" << std::endl;

      std::cout << std::endl << "To repeat the search ? (y/n)" << std::endl;
    }
    std::cout << std::endl;
  }

  std::cout << std::endl
            << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
               "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+";
  pauseAtTheEnd();

  return 0;
}

// FIXME: не работает бин. поиск при ключе с пробелом
//          - например, при: "Янов Х"