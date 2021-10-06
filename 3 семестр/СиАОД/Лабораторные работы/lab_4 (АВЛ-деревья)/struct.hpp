#ifndef STRUCT_HPP
#define STRUCT_HPP

#include <windows.h>

struct tree {
  int data;
  short int balance = 0;
  tree *L = NULL;
  tree *R = NULL;
};
#endif