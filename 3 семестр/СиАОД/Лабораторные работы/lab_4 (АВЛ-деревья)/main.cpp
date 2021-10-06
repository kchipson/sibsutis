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
  int n = 25; // не больше 1000, иначе изменить MAX_RAND

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

  /*addAVL(root, 14, rost); // м
  addAVL(root, 10, rost); // и
  addAVL(root, 18, rost); // р
  addAVL(root, 16, rost); // о
  addAVL(root, 15, rost); // н (LL)
  addAVL(root, 6, rost);  // е
  addAVL(root, 12, rost); // к
  addAVL(root, 13, rost); // л
  addAVL(root, 1, rost);  // а
  addAVL(root, 5, rost);  // д (LR)
  addAVL(root, 3, rost);  // в (LL)
  addAVL(root, 25, rost); // ч*/

  std::cout << std::endl << "Добавляем ? (y/n)" << std::endl;
  int x;
  while (selectionCheck()) {

    std::cout << "Что добавляем ?   > ";
    std::cin >> x;
    if (addAVL(root, x, rost)) {

      std::cout << "<вершина со значением \"" << x << "\" добавлена>";
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
    } else
      std::cout << " /* Данные с ключом \"" << x << "\" уже есть в дереве */"
                << std::endl;

    std::cout << std::endl << "Продолжить добавление ? (y/n)" << std::endl;
  };
  std::cout << std::endl;

  system("CLS");
  srand(seed);
  std::cout << "\t***   АВЛ-дерево поиска (" << n * 4 << ")   ***" << std::endl;
  tree *root1 = createAVL(n * 4);
  outTree_LefttoRight(root1, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root1, 1);
  std::cout << checkSumTree(root1, 1);
  std::cout << heightTree(root1, 1);
  std::cout << averageHeightTree(root1, 1);
  std::cout << std::endl << std::endl;

  srand(seed);
  std::cout << "\t***   Случайное дерево поиска (" << n * 4 << ")   ***"
            << std::endl;
  tree *root2 = createRST_R(n * 4);
  outTree_LefttoRight(root2, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(root2, 1);
  std::cout << checkSumTree(root2, 1);
  std::cout << heightTree(root2, 1);
  std::cout << averageHeightTree(root2, 1);
  std::cout << std::endl << std::endl;

  // table(root1, root2, n * 4);

  for (int i = 0; i < 3; i++) {
    srand(seed + i);
    root1 = createAVL(n * 4);

    root2 = NULL;
    table(root1, root2, n * 4);
  }
  pauseAtTheEnd();
  return 0;
}
