#include <iostream>
#include <ctime>
#include <windows.h>
#include <conio.h>
#include "treeoutput.hpp"
#include "treeproperties.hpp"
#include "somefunctions.hpp"
#include "treecreate.hpp"
#include "struct.hpp"

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));
  tree *root;
  int x;
  std::cout << "Создание списка:" << std::endl;
  std::cout << " 1) Task" << std::endl;
  std::cout << " 2) ManualControl" << std::endl;
  x = getch() - 48;
  std::cout << x << " ";
  if (x == 1)
    createTree(root);
  else if (x == 2)
    createTreeManualControl(root);
  else
    return 1;
  outTree_ToptoBott(root, 1);
  outTree_LefttoRight(root, 1);
  outTree_BotttoTop(root, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root, 1);
  std::cout << heightTree(root, 1);
  std::cout << "*/" << sumOfPathLengths(root, 1, 1);
  std::cout << averageHeightTree(root, 1);
  std::cout << checkSumTree(root, 1);
  std::cout << std::endl;

  pauseAtTheEnd();
  return 0;
}
