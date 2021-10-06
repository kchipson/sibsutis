#ifndef TREECREATE_HPP
#define TREECREATE_HPP
#include "struct.hpp"

const int MAX_RAND = 501; // Число в дереве [0..MAX_RAND]

bool B2INSERT(tree *& p, int data , bool &VR,bool &HR);
tree *createDBD(int n, bool &VR, bool &HR, bool log);

bool addAVL(treeAVL *&p, int data, bool &rost);
treeAVL *createAVL(int n, bool log);

#endif