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
  std::cout << time(NULL) << std::endl;
  int n = 100; // не больше 1000, иначе изменить MAX_RAND
  tree *root1 = createPBST(n);
  srand(time(NULL) + 1);
  tree *root2 = createRST_DI(n);
  table(root1, root2, n);

  std::cout << "\t***   Идеально сбалансированное дерево поиска   ***";

  outTree_LefttoRight(root1, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root1, 1);
  std::cout << checkSumTree(root1, 1);
  std::cout << heightTree(root1, 1);
  std::cout << averageHeightTree(root1, 1);
  std::cout << std::endl << std::endl;

  std::cout << "\t***   Случайное дерево поиска (двойная косвенность)   ***:"
            << std::endl;

  outTree_LefttoRight(root2, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root2, 1);
  std::cout << checkSumTree(root2, 1);
  std::cout << heightTree(root2, 1);
  std::cout << averageHeightTree(root2, 1);
  std::cout << std::endl << std::endl;

  std::cout << "\t***   Случайное дерево поиска (рекурсивно)   ***:"
            << std::endl;
  srand(time(NULL) + 1);

  tree *root3 = createRST_R(n);

  outTree_LefttoRight(root3, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root3, 1);
  std::cout << checkSumTree(root3, 1);
  std::cout << heightTree(root3, 1);
  std::cout << averageHeightTree(root3, 1);
  std::cout << std::endl;

  std::cout << std::endl << "Ищем ? (y/n)" << std::endl;
  if (selectionCheck()) {
    int x;
    tree *res;
    do {
      std::cout << "Что ищем ?   > ";
      std::cin >> x;
      res = findVertexWithKey(root1, x);
      if (res)
        std::cout << "<вершина найдена по адресу " << res
                  << " в ИСДП>: " << res->data << std::endl;
      else
        std::cout << "<вершины нет в ИСДП>" << std::endl;
      res = findVertexWithKey(root2, x);
      if (res)
        std::cout << "<вершина найдена по адресу " << res
                  << " в СДП: " << res->data << std::endl;
      else
        std::cout << "<вершины нет в СДП>" << std::endl;
      std::cout << std::endl << "Продолжить поиск ? (y/n)" << std::endl;
    } while (selectionCheck());
    std::cout << std::endl;
  }
  std::cout << std::endl << "Вывести ИСДП графически ? (y/n)" << std::endl;
  if (selectionCheck()) {
    treeGraphics(root1);
  }

  std::cout << std::endl << "Вывести СДП графически ? (y/n)" << std::endl;
  if (selectionCheck()) {
    treeGraphics(root2, 100000, 2.0F);
  }
  pauseAtTheEnd();
  return 0;
}
