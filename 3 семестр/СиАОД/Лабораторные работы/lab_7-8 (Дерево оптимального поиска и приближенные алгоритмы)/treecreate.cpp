#include "treecreate.hpp"
#include "somefunctions.hpp"

/* Вычисление матрицы весов (AW) */
void calculation_AW(int **AW, int **VW,int size){
	for(int i = 0; i < size; i++){
		for(int j = (i + 1); j < size; j++){
			AW[i][j] = AW[i][j-1] + VW[1][j];
		}
	}
}

/* Вычисление матрицы взвешенных высот (AP) и матрицы индексов (AR) */
void calculation_APandAR(int **AP, int **AR, int **AW, int size){
	for(int i = 0; i < size - 1; i++){
		int j = i + 1;
		AP[i][j] = AW[i][j];
		AR[i][j] = j;
	}
	for(int h = 2; h < size; h++){
		for(int i = 0; i < size - h; i++){
			int j = i + h;
			int m = AR[i][j - 1];
			int min = AP[i][m - 1] + AP[m][j];
			for(int k = m + 1; k <= AR[i + 1][j]; k++){
				int x = AP[i][k - 1] + AP[k][j];
				if(x < min){
					m = k;
					min = x;
				}
			}
			AP[i][j] = min + AW[i][j];
			AR[i][j] = m;
		}
	}
}

/* Создание дерева */
void createTree(tree*& root, int lBorder, int rBorder, int **AR, int **VW){
	if(lBorder < rBorder){
		int k = AR[lBorder][rBorder];
    addRST_R(root, VW[0][k], VW[1][k]);
		createTree(root, lBorder, k - 1, AR, VW);
		createTree(root, k, rBorder, AR, VW);
	}
}

/* Добавление элемента в случайное дерево поиска (рекурсия (recursive)) */
void addRST_R(tree *&p, int data, int weight) {
  if (p == NULL) {
    p = new tree;
    p -> data = data;
    p -> weight = weight;
  } else if (data < p->data)
    addRST_R(p -> left, data, weight);
  else if (data > p -> data)
    addRST_R(p -> right, data, weight);
}

void QuickSortV2(int** A, int R, int L)
{
    while (L < R) {
        int x = A[1][L];
        int i = L;
        int j = R;
        while (i <= j) {
            while (A[1][i] > x)
                i++;
            while (A[1][j] < x)
                j--;
            if (i <= j) {
				swap(&A[0][i], &A[0][j]);
                swap(&A[1][i], &A[1][j]);
                i++;
                j--;
            }
        }
        if (j - L > R - i) {
            QuickSortV2(A, R, i);
            R = j;
        }
        else {
            QuickSortV2(A, j, L);
            L=i; 
        } 
    } 
}

void A1(tree *&p, int size, int **VW)
{
	QuickSortV2(VW,size-1, 0);
	// Сортировка по весам
	// for (int i = 1; i < size; i++) {
	// 	for (int j = size - 1; j > i; j--) {
	// 		if (VW[1][j] > VW[1][j - 1]) {
	// 			swap(&VW[0][j], &VW[0][j - 1]);
	// 			swap(&VW[1][j], &VW[1][j - 1]);
	// 		}
	// 	}
	// }
	// Вывод начальных данных и весов
	
	short int tmp = 0;
	for (int i = 1; i < size; i++){ 
		std::cout.width(3);
		std::cout << VW[0][i];
		std::cout << "[";
		std::cout.width(2);
		std::cout << VW[1][i]; 
		std::cout << "]" <<"  ";
		tmp++;
		if(tmp == 10){
			std::cout << std::endl;
			tmp = 0;
		}
	}
	for(int i = 1; i < size; i++)
	{
		addRST_R(p, VW[0][i], VW[1][i]);
	}
}

void A2(tree *&p, int L, int R, int **VW)
{
	int wes = 0, sum = 0;
	if(L <= R)
	{
		int i = 0;
		for(i = L; i < R; i++)
			wes = wes + VW[1][i];
		

		for(i = L; i < R; i++)
		{
			if((sum <= wes / 2) && (sum + VW[1][i] > wes / 2))
				break;
			sum = sum + VW[1][i];
		}
		
		addRST_R(p, VW[0][i], VW[1][i]);
		A2(p, L, i - 1, VW);
		A2(p, i + 1, R, VW);
	}
}
