#ifndef STRUCT_HPP
#define STRUCT_HPP

#include <windows.h>

struct list {
  int data;
  list *next = NULL;
  list *prev = NULL;
};
#endif