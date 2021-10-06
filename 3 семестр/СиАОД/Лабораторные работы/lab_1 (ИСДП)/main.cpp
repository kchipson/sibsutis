#include <iostream>
#include <ctime>
#include <windows.h>
#include "treeoutput.hpp"
#include "treeproperties.hpp"
#include "somefunctions.hpp"
#include "treefunctions.hpp"
#include "treegraphics.hpp"
#include "treecreate.hpp"
#include "struct.hpp"

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  srand(time(NULL));
  int n = 100; // не больше 1000, иначе изменить MAX_RAND

  tree *root = createPBST(n);
  outTree_LefttoRight(root, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root, 1);
  std::cout << checkSumTree(root, 1);
  std::cout << heightTree(root, 1);
  std::cout << averageHeightTree(root, 1);
  std::cout << std::endl;

  std::cout << std::endl << "Ищем ? (y/n)" << std::endl;
  if (selectionCheck()) {
    int x;
    tree *res;
    do {
      std::cout << "Что ищем ?   > ";
      std::cin >> x;

      if (res = findVertexWithKey(root, x))
        std::cout << "<вершина найдена по адресу " << res << "> -" << res->data
                  << std::endl;
      else
        std::cout << "<вершины нет в дереве>" << std::endl;
      std::cout << std::endl << "Продолжить поиск ? (y/n)" << std::endl;
    } while (selectionCheck());
    std::cout << std::endl;
  }
  std::cout << std::endl << "Вывести дерево графически ? (y/n)" << std::endl;
  if (selectionCheck()) {
    treeGraphics(root);
  }

  pauseAtTheEnd();
  return 0;
}
