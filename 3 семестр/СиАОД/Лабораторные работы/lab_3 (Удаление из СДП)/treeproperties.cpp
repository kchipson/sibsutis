#include "treeproperties.hpp"
#include <iostream>

/* Размер дерева */
int sizeTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The size of the tree: ";
  if (p == NULL)
    return 0;
  else
    return (1 + sizeTree(p->L, 0) + sizeTree(p->R, 0));
}

/* Контрольная сумма дерева */
int checkSumTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The checksum tree: ";
  if (p == NULL)
    return 0;
  else
    return (p->data + checkSumTree(p->L, 0) + checkSumTree(p->R, 0));
}

/* Сумма длин элементов дерева */
int sumOfPathLengths(tree *p, int depth, bool root) {
  if (root)
    std::cout << std::endl
              << "The sum of the lengths of the paths of the tree: ";
  if (p == NULL)
    return 0;
  else
    return (depth + sumOfPathLengths(p->L, depth + 1, 0) +
            sumOfPathLengths(p->R, depth + 1, 0));
}

int maxHeight(int a, int b) {
  if (a < b)
    return b;
  else
    return a;
}

/* Высота дерева */
int heightTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The height tree: ";
  if (p == NULL)
    return 0;
  else
    return (1 + maxHeight(heightTree(p->L, 0), heightTree(p->R, 0)));
}

/* Средняя высота дерева */
float averageHeightTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The average height tree: ";
  return (float(sumOfPathLengths(p, 1, 0)) / sizeTree(p, 0));
}