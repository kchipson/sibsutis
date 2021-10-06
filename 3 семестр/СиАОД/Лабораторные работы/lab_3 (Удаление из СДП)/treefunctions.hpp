#ifndef TREEFUNCTIONS_HPP
#define TREEFUNCTIONS_HPP

#include "struct.hpp"

tree *findVertexWithKey(tree *p, int key);
bool deleteVertexWithKey(tree *&root, int key);
#endif