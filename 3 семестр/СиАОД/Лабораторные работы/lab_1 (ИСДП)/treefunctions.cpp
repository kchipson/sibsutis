#include "treefunctions.hpp"

/* Поиск вершины по ключу */
tree *findVertexWithKey(tree *p, int key) {
  tree *q = p;
  while (q != NULL) {
    if (key < q->data)
      q = q->L;
    else if (key > q->data)
      q = q->R;
    else
      break;
  }
  if (q != NULL)
    return q;
  else
    return NULL;
}

// p := Root
// DO (p != NULL)
//      IF (X < p->Data)  p := p->Left
//      ELSE  IF (X > p->Data)  p := p->Right
//                ELSE  OD
// 	     FI
//      FI
// OD
// IF (p != NULL) <вершина найдена по адресу р>
// ELSE   <вершины нет дереве>
// FI
