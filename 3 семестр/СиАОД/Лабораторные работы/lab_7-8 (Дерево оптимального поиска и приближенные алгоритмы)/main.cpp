#include <iostream>
#include <ctime>
#include <windows.h>

#include "somefunctions.hpp"
#include "treecreate.hpp"
#include "treeoutput.hpp"
#include "struct.hpp"

void printSquareMatrix (int **arr, int size);

int main(int argc, const char **argv) {
  SetConsoleOutputCP(65001);
  SetConsoleCP(65001);

  const int size = 100;

  const int seed = time(NULL);
  srand(seed);

  int **VandW = new int*[2]; // Данные и их веса

  for (int i = 0; i < 2; i++){
    VandW[i] = new int[size + 1];
    VandW[i][0] = 0;
  }
  
  // Заполение вершин неповторяющимися числами 
  bool table[2 * size] = {false};
  int x;
  for (int i = 1; i < size + 1; i++){
    while (table[x = rand() % (2 * size)])
      ;
    table[x] = true;
    VandW[0][i] = x;
  }
  // Сортировка вершин
  for (int i = 1; i < size + 1; i++) {
      for (int j = size - 1 + 1; j > i; j--) {
          if (VandW[0][j] < VandW[0][j - 1]) {
              swap(&VandW[0][j], &VandW[0][j - 1]);
          }
      }
  }
  // Случайные веса для вершин
  for (int i = 1; i < size + 1; i++){
    VandW[1][i] = rand() % size + 1;
  }

  // Вывод начальных данных и весов
  short int tmp = 0;
  for (int i = 1; i < size + 1; i++){ 
    std::cout.width(3);
    std::cout << VandW[0][i];
    std::cout << "[";
    std::cout.width(2);
    std::cout << VandW[1][i]; 
    std::cout << "]" <<"  ";
    tmp++;
    if(tmp == 10){
      std::cout << std::endl;
      tmp = 0;
    }
  }
  std::cout << std::endl;
  std::cout << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" << std::endl;

  int **AW = new int*[size + 1]; // матрица весов
  int **AP = new int*[size + 1]; // матрица взвешенных высот
  int **AR = new int*[size + 1]; // матрица индексов
  
  for (int i = 0; i < size + 1; i++){
    AW[i] = new int[size + 1];
    AP[i] = new int[size + 1];
    AR[i] = new int[size + 1];
    for (int j = 0; j < size + 1; j++)
      AW[i][j] = AP[i][j] = AR[i][j] = 0;
  }
  calculation_AW(AW, VandW, size + 1);
  calculation_APandAR(AP, AR, AW, size + 1);
  if (size < 26){
    std::cout << "Матрица AW:" << std::endl;
    printSquareMatrix(AW, size + 1);
    std::cout << "Матрица AP:" << std::endl;
    printSquareMatrix(AP, size + 1);
    std::cout << "Матрица AR:" << std::endl;
    printSquareMatrix(AR, size + 1);
  }

  tree* OST = nullptr;
  createTree(OST, 0, size, AR, VandW);
  std::cout << std::endl << "Дерево оптимального поиска (точный алгоритм)" << std::endl;
  outTree_LefttoRight(OST, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(OST, 1);
  std::cout << checkSumTree(OST, 1);
  std::cout << weightedAverageHeightTree(OST, 1) << std::endl;
  std::cout << "AP[0,size] / AW[0,size] = " << (double)AP[0][size] / AW[0][size] << std::endl;
  std::cout << std::endl << std::endl;

  tree* OST_A1 = nullptr;
  tree* OST_A2 = nullptr;
  A2(OST_A2, 1, size, VandW);
  A1(OST_A1, size + 1, VandW);
  
  std::cout << std::endl << "Дерево оптимального поиска (приближенный алгоритм #1)" << std::endl;
  outTree_LefttoRight(OST_A1, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(OST_A1, 1);
  std::cout << checkSumTree(OST_A1, 1);
  std::cout << weightedAverageHeightTree(OST_A1, 1) << std::endl;
  std::cout << std::endl << std::endl;

  std::cout << std::endl << "Дерево оптимального поиска (приближенный алгоритм #2)" << std::endl;
  outTree_LefttoRight(OST_A2, 1);
  std::cout << std::endl << "_____________________";
  std::cout << sizeTree(OST_A2, 1);
  std::cout << checkSumTree(OST_A2, 1);
  std::cout << weightedAverageHeightTree(OST_A2, 1) << std::endl;
  std::cout << std::endl << std::endl;

  pauseAtTheEnd();
  return 0;
}

void printSquareMatrix (int **arr, int size){
  for(int i = 0; i < size; i++){
    for(int j = 0; j < size; j++){
      std::cout.width(5);
      std::cout << arr[i][j] << " ";
    }
    std::cout << std::endl;
  }
}