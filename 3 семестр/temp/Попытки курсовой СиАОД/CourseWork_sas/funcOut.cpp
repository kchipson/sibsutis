#include "funcOut.hpp"

/* Вывод элемента БД */
void printItemDB(itemDataBase item) {
  std::cout << item.depositor << "   ";
  std::cout.setf(std::ios::left);
  std::cout.width(5);
  std::cout << item.contribution << "   ";
  std::cout << item.date << "     ";
  std::cout << item.lawyer << std::endl;
}

/* Вывод */
void output(listDataBase* p){
  std::cout << "  1) Постранично" << std::endl;
  std::cout << "  2) Вся база" << std::endl;
  char c;
  do {
    c = getch();
  } while ((c != '1') && (c != '2'));
  system("CLS");
  if (c == '1')
    outputDB_PbyP(p);
  else
    outputDB_Full(p);
}

/* Постраничный вывод БД */
void outputDB_PbyP(listDataBase *head) {
  if (head == nullptr){
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl
              << " < Список пуст >"
              << std::endl
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl;
    return;
  }
  listDataBase *p = head;
  int j = 0;
  int key;
  int i = itemsPage;
  do {
    system("CLS");
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl;
    for (; (j < i) && (p != nullptr); j++, p = p->next) {
      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(p->data);
    }
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl;
    do {
      switch (key = getch()) {
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

/* Полный вывод БД */
void outputDB_Full(listDataBase *p) {
  if (p == nullptr){
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl
              << " < Список пуст >"
              << std::endl
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << std::endl;
    return;
  }
   std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
            << std::endl;
  int i = 0;
  for (; p; p = p->next) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(p->data);
    i++;

    if(kbhit()){
      std::cout << std::endl << "Continue? " << std::endl;
      if (!(selectionCheck()))
        break;
    }
  }
  std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
            << std::endl;
}
/* Вывод дерева */
void outputTree(treeLawyer *p){
  std::cout << "  1) Только ключи" << std::endl;
  std::cout << "  2) Всё дерево" << std::endl;
  char c;
  do {
    c = getch();
  } while ((c != '1') && (c != '2'));
//  system("CLS");
  outputTree_LR(p, c != '1');
}

/* Вывод слева направо */
void outputTree_LR(treeLawyer *p, bool full) {
  if (p != nullptr) {
    outputTree_LR(p->left, full);
    if (full) {
      std::cout << " > " << p->data << std::endl;
      int i = 0;
      for (listDataBase *temp = p->elems; temp; temp = temp->next) {
        std::cout << "   ";
        std::cout.setf(std::ios::right);
        std::cout.width(4);
        std::cout << (i + 1) << ")"
                  << "  ";
        printItemDB(temp->data);
        i++;
      }
    } else
      std::cout << " > " << p->data << std::endl;
    outputTree_LR(p->right, full);
  }
}