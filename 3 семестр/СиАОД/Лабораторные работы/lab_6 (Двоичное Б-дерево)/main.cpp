#include <iostream>
#include <ctime>
#include <windows.h>

#include "somefunctions.hpp"
#include "treeoutput.hpp"
#include "treecreate.hpp"
#include "struct.hpp"

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);
  int seed = time(NULL);
  bool HR= true;
  bool VR= true; 


  srand(seed);
  tree * DBD = createDBD(100, VR, HR, 0);
  outTree_LefttoRight(DBD, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(DBD, 1);
  std::cout << checkSumTree(DBD, 1);
  std::cout << heightTree(DBD, 1);
  std::cout << averageHeightTree(DBD, 1);
  std::cout << std::endl << std::endl;

  srand(seed);
  treeAVL * AVL = createAVL(100, 0);
  outTree_LefttoRight(AVL, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(AVL, 1);
  std::cout << checkSumTree(AVL, 1);
  std::cout << heightTree(AVL, 1);
  std::cout << averageHeightTree(AVL, 1);
  std::cout << std::endl << std::endl;
  std::cout << std::endl << std::endl;
  table(AVL, DBD, 100);
  pauseAtTheEnd();
  return 0;
}
