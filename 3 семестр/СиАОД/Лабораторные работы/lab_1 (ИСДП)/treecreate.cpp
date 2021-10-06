#include "treecreate.hpp"
#include <iostream>
#include <ctime>
#include <conio.h>

void FillRand(int *A, int n) {
  bool table[MAX_RAND] = {false};
  int x;
  for (int i = 0; i < n; i++) {
    while (table[x = rand() % MAX_RAND])
      ;
    table[x] = true;
    A[i] = x;
  }
}

void InsertSort(int *A, int n) {
  int temp, i, j;
  for (i = 1; i < n; i++) {
    temp = A[i];
    j = i - 1;
    while (j >= 0 && temp < A[j]) {
      A[j + 1] = A[j];
      j = j - 1;
    }
    A[j + 1] = temp;
  }
}

/*Perfectly balanced search tree*/
/*Идеально сбалансированное дерево поиска*/
tree *PBST(int left, int right, int *A) {

  if (left > right)
    return NULL;
  else {
    int m = ((left + right) / 2);
    tree *p = new tree;
    p->data = A[m];
    p->L = PBST(left, m - 1, A);
    p->R = PBST(m + 1, right, A);
    return p;
  }
}

tree *createPBST(int n) {
  int *Arr = new int[n];
  FillRand(Arr, n);
  InsertSort(Arr, n);
  return PBST(0, n - 1, Arr);
}