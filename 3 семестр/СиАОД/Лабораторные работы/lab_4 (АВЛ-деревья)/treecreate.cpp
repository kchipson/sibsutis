#include "treecreate.hpp"
#include <iostream>
#include <ctime>
#include <conio.h>

tree *createAVL(int n, bool log) {
  tree *root = NULL;
  int i = 0;
  bool rost;
  while (i < n) {
    int data = rand() % MAX_RAND;

    if (addAVL(root, data, rost))
      i++;
    else if (log)
      std::cout << " /* Данные с ключом \"" << data << "\" уже есть в дереве */"
                << std::endl;
  }
  return root;
}

void rotateRR(tree *&p) {
  // std::cout << std::endl << "RR" << std::endl;
  tree *q = p->R;
  p->balance = 0;
  q->balance = 0;
  p->R = q->L;
  q->L = p;
  p = q;
}

void rotateLR(tree *&p) {
  // std::cout << std::endl << "LR" << std::endl;
  tree *q = p->L;
  tree *r = q->R;
  if (r->balance < 0)
    p->balance = 1;
  else
    p->balance = 0;

  if (r->balance > 0)
    q->balance = -1;
  else
    q->balance = 0;

  r->balance = 0;
  q->R = r->L;
  p->L = r->R;
  r->L = q;
  r->R = p;
  p = r;
}

void rotateRL(tree *&p) {
  // std::cout << std::endl << "RL" << std::endl;
  tree *q = p->R;
  tree *r = q->L;
  if (r->balance > 0)
    p->balance = -1;
  else
    p->balance = 0;

  if (r->balance < 0)
    q->balance = 1;
  else
    q->balance = 0;

  r->balance = 0;
  q->L = r->R;
  p->R = r->L;
  r->R = q;
  r->L = p;
  p = r;
}

bool addAVL(tree *&p, int data, bool &rost) {
  if (p == NULL) {
    p = new tree;
    p->data = data;
    rost = true;
  } else if (p->data > data) {
    if (addAVL(p->L, data, rost)) {
      if (rost) {
        if (p->balance > 0) {
          p->balance = 0;
          rost = false;
        } else if (p->balance == 0) {
          p->balance = -1;
          rost = true;
        } else if ((p->L)->balance < 0) {
          rotateLL(p);
          rost = false;
        } else {
          rotateLR(p);
          rost = false;
        }
      }
    } else {
      return false;
    }
  }

  else if (p->data < data) {
    if (addAVL(p->R, data, rost)) {
      if (rost) {
        if (p->balance < 0) {
          p->balance = 0;
          rost = false;
        } else if (p->balance == 0) {
          p->balance = 1;
          rost = true;
        } else if ((p->R)->balance > 0) {
          rotateRR(p);
          rost = false;
        } else {
          rotateRL(p);
          rost = false;
        }
      }
    } else {
      return false;
    }
  } else
    return false;
  return true;
}

// bool addAVL(tree *&p, int data, bool &rost) {
//   if (p == NULL) {
//     p = new tree;
//     p->data = data;
//     rost = true;
//   } else if (p->data > data) {
//     if (addAVL(p->L, data, rost)) {
//       if (rost) {
//         if (p->balance > 0) {
//           p->balance = 0;
//           rost = false;
//         } else {
//           if (p->balance == 0) {
//             p->balance = -1;
//             rost = true;
//           } else {
//             if ((p->L)->balance < 0)
//               rotateLL(p);
//             else
//               rotateLR(p);
//             rost = false;
//           }
//         }
//       }
//     } else
//       return false;
//   } else if (p->data < data) {
//     if (addAVL(p->R, data, rost)) {
//       if (rost) {
//         if (p->balance < 0) {
//           p->balance = 0;
//           rost = false;
//         } else {
//           if (p->balance == 0) {
//             p->balance = 1;
//             rost = true;
//           } else {
//             if ((p->R)->balance > 0)
//               rotateRR(p);
//             else
//               rotateRL(p);
//             rost = false;
//           }
//         }
//       }
//     } else
//       return false;
//   } else
//     return false;
//   return true;

//   // if (p == NULL) {
//   //   p = new tree;
//   //   p->data = data;
//   //   rost = true;

//   // } else if (p->data > data) {
//   //   if (addAVL(p->L, data, rost)) {
//   //     if (rost) {
//   //       if (p->balance > 0) {
//   //         p->balance = 0;
//   //         rost = false;
//   //       } else if (p->balance == 0) {
//   //         p->balance = -1;
//   //         rost = true;
//   //       } else {
//   //         if (p->balance < 0) {
//   //           rotateLL(p);
//   //           rost = false;
//   //         } else {
//   //           rotateLR(p);
//   //           rost = false;
//   //         }
//   //       }
//   //     }
//   //   } else
//   //     return false;
//   // } else if (p->data < data) {
//   //   if (addAVL(p->R, data, rost)) {
//   //     if (rost) {
//   //       if (p->balance < 0) {
//   //         p->balance = 0;
//   //         rost = false;
//   //       } else if (p->balance == 0) {
//   //         p->balance = 1;
//   //         rost = true;
//   //       } else {
//   //         if (p->R->balance > 0) {
//   //           rotateRR(p);
//   //           rost = false;
//   //         } else {
//   //           rotateRL(p);
//   //           rost = false;
//   //         }
//   //       }
//   //     }
//   //   } else
//   //     return false;
//   // } else {
//   //   return false;
//   // }

//   // return true;
// }

void rotateLL(tree *&p) {
  // std::cout << std::endl << "LL" << std::endl;
  tree *q = p->L;
  p->balance = 0;
  q->balance = 0;
  p->L = q->R;
  q->R = p;
  p = q;
}

/* Добавление элемента в случайное дерево поиска (рекурсия (recursive)) */
bool addRST_R(tree *&p, int data) {
  bool lol = true;
  if (p == NULL) {
    p = new tree;
    p->data = data;
  } else if (data < p->data)
    lol = addRST_R(p->L, data);
  else if (data > p->data)
    lol = addRST_R(p->R, data);
  else
    lol = false;
  return lol;
}

tree *createRST_R(int n, bool log) {
  tree *root = NULL;
  int i = 0;
  while (i < n) {
    int data = rand() % MAX_RAND;
    if (addRST_R(root, data))
      i++;
    else if (log)
      std::cout << "\t\t /* Данные с ключом \"" << data
                << "\" уже есть в дереве */" << std::endl;
  }
  return root;
}