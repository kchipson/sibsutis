#include <conio.h>
#include <iostream>
#include "struct.hpp"
#include "treeproperties.hpp"

/* Да | Нет */
int selectionCheck() {
  bool flag = true;
  int key;
  do {
    flag = false;
    key = getch();
    if ((key == 110) || key == (78)) // n|N
      return 0;
    else if ((key == 121) || key == (89)) // y|Y
      return 1;
    else if ((key == 208) || key == (209)) { // rus
      key = getch();
      if ((key == 157) || key == (189)) // н|Н
        return 1;
      else if ((key == 162) || key == (130)) // т|Т
        return 0;
      else
        flag = true;
    } else
      flag = true;
  } while (flag);
  return 0;
}

/* Пауза в конце программы */
void pauseAtTheEnd() {
  std::cout << std::endl << std::endl << "Press any key to close window!";
  getch();
}

void table(tree *PBST, tree *RST, int n) {
  std::cout << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
  std::cout << "┊ n=";
  std::cout.width(6);
  std::cout << n;
  std::cout << " ┊    Размер    ┊    Контр. сумма    ┊    Высота    ┊   "
               "Средн.высота   ┊"
            << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
  std::cout << "┊   ИСДП   ┊ ";
  std::cout.width(12);
  std::cout << sizeTree(PBST, false);
  std::cout << " ┊ ";
  std::cout.width(18);
  std::cout << checkSumTree(PBST, false);
  std::cout << " ┊ ";
  std::cout.width(12);
  std::cout << heightTree(PBST, false);
  std::cout << " ┊ ";
  std::cout.width(16);
  std::cout << averageHeightTree(PBST, false);
  std::cout << " ┊" << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
  std::cout << "┊   СДП    ┊ ";
  std::cout.width(12);
  std::cout << sizeTree(RST, false);
  std::cout << " ┊ ";
  std::cout.width(18);
  std::cout << checkSumTree(RST, false);
  std::cout << " ┊ ";
  std::cout.width(12);
  std::cout << heightTree(RST, false);
  std::cout << " ┊ ";
  std::cout.width(16);
  std::cout << averageHeightTree(RST, false);
  std::cout << " ┊" << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
}
