#ifndef TREECREATE_HPP
#define TREECREATE_HPP
#include "struct.hpp"

const int MAX_RAND = 1000; // Число в дереве [0..MAX_RAND]

tree *PBST(int left, int right, int *A);
tree *createPBST(int n);
#endif