#ifndef STRUCT_HPP
#define STRUCT_HPP

#include <windows.h>

struct tree {
  int data;
  tree *L = NULL;
  tree *R = NULL;
};
#endif