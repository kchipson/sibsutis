#include <iostream>
#include <stdlib.h>
#include <conio.h>
#include "sorts.h"
#include <ctime>
#include <windows.h>
using namespace std;
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
// Создать проект, для оценки времени работы различных функций сортировки массивов различных типов (целых и вещественных). Функции сортировки разместить в библиотеке.
// Вызов фунции оценки времени сортировки должен выглядеть как:
// time=timer(tip_sort(a, n));
// где а – массив для сортировки, который может быть целого или вещественного типа.
// n-кол элементов в массиве.
// n взять достаточно большим для оценки времени сортировки

#define SelectSort(a,b) SelectSort,a,b
#define BubbleSort(a,b) BubbleSort,a,b
#define ShakerSort(a,b) ShakerSort,a,b
#define ShakerSort(a,b) ShakerSort,a,b
#define InsertSort(a,b) InsertSort,a,b
#define ShellSort(a,b) ShellSort,a,b
#define HeapSort(a,b) HeapSort,a,b
#define QuickSort(a,b) QuickSort,a,b

float timer(void (*Sort) (int A[], int n),int A[],int n)
{
	clock_t start = clock();
	Sort(A,n);
	clock_t end = clock();
	return (float)(end - start) / CLOCKS_PER_SEC;

}

float timer(void (*Sort) (float A[], int n),float A[],int n)
{
	clock_t start = clock();
	Sort(A,n);
	clock_t end = clock();
	return (float)(end - start) / CLOCKS_PER_SEC;

}

void FillRand(int* A, int n)
{
    for (int i = 0; i < n; i++)
        A[i] = rand() % (n * 2) - n;
} 
void FillRand(float* A, int n)
{
    for (int i = 0; i < n; i++)
        A[i] = (float)rand()*(10-0)/RAND_MAX + 0; 
} 
int main()
{
    setlocale(LC_ALL, "Russian");
    system("CLS");

    int* a;
    int n, t, i;
    srand(time(NULL));
    system("CLS");
    cout << "Размерность массива: ";
    cin >> n;
    a = new int[n];
    FillRand(a, n);

    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
    cout << endl
         << "Calculating..." << endl;
    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 5));
   	
   	cout<<"INT:"<<endl;
    printf("\nВремя выполнения SelectSort при n=%d:  %.6f  cek.", n, timer(SelectSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения BubbleSort при n=%d:  %.6f  cek.", n, timer(BubbleSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения ShakerSort при n=%d:  %.6f  cek.", n, timer(ShakerSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения InsertSort при n=%d:  %.6f  cek.", n, timer(InsertSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения ShellSort  при n=%d:  %.6f  cek.", n, timer(ShellSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения  HeapSort  при n=%d:  %.6f  cek.", n, timer(HeapSort(a, n)));
    FillRand(a, n);
    printf("\nВремя выполнения QuickSort  при n=%d:  %.6f  cek.", n, timer(QuickSort(a, n)));
	delete a;
	
	cout<<endl<<"FLOAT:"<<endl;
	float* b;
	b = new float[n];
    FillRand(b, n);
    
    printf("\nВремя выполнения SelectSort при n=%d:  %.6f  cek.", n, timer(SelectSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения BubbleSort при n=%d:  %.6f  cek.", n, timer(BubbleSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения ShakerSort при n=%d:  %.6f  cek.", n, timer(ShakerSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения InsertSort при n=%d:  %.6f  cek.", n, timer(InsertSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения ShellSort  при n=%d:  %.6f  cek.", n, timer(ShellSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения  HeapSort  при n=%d:  %.6f  cek.", n, timer(HeapSort(b, n)));
    FillRand(b, n);
    printf("\nВремя выполнения QuickSort  при n=%d:  %.6f  cek.", n, timer(QuickSort(b, n)));
	delete b;
    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
    return 0;
}
