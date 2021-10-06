#include "funcOut.hpp"

#include <cmath>

/* Вывод элемента БД */
void printItemDB(itemDataBase item) {
  std::cout << item.depositor << "   ";
  std::cout.setf(std::ios::left);
  std::cout.width(5);
  std::cout << item.contribution << "   ";
  std::cout << item.date << "     ";
  std::cout << item.lawyer << "\n";
}

/* Вывод */
void output(listDataBase* p){
  std::cout << "  1) Постранично\n";
  std::cout << "  2) Вся база\n";
  char c;
  do {
    c = (char)getch();
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
              << "\n"
              << " < Список пуст >"
              << "\n"
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << "\n";
    return;
  }
  listDataBase *p = head;
  int j = 0;
  int key;
  int i = itemsPage;
  do {
    system("CLS");
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+\n";
    for (; (j < i) && (p != nullptr); j++, p = p->next) {
      std::cout.setf(std::ios::right);
      std::cout.width(4);
      std::cout << (j + 1) << ")"
                << "  ";
      printItemDB(p->data);
    }
    std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+\n";
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
              << "\n"
              << " < Список пуст >"
              << "\n"
              << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+"
              << "\n";
    return;
  }
   std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+\n";
  int i = 0;
  for (; p; p = p->next) {
    std::cout.setf(std::ios::right);
    std::cout.width(4);
    std::cout << (i + 1) << ")"
              << "  ";
    printItemDB(p->data);
    i++;

    if(kbhit()){
      std::cout  << "\nContinue?\n";
      if (!(selectionCheck()))
        break;
    }
  }
  std::cout << "-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+\n";
}
/* Вывод дерева */
void outputTree(treeLawyer *p){
  std::cout << "  1) Только ключи\n";
  std::cout << "  2) Всё дерево\n";
  char c;
  do {
    c = (char)getch();
  } while ((c != '1') && (c != '2'));
//  system("CLS");
  outputTree_LR(p, c != '1');
}

/* Вывод слева направо */
void outputTree_LR(treeLawyer *p, bool full) {
  if (p != nullptr) {
    outputTree_LR(p->left, full);
    if (full) {
      std::cout << " > " << p->data << "\n";
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
      std::cout << " > " << p->data << "\n";
    outputTree_LR(p->right, full);
  }
}

void printTableSymbols(coding *code, int numSymbols){
  system("CLS");
  std::cout << "╔═══════════╦══════════════════╦══════════════════════════╦══════════════════════════╦════════════════════════════════╗" << "\n";
  std::cout << "║" << std::setw(11) << "" << "║" << std::setw(18) << "" << "║" << std::setw(26) << "" << "║" << std::setw(26) << "" << "║" << std::setw(32) << "" << "║" << "\n";
  std::cout << "║" << "Код символа" << "║" << " Кол-во в тексте  " << "║" << "   Вероятность в тексте   " << "║" << "   Длина кодового слова   " << "║" << "          Кодовое слово         " << "║" << "\n";
  std::cout << "║" << std::setw(11) << "" << "║" << std::setw(18) << "" << "║" << std::setw(26) << "" << "║" << std::setw(26) << "" << "║" << std::setw(32) << "" << "║" << "\n";
  std::cout << "╠═══════════╬══════════════════╬══════════════════════════╬══════════════════════════╬════════════════════════════════╣" << "\n";

  float entropy = 0;
  float averageLength = 0;
  for (int i = 0; i < numSymbols; i++) {
    entropy += code[i].probability * std::log2(code[i].probability);
    averageLength += (float)code[i].lengthCW * code[i].probability;
    std::cout << "║"
              << std::setw(7) << (int)(unsigned char)code[i].symbol << std::setw(4) << "" << "║"
              << std::setw(15) << code[i].quantity  << std::setw(3) << "" << "║"
              << std::setw(23) << std::fixed << code[i].probability << std::setw(3) << "" << "║"
              << std::setw(23) << code[i].lengthCW << std::setw(3) << "" << "║"
              << std::setw(29) << code[i].codeword << std::setw(3) << "" << "║" << "\n";
  }
  std::cout << "╚═══════════╩══════════════════╩══════════════════════════╩══════════════════════════╩════════════════════════════════╝" << "\n";

  std::cout << "  Энтропия: " << -entropy << "\n";
  std::cout << "  Средняя длина код. слова: " << averageLength << "\n";

}