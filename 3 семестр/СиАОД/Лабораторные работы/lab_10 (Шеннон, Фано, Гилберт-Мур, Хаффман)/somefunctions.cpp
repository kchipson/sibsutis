#include "somefunctions.hpp"

/* �� | ��� */
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
      if ((key == 157) || key == (189)) // �|�
        return 1;
      else if ((key == 162) || key == (130)) // �|�
        return 0;
      else
        flag = true;
    } else
      flag = true;
  } while (flag);
  return 0;
}

/* ����� � ����� ��������� */
void pauseAtTheEnd() {
  std::cout << "\n\n" << "Press any key to close window!";
  getch();
}
