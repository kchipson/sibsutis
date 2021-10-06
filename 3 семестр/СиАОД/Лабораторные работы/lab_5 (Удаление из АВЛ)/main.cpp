#include <iostream>
#include <ctime>
#include <windows.h>
#include "treeoutput.hpp"
#include "treeproperties.hpp"
#include "somefunctions.hpp"
#include "treefunctions.hpp"
#include "treecreate.hpp"
#include "treegraphics.hpp"
#include "struct.hpp"

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  int seed = time(NULL);
  srand(seed);

  int n = 10; // не больше 1000, иначе изменить MAX_RAND

  bool rost;
  std::cout << "\t***   АВЛ-дерево поиска   ***" << std::endl;
  tree *root = createAVL(n);
  outTree_LefttoRight(root, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root, 1);
  std::cout << checkSumTree(root, 1);
  std::cout << heightTree(root, 1);
  std::cout << averageHeightTree(root, 1);
  std::cout << std::endl << std::endl;
  std::cout << std::endl
            << "Вывести АВЛ-дерево графически ? (y/n)" << std::endl;
  if (selectionCheck()) {
    treeGraphics(root);
  }

  bool decrease;
  std::cout << std::endl << "Удаляем ? (y/n)" << std::endl;
  if (selectionCheck()) {
    int x;
    tree *res;
    do {
      decrease = false;
      std::cout << "Что удаляем ?   > ";
      std::cin >> x;

      if (deleteVertexWithKey(root, x, decrease))
        std::cout << "<вершины со значением \"" << x << "\" нет в дереве>";

      else {
        std::cout << "<вершина со значением \"" << x << "\" удалена>";
        std::cout << std::endl
                  << "Вывести дерево после удаления ? (y/n)" << std::endl;
        if (selectionCheck()) {
          treeGraphics(root);
        }
      }

      outTree_LefttoRight(root, 1);
      std::cout << std::endl << "_____________________";
      std::cout << sizeTree(root, 1);
      std::cout << checkSumTree(root, 1);
      std::cout << heightTree(root, 1);
      std::cout << averageHeightTree(root, 1);
      std::cout << std::endl << std::endl;
      std::cout << std::endl << "Продолжить удаление ? (y/n)" << std::endl;
    } while (selectionCheck());
    std::cout << std::endl;
  }

  pauseAtTheEnd();
  return 0;
}
