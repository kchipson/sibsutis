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

/* Удаление вершины по ключу */
bool deleteVertexWithKey(tree *&root, int key) {
  tree **p = &root;
  while (*p != NULL) {
    if ((*p)->data < key)
      p = (&((*p)->R));
    else if ((*p)->data > key)
      p = (&((*p)->L));
    else
      break;
  }
  if (*p != NULL) {
    tree *q = *p;
    if (q->L == NULL)
      *p = q->R;
    else if (q->R == NULL)
      *p = q->L;
    else { // 2 поддерева
      tree *r = q->L;
      tree *s = q;
      if (r->R == NULL) {
        r->R = q->R;
        *p = r;
      } else {
        while (r->R != NULL) {
          s = r;
          r = r->R;
        }
        s->R = r->L;
        r->L = q->L;
        r->R = q->R;
        *p = r;
      }
    }
    delete (q);
  } else
    return false;
  return true;
}

// p := @Root
// 	DO (*p ≠ NIL)
// 		IF ((*p)→Data < X) p := @((*p)→Right)
// 		ELSEIF ((*p)→Data > X) p := @((*p)→Left)
// 		ELSE  OD
// 		FI
// 	OD
// 	IF (*p ≠ NIL)
// 		q := *p
//    IF (q→Left = NIL) *p := q→Right
// 		ELSEIF (q→Right = NIL) *p :=q→Left
// 		ELSE r := q→Left, s := q
// 		DO (r→Right ≠ NIL)
// 			s := r, r := r→Right
// 		OD
// 		s→Right := r→Left           1)
// 		r→Left := q→Left             2)
// 		r→Right := q→Right         3)
// 		*p := r                                     4)
// 		FI
// 	dispose(q)
// FI
