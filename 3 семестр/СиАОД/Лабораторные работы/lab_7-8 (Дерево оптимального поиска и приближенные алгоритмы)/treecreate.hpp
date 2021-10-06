#ifndef TREECREATE_HPP
#define TREECREATE_HPP

#include "struct.hpp"
#include "somefunctions.hpp"

/* Вычисление матрицы весов (AW) */
void calculation_AW(int **AW, int **VW,int size);

/* Вычисление матрицы взвешенных высот (AP) и матрицы индексов (AR) */
void calculation_APandAR(int **AP, int **AR, int **AW, int size);
/* Создание дерева */

void createTree(tree*& root, int lBorder, int rBorder, int **AR, int **VW);

/* Добавление элемента в случайное дерево поиска (рекурсия (recursive)) */
void addRST_R(tree *&p, int data, int weight);

void QuickSortV2(int** A, int R, int L);

void A1(tree *&p, int size, int **VW);
void A2(tree *&p, int L, int R, int **VW);
#endif