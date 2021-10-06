#include "treecreate.hpp"
#include <iostream>
#include <ctime>

void rotateRR(treeAVL *&p) {
  treeAVL *q = p->R;
  p->balance = 0;
  q->balance = 0;
  p->R = q->L;
  q->L = p;
  p = q;
}
void rotateLL(treeAVL *&p) {
  treeAVL *q = p->L;
  p->balance = 0;
  q->balance = 0;
  p->L = q->R;
  q->R = p;
  p = q;
}
void rotateLR(treeAVL *&p) {
  treeAVL *q = p->L;
  treeAVL *r = q->R;
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
void rotateRL(treeAVL *&p) {
  treeAVL *q = p->R;
  treeAVL *r = q->L;
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

bool B2INSERT(tree *& p, int data , bool &VR,bool &HR){
  if (p == nullptr){
    p = new tree;
    p->data = data;
    p->L = p->R = nullptr;
    p->balance = false;
    VR = true;
  }
  else if (p->data > data){
    if(B2INSERT(p->L, data, VR, HR)){
      if (VR){
        if (!p->balance){
          tree * q = p->L;
          p->L = q->R;
          q->R = p;
          p = q;
          q->balance = true;
          VR = false;
          HR = true;
        }
        else{
          p->balance = false;
          VR = true;
          HR = false;
        }
      }
      else
        HR = false;
    }
    else 
      return false;
  }
  else if (p->data < data)
  {
    if(B2INSERT(p->R, data, VR, HR)){
      if (VR){
        p->balance = true;
        HR = true;
        VR = false;
      }
      else if (HR)
      {
        if (p->balance){
          tree * q = p->R;
          p->balance = false;
          q->balance = false;
          p->R = q->L;
          q->L = p;
          p = q;
          VR = true;
          HR = false;
        }
        else
          HR = false;
      }
    }
    else 
      return false;
  }
  else 
    return false;
  return true;
}

tree *createDBD(int n, bool &VR, bool &HR, bool log) {
  tree *root = NULL;
  int i = 0;
  while (i < n) {
    int data = rand() % MAX_RAND;
    if (B2INSERT(root, data, VR, HR))
      i++;
    else if (log)
      std::cout << "\t\t /* Данные с ключом \"" << data
                << "\" уже есть в дереве */" << std::endl;
  }
  return root;
}

bool addAVL(treeAVL *&p, int data, bool &rost) {
  if (p == NULL) {
    p = new treeAVL;
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

treeAVL *createAVL(int n, bool log) {
  treeAVL *root = NULL;
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
