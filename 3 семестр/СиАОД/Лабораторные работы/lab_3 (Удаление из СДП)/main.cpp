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
  int n = 12; // не больше 1000, иначе изменить MAX_RAND

  std::cout << "\t***   Случайное дерево поиска (двойная косвенность)   ***:"
            << std::endl;

  srand(time(NULL));
  tree *root1 = createRST_DI(n);
  outTree_LefttoRight(root1, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root1, 1);
  std::cout << checkSumTree(root1, 1);
  std::cout << heightTree(root1, 1);
  std::cout << averageHeightTree(root1, 1);
  std::cout << std::endl << std::endl;

  // std::cout << std::endl
  //           << "Вывести начальное СДП графически ? (y/n)" << std::endl;
  // if (selectionCheck()) {
  //   treeGraphics(root1);
  // }

  std::cout << std::endl << "Удаляем ? (y/n)" << std::endl;
  if (selectionCheck()) {
    int x;
    tree *res;
    do {
      std::cout << "Что удаляем ?   > ";
      std::cin >> x;
      if (deleteVertexWithKey(root1, x)) {

        std::cout << "<вершина со значением \"" << x << "\" удалена>";
        outTree_LefttoRight(root1, 1);
        std::cout << std::endl << "_____________________";
        std::cout << sizeTree(root1, 1);
        std::cout << checkSumTree(root1, 1);
        std::cout << heightTree(root1, 1);
        std::cout << averageHeightTree(root1, 1);
        std::cout << std::endl << std::endl;

      } else
        std::cout << "<вершины нет в СДП>" << std::endl;

      std::cout << std::endl << "Продолжить удаление ? (y/n)" << std::endl;
    } while (selectionCheck());
    std::cout << std::endl;
  }

  pauseAtTheEnd();
  return 0;
}
