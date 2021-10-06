#ifndef STRUCT_HPP
#define STRUCT_HPP

#include <windows.h>

struct tree {
  int data;
  bool balance = false;
  tree *L = nullptr;
  tree *R = nullptr;
};

struct treeAVL {
  int data;
  short int balance = 0;
  treeAVL *L = NULL;
  treeAVL *R = NULL;
};
#endif