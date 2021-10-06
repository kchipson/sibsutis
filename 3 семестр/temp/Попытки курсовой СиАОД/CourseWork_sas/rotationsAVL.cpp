#include "rotationsAVL.hpp"

void rotateRR(treeLawyer *&p) {
  treeLawyer *q = p->right;
  p->balance = 0;
  q->balance = 0;
  p->right = q->left;
  q->left = p;
  p = q;
}

void rotateLL(treeLawyer *&p) {
  treeLawyer *q = p->left;
  p->balance = 0;
  q->balance = 0;
  p->left = q->right;
  q->right = p;
  p = q;
}

void rotateLR(treeLawyer *&p) {
  treeLawyer *q = p->left;
  treeLawyer *r = q->right;
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

void rotateRL(treeLawyer *&p) {
  treeLawyer *q = p->right;
  treeLawyer *r = q->left;
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