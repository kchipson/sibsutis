#ifndef TREEPROPERTIES_HPP
#define TREEPROPERTIES_HPP

#include "struct.hpp"

int sizeTree(tree *p, bool root);
int checkSumTree(tree *p, bool root);
int sumOfPathLengths(tree *p, int depth, bool root);
int heightTree(tree *p, bool root);
float averageHeightTree(tree *p, bool root);

int sizeTree(treeAVL *p, bool root);
int checkSumTree(treeAVL *p, bool root);
int sumOfPathLengths(treeAVL *p, int depth, bool root);
int heightTree(treeAVL *p, bool root);
float averageHeightTree(treeAVL *p, bool root);

#endif