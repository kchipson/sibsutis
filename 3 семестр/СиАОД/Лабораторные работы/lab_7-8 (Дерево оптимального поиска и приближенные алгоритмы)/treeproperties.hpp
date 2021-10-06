#ifndef TREEPROPERTIES_HPP
#define TREEPROPERTIES_HPP

#include "struct.hpp"

int sizeTree(tree *p, bool root);
int checkSumTree(tree *p, bool root);
int sumOfPathLengths(tree *p, int depth, bool root);
int heightTree(tree *p, bool root);
float averageHeightTree(tree *p, bool root);

float weightedAverageHeightTree(tree* p, bool root);
int weightTree(tree* root);
int sumLengthWaysTreeDOP(tree* root,int L);

#endif