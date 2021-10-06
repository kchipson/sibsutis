#ifndef TREECREATE_HPP
#define TREECREATE_HPP
#include "struct.hpp"

const int MAX_RAND = 100; // Число в дереве [0..MAX_RAND]

#include "treecreate.hpp"
#include <iostream>
#include <ctime>
#include <conio.h>

/* Perfectly balanced search tree */
/* Идеально сбалансированное дерево поиска */
tree *PBST(int left, int right, int *A);
tree *createPBST(int n);

/* Добавление элемента в случайное дерево поиска (двойная косвенность (double
 * indirection)) */
bool addRST_DI(tree *&p, int data);
tree *createRST_DI(int n, bool log = false);

/* Добавление элемента в случайное дерево поиска (рекурсия (recursive)) */
bool addRST_R(tree *&p, int data);
tree *createRST_R(int n, bool log = false);

#endif