#include <ctime>
#include <stdlib.h>

void FillInc(int* A, int n)
{
    srand(time(NULL));
    for (int i = 0; i < n; i++)
        A[i] = i;
}

void FillDec(int* A, int n)
{
    srand(time(NULL));
    for (int i = 0; i < n; i++)
        A[i] = n - i - 1;
}

void FillRand(int* A, int n)
{
    srand(time(NULL));
    for (int i = 0; i < n; i++)
        A[i] = rand() % (n * 2) - n;
}