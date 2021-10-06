#include "treeoutput.hpp"
#include <iostream>

/* Вывод сверху вниз */
void outTree_ToptoBott(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "▼ : ";
  if (p != nullptr) {
    std::cout << p->data << "; ";
    outTree_ToptoBott(p->left, 0);
    outTree_ToptoBott(p->right, 0);
  }
}

/* Вывод слева направо */
void outTree_LefttoRight(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "> : ";
  if (p != nullptr) {
    outTree_LefttoRight(p->left, 0);
    std::cout << p->data << "; ";
    outTree_LefttoRight(p->right, 0);
  }
}

/* Вывод снизу вверх */
void outTree_BotttoTop(tree *p, bool root ) {
  if (root)
    std::cout << std::endl << "▲ : ";
  if (p != nullptr) {
    outTree_BotttoTop(p->left, 0);
    outTree_BotttoTop(p->right, 0);
    std::cout << p->data << "; ";
  }
}