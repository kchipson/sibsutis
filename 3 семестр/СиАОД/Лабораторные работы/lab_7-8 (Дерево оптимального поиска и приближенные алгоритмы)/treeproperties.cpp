#include "treeproperties.hpp"
#include <iostream>

/* Размер дерева */
int sizeTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The size of the tree: ";
  if (p == nullptr)
    return 0;
  else
    return (1 + sizeTree(p->left, 0) + sizeTree(p->right, 0));
}

/* Контрольная сумма дерева */
int checkSumTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The checksum tree: ";
  if (p == nullptr)
    return 0;
  else
    return (p->data + checkSumTree(p->left, 0) + checkSumTree(p->right, 0));
}

/* Сумма длин элементов дерева */
int sumOfPathLengths(tree *p, int depth, bool root) {
  if (root)
    std::cout << std::endl
              << "The sum of the lengths of the paths of the tree: ";
  if (p == nullptr)
    return 0;
  else
    return (depth + sumOfPathLengths(p->left, depth + 1, 0) +
            sumOfPathLengths(p->right, depth + 1, 0));
}

int maxHeight(int a, int b) {
  if (a < b)
    return b;
  else
    return a;
}

/* Высота дерева */
int heightTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The height tree: ";
  if (p == nullptr)
    return 0;
  else
    return (1 + maxHeight(heightTree(p->left, 0), heightTree(p->right, 0)));
}

/* Средняя высота дерева */
float averageHeightTree(tree *p, bool root) {
  if (root)
    std::cout << std::endl << "The average height tree: ";
  return (float(sumOfPathLengths(p, 1, 0)) / sizeTree(p, 0));
}

/* Средневзвешенная высота дерева */
float weightedAverageHeightTree(tree* p, bool root){
	float h;
  if (root)
    std::cout << std::endl << "The weighted average height tree: ";
	h = (float)sumLengthWaysTreeDOP(p,1) / weightTree(p);
	return h;
	
}

int weightTree(tree* root){
	int n;
	if(root == nullptr){
		n=0;
	}else{
		n = root->weight + weightTree(root->left) + weightTree(root->right);
	}
	return n;
}

int sumLengthWaysTreeDOP(tree* root,int L){
	int S;
	if(root == nullptr){
		S = 0;
	}else{
		S=root->weight * L + sumLengthWaysTreeDOP(root->left, L + 1) + sumLengthWaysTreeDOP(root->right, L + 1);
	}
	return S;
}