#ifndef TREECREATE_HPP
#define TREECREATE_HPP
#include "struct.hpp"

const int MAX_RAND = 101; // Число в дереве [0..MAX_RAND]

#include "treecreate.hpp"
#include "somefunctions.hpp"
#include "treegraphics.hpp"
#include <iostream>
#include <ctime>
#include <conio.h>

tree *createAVL(int n, bool log = 0);
bool addAVL(tree *&p, int data, bool &rost);


bool addRST_R(tree *&p, int data);
tree *createRST_R(int n, bool log = 0);

#endif