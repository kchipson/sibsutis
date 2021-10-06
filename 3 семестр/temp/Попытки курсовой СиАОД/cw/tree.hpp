#ifndef TREE_HPP
#define TREE_HPP

#include <cstring>
#include "struct.hpp"
#include "functions.hpp"

void addAVL(tree *&p, itemDataBase data, bool &rost);
void outputTree_LR(tree *p, bool full);
void outputTree_TB(tree *p, bool full);
void outputTree_BT(tree *p, bool full);
tree *findVertexWithKey(tree *p, char *key);
#endif // !TREE_HPP