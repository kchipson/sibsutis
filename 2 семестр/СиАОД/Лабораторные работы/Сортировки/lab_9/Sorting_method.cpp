#include <math.h>
#include <iostream>
using namespace std;
extern int M_real, C_real;
extern double M_theoretical, C_theoretical;

void swap(int* a, int* b)
{
    int temp;
    temp = *a;
    *a = *b;
    *b = temp;
}

// 2 Лаба (классик)
void SelectSort(int* A, int n)
{ // Метод прямого выбора SelectSort
    M_real = 0;
    C_real = 0;
    M_theoretical = 3 * (n - 1), C_theoretical = (n * n - n) / 2;
    int k;

    for (int i = 0; i < n - 1; i++) {
        k = i;
        for (int j = i + 1; j < n; j++) {
            C_real++;
            if (A[j] < A[k]) {
                k = j;
            }
        }
        if (i != k) {
            swap(&A[i], &A[k]);

            M_real += 3;
        }
    }
}

// 3 Лаба
void BubbleSort(int* A, int n)
{ // Метод пузырька BubbleSort
    M_real = 0;
    C_real = 0;
    C_theoretical = (n * n - n) / 2, M_theoretical = 3 * C_theoretical / 2;
    for (int i = 0; i < n; i++) {
        for (int j = n - 1; j > i; j--) {
            C_real++;
            if (A[j] < A[j - 1]) {
                swap(&A[j], &A[j - 1]);
                M_real += 3;
            }
        }
    }
}

// 4 Лаба

void ShakerSort(int* A, int n)
{
    C_theoretical = ((n * n - n) / 2 + n - 1) / 2, M_theoretical = 3 * C_theoretical / 2;
    M_real = 0;
    C_real = 0;
    int i, L = 0, R = n - 1, k = n;
    do {
        for (i = R; i >= L + 1; i--) {
            C_real++;
            if (A[i] < A[i - 1]) {
                swap(&A[i], &A[i - 1]);
                M_real += 3;
                k = i;
            }
        }
        L = k;
        for (i = L; i <= R - 1; i++) {
            C_real++;
            if (A[i] > A[i + 1]) {
                swap(&A[i], &A[i + 1]);
                M_real += 3;
                k = i;
            }
        }
        R = k;
    } while (L < R);
}

//5 лаба
void InsertSort(int* A, int n)
{
    C_theoretical = ((n * n - n) / 2 + n - 1) / 2, M_theoretical = 3 * C_theoretical / 2;
    M_real = 0;
    C_real = 0;
    int temp, i, j;
    for (i = 1; i < n; i++) {
        M_real++;
        temp = A[i];
        j = i - 1;
        C_real++;
        while (j >= 0 && temp < A[j]) {
            C_real++;
            M_real++;
            A[j + 1] = A[j];
            j = j - 1;
        }
        A[j + 1] = temp;
        M_real++;
    }
}

//6 Лаба
void ShellSort(int* A, int n)
{
    C_theoretical = ((n * n - n) / 2 + n - 1) / 2, M_theoretical = 3 * C_theoretical / 2;
    C_real = 0;
    M_real = 0;
    int m = floor(log2(n)) - 1;
    int* B;
    B = new int[m];
    B[0] = 1;
    for (int i = 1; i < m; i++) {
        B[i] = 2 * B[i - 1] + 1;
    }

    int temp, k, j, l = m - 1;
    for (k = B[l]; l >= 0; l--, k = B[l]) {
        for (int i = k; i < n; i++) {
            M_real++;
            C_real++;
            temp = A[i];
            j = i - k;
            while (j >= 0 && temp < A[j]) {
                M_real++;
                C_real++;
                A[j + k] = A[j];
                j = j - k;
            }
            M_real++;
            A[j + k] = temp;
        }
    }
}

//9 Лаба
void BuildSort(int* A, int L, int R)
{
    M_real++;
    int x = A[L];
    int i = L;
    while (1) {
        int j = 2 * i;
        if (j > R)
            break;
        C_real++;
        if ((j < R) && (A[j + 1] <= A[j]))
            j = j + 1;
        C_real++;
        if (x <= A[j])
            break;
        M_real++;
        A[i] = A[j];
        i = j;
    }
    M_real++;
    A[i] = x;
}

void HeapSort(int* A, int n)
{
    C_real = 0;
    M_real = 0;
    int L, R;
    L = floor((n - 1) / 2);
    while (L >= 0) {
        BuildSort(A, L, n - 1);
        L--;
    }
    R = n - 1;
    while (R > 0) {
        swap(A[0], A[R]);
        M_real += 3;
        R--;
        BuildSort(A, 0, R);
    }

}
