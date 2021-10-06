#ifndef STRUCT_HPP
#define STRUCT_HPP

#include <windows.h>

struct tree {
  int data;
  int weight;
  tree *left = nullptr;
  tree *right = nullptr;
};

#endif