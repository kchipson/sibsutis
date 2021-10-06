#include "funcOut.hpp"

/* Вывод */
void output(listDataBase* p){
  std::cout << std::endl;
  std::cout << "  1) Page by page" << std::endl;
  std::cout << "  2) All" << std::endl;
  char c;
  do {
    c = getch();
  } while ((c != '1') && (c != '2'));
  std::cout << std::endl;
  if (c == '1')
    outputDB_PbyP(p);
  else
    outputDB_Full(p);
}

void output(itemDataBase** arr,unsigned int size){
  std::cout << std::endl;
  std::cout << "  1) Page by page" << std::endl;
  std::cout << "  2) All" << std::endl;
  char c;
  do {
    c = getch();
  } while ((c != '1') && (c != '2'));
  std::cout << std::endl;
  if (c == '1')
    outputDB_PbyP(arr,size);
  else
    outputDB_Full(arr,size);
}

/* Вывод элемента БД */
void printItemDB(itemDataBase item) {
  std::cout << item.depositor << "   ";
  std::cout.setf(std::ios::left);
  std::cout.width(5);
  std::cout << item.contribution << "   ";
  std::cout << item.date << "     ";
  std::cout << item.lawyer << std::endl;
}

/* Постраничный вывод БД */
void outputDB_PbyP(listDataBase *head) {
  listDataBase *p = head;
  int j = 0;
  int key;
  int i = itemsPage;
  do {
    for (j; (j < i) && (p != nullptr); j++, p = p->next) {
      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(p->data);
    }
    do {
      key = getch();
      switch (key) {
      case 75: // left
        if (j != itemsPage) {
          i = i - itemsPage;
          j = i - itemsPage;
          p = head;
          for (int f = 0; f < j; f++)
            p = p->next;
        } else
          key = 0;
        break;
      case 77: // right
        if (p != nullptr) {
          i = i + itemsPage;
        } else
          key = 0;
        break;
      }
    } while ((key != 75) && (key != 77) && (key != 27));

  } while (key != 27);
}
void outputDB_PbyP(itemDataBase **arr, unsigned int size) {
  int j = 0;
  int key;
  int i = itemsPage;
  do {
    for (j; (j < i) && (j < size); j++) {
      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(*arr[j]);
    }
    do {
      key = getch();
      switch (key) {
      case 75: // left
        if (j != itemsPage) {
          i = i - itemsPage;
          j = i - itemsPage;
        } else
          key = 0;
        break;
      case 77: // right
        if (i < size) {
          i = i + itemsPage;
        } else
          key = 0;
        break;
      }
    } while ((key != 75) && (key != 77) && (key != 27));
  } while (key != 27);
}


/* Полный вывод БД */
void outputDB_Full(listDataBase *p) {
  int i = 0;
  for (p; p; p = p->next) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(p->data);
    i++;
  }
}
void outputDB_Full(itemDataBase **arr, unsigned int size) {
  for (int i = 0; i < size; i++) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(*arr[i]);
  }
}