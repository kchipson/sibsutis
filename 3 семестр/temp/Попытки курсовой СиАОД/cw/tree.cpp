#include "tree.hpp"

void rotateRR(tree *&p) {
  tree *q = p->right;
  p->balance = 0;
  q->balance = 0;
  p->right = q->left;
  q->left = p;
  p = q;
}

void rotateLL(tree *&p) {
  tree *q = p->left;
  p->balance = 0;
  q->balance = 0;
  p->left = q->right;
  q->right = p;
  p = q;
}

void rotateLR(tree *&p) {
  tree *q = p->left;
  tree *r = q->right;
  if (r->balance < 0)
    p->balance = 1;
  else
    p->balance = 0;

  if (r->balance > 0)
    q->balance = -1;
  else
    q->balance = 0;

  r->balance = 0;
  q->right = r->left;
  p->left = r->right;
  r->left = q;
  r->right = p;
  p = r;
}

void rotateRL(tree *&p) {
  tree *q = p->right;
  tree *r = q->left;
  if (r->balance > 0)
    p->balance = -1;
  else
    p->balance = 0;

  if (r->balance < 0)
    q->balance = 1;
  else
    q->balance = 0;

  r->balance = 0;
  q->left = r->right;
  p->right = r->left;
  r->right = q;
  r->left = p;
  p = r;
}

void addAVL(tree *&p, itemDataBase data, bool &rost) {
  if (p == nullptr) {
    p = new tree;
    strcpy(p->data, data.lawyer);
    p->elems = new listDataBase;
    p->elems->data = data;
    p->elems->next = nullptr;
    rost = true;
  } else if (comparator(p->data, data.lawyer) == 1) {
    addAVL(p->left, data, rost);
    if (rost) {
      if (p->balance > 0) {
        p->balance = 0;
        rost = false;
      } else if (p->balance == 0) {
        p->balance = -1;
        rost = true;
      } else if ((p->left)->balance < 0) {
        rotateLL(p);
        rost = false;
      } else {
        rotateLR(p);
        rost = false;
      }
    }
  }

  else if (comparator(p->data, data.lawyer) == -1) {
    addAVL(p->right, data, rost);
    if (rost) {
      if (p->balance < 0) {
        p->balance = 0;
        rost = false;
      } else if (p->balance == 0) {
        p->balance = 1;
        rost = true;
      } else if ((p->right)->balance > 0) {
        rotateRR(p);
        rost = false;
      } else {
        rotateRL(p);
        rost = false;
      }
    }
  }

  else {
    listDataBase *q = p->elems;
    while (q->next != nullptr)
      q = q->next;
    q->next = new listDataBase;
    q = q->next;
    q->data = data;
    q->next = nullptr;
    rost = false;
  }
}

/* Поиск вершины по ключу */
tree *findVertexWithKey(tree *p, char *key) {
  tree *q = p;
  while (q != nullptr) {
    if (comparator(key, q->data) == -1)
      q = q->left;
    else if (comparator(key, q->data) == 1)
      q = q->right;
    else
      break;
  }
  return q;
}

/* Вывод слева направо */
void outputTree_LR(tree *p, bool full) {

  if (p != nullptr) {
    outputTree_LR(p->left, full);
    if (full) {
      std::cout << " > " << p->data << std::endl;
      int i = 0;
      listDataBase *temp = p->elems;
      for (temp; temp; temp = temp->next) {
        std::cout << "   ";
        std::cout.setf(std::ios::right);
        std::cout.width(4);
        std::cout << (i + 1) << ")"
                  << "  ";
        printItemDB(temp->data);
        i++;
      }
    } else
      std::cout << " > " << p->data << std::endl;
    outputTree_LR(p->right, full);
  }
}

/* Вывод сверху вниз */
void outputTree_TB(tree *p, bool full) {
  if (p != NULL) {
    std::cout << " > " << p->data << std::endl;
    outputTree_TB(p->left, full);
    outputTree_TB(p->right, full);
  }
}

/* Вывод снизу вверх */
void outputTree_BT(tree *p, bool full) {
  if (p != NULL) {
    outputTree_BT(p->left, full);
    outputTree_BT(p->right, full);
    std::cout << " > " << p->data << std::endl;
  }
}