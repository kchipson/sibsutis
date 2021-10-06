
#include "somefunctions.hpp"

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

void table(treeAVL *AVL, tree *DBD, int n) {
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
  std::cout << "┊   АВЛ    ┊ ";
  std::cout.width(12);
  std::cout << sizeTree(AVL, false);
  std::cout << " ┊ ";
  std::cout.width(18);
  std::cout << checkSumTree(AVL, false);
  std::cout << " ┊ ";
  std::cout.width(12);
  std::cout << heightTree(AVL, false);
  std::cout << " ┊ ";
  std::cout.width(16);
  std::cout << averageHeightTree(AVL, false);
  std::cout << " ┊" << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
  std::cout << "┊   ДБД    ┊ ";
  std::cout.width(12);
  std::cout << sizeTree(DBD, false);
  std::cout << " ┊ ";
  std::cout.width(18);
  std::cout << checkSumTree(DBD, false);
  std::cout << " ┊ ";
  std::cout.width(12);
  std::cout << heightTree(DBD, false);
  std::cout << " ┊ ";
  std::cout.width(16);
  std::cout << averageHeightTree(DBD, false);
  std::cout << " ┊" << std::endl;
  std::cout
      << " -------------------------------------------------------------------"
         "-------------"
      << std::endl;
}
