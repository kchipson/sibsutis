#ifndef TREEFUNCTIONS_HPP
#define TREEFUNCTIONS_HPP

#include "struct.hpp"
#include <iostream>

void BL(tree *&p, bool &decrease);
void BR(tree *&p, bool &decrease);
bool deleteVertexWithKey(tree *&p, int key, bool &decrease);
#endif