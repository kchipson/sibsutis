#include "treefunctions.hpp"

void rotateLL1(tree *&p, bool &decrease) {
  tree *q = p->L;

  if (q->balance == 0) {
    p->balance = -1;
    q->balance = 1;
    decrease = false;
  } else {
    p->balance = 0;
    q->balance = 0;
  }
  p->L = q->R;
  q->R = p;
  p = q;
}
void rotateRR1(tree *&p, bool &decrease) {
  tree *q = p->R;
  if (q->balance == 0) {
    p->balance = 1;
    q->balance = -1;
    decrease = false;
  } else {
    p->balance = 0;
    q->balance = 0;
  }
  p->R = q->L;
  q->L = p;
  p = q;
}

void rotateLR1(tree *&p) {
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
void rotateRL1(tree *&p) {
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

void BL(tree *&p, bool &decrease) {
  if (p->balance == -1)
    p->balance = 0;
  else if (p->balance == 0) {
    p->balance = 1;
    decrease = false;
  } else if (p->balance == 1) {
    if (p->R->balance >= 0)
      rotateRR1(p, decrease);
    else
      rotateRL1(p);
  }
}
void BR(tree *&p, bool &decrease) {
  if (p->balance == 1)
    p->balance = 0;
  else if (p->balance == 0) {
    p->balance = -1;
    decrease = false;
  } else if (p->balance == -1) {
    if (p->L->balance <= 0)
      rotateLL1(p, decrease);
    else
      rotateLR1(p);
  }
}

void del(tree *&r, tree *&q, bool &decrease) {
  if (r->R != NULL) {
    del(r->R, q, decrease);
    if (decrease)
      BR(r, decrease);
  } else {
    q->data = r->data;
    q = r;
    r = r->L;
    decrease = true;
  }
}

/* Удаление вершины по ключу */
bool deleteVertexWithKey(tree *&p, int x, bool &decrease) {
  tree *q = NULL;
  if (p == NULL)
    return 1;
  else if (p->data > x) {
    if (deleteVertexWithKey(p->L, x, decrease))
      return 1;
    if (decrease)
      BL(p, decrease);
  } else if (p->data < x) {
    if (deleteVertexWithKey(p->R, x, decrease))
      return 1;
    if (decrease)
      BR(p, decrease);
  } else {
    q = p;
    if (q->R == NULL) {
      p = q->L;
      decrease = true;
    } else if (q->L == NULL) {
      p = q->R;
      decrease = true;
    } else {
      del(q->L, q, decrease);
      if (decrease)
        BL(p, decrease);
    }
  }
  delete (q);
  return 0;
}
