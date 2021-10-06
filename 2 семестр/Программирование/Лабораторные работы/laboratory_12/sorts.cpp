#include <math.h>
#include <ctime>
void swap(int* a, int* b)
{
    int temp;
    temp = *a;
    *a = *b;
    *b = temp;
}
void swap(float* a, float* b)
{
    int temp;
    temp = *a;
    *a = *b;
    *b = temp;
}

// 2 Лаба
void SelectSort(int* A, int n)
{ // Метод прямого выбора SelectSort
    int k;
    for (int i = 0; i < n - 1; i++) {
        k = i;
        for (int j = i + 1; j < n; j++) {
            if (A[j] < A[k]) {
                k = j;
            }
        }
        if (i != k) {
            swap(&A[i], &A[k]);
        }
    }
}
void SelectSort(float* A, int n)
{ // Метод прямого выбора SelectSort
    int k;
    for (int i = 0; i < n - 1; i++) {
        k = i;
        for (int j = i + 1; j < n; j++) {
            if (A[j] < A[k]) {
                k = j;
            }
        }
        if (i != k) {
            swap(&A[i], &A[k]);
        }
    }
}


// 3 Лаба
void BubbleSort(int* A, int n)
{ // Метод пузырька BubbleSort
    for (int i = 0; i < n; i++) {
        for (int j = n - 1; j > i; j--) {
            if (A[j] < A[j - 1]) {
                swap(&A[j], &A[j - 1]);
            }
        }
    }
}
void BubbleSort(float* A, int n)
{ // Метод пузырька BubbleSort
    for (int i = 0; i < n; i++) {
        for (int j = n - 1; j > i; j--) {
            if (A[j] < A[j - 1]) {
                swap(&A[j], &A[j - 1]);
            }
        }
    }
}

// 4 Лаба
void ShakerSort(int* A, int n)
{ // Шейкерная сортировка
    int i, L = 0, R = n - 1, k = n;
    do {
        for (i = R; i >= L + 1; i--) {
            if (A[i] < A[i - 1]) {
                swap(&A[i], &A[i - 1]);
                k = i;
            }
        }
        L = k;
        for (i = L; i <= R - 1; i++) {
            if (A[i] > A[i + 1]) {
                swap(&A[i], &A[i + 1]);
                k = i;
            }
        }
        R = k;
    } while (L < R);
}
void ShakerSort(float* A, int n)
{ // Шейкерная сортировка
    int i, L = 0, R = n - 1, k = n;
    do {
        for (i = R; i >= L + 1; i--) {
            if (A[i] < A[i - 1]) {
                swap(&A[i], &A[i - 1]);
                k = i;
            }
        }
        L = k;
        for (i = L; i <= R - 1; i++) {
            if (A[i] > A[i + 1]) {
                swap(&A[i], &A[i + 1]);
                k = i;
            }
        }
        R = k;
    } while (L < R);
}

//5 лаба
void InsertSort(int* A, int n)
{ // Метод прямого включения
    int temp, i, j;
    for (i = 1; i < n; i++) {
        temp = A[i];
        j = i - 1;
        while (j >= 0 && temp < A[j]) {
            A[j + 1] = A[j];
            j = j - 1;
        }
        A[j + 1] = temp;
    }
}
void InsertSort(float* A, int n)
{ // Метод прямого включения
    int temp, i, j;
    for (i = 1; i < n; i++) {
        temp = A[i];
        j = i - 1;
        while (j >= 0 && temp < A[j]) {
            A[j + 1] = A[j];
            j = j - 1;
        }
        A[j + 1] = temp;
    }
}
//6 Лаба

void ShellSort(int* A, int n)
{ //Метод Шелла
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
            temp = A[i];
            j = i - k;
            while (j >= 0 && temp < A[j]) {
                A[j + k] = A[j];
                j = j - k;
            }

            A[j + k] = temp;
        }
    }
}
void ShellSort(float* A, int n)
{ //Метод Шелла
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
            temp = A[i];
            j = i - k;
            while (j >= 0 && temp < A[j]) {
                A[j + k] = A[j];
                j = j - k;
            }

            A[j + k] = temp;
        }
    }
}

//9 Лаба
void BuildSort(int* A, int L, int R)
{
    int x = A[L];
    int i = L;
    while (1) {
        int j = 2 * i;
        if (j > R)
            break;
        if ((j < R) && (A[j + 1] <= A[j]))
            j = j + 1;
        if (x <= A[j])
            break;
        A[i] = A[j];
        i = j;
    }
    A[i] = x;
}
void BuildSort(float* A, int L, int R)
{
    int x = A[L];
    int i = L;
    while (1) {
        int j = 2 * i;
        if (j > R)
            break;
        if ((j < R) && (A[j + 1] <= A[j]))
            j = j + 1;
        if (x <= A[j])
            break;
        A[i] = A[j];
        i = j;
    }
    A[i] = x;
}

void HeapSort(int* A, int n)
{ //Пирамидальная сортировка
    int L, R;
    L = floor((n - 1) / 2);
    while (L >= 0) {
        BuildSort(A, L, n - 1);
        L--;
    }
    R = n - 1;
    while (R > 0) {
        swap(&A[0], &A[R]);
        R--;
        BuildSort(A, 0, R);
    }
}
void HeapSort(float* A, int n)
{ //Пирамидальная сортировка
    int L, R;
    L = floor((n - 1) / 2);
    while (L >= 0) {
        BuildSort(A, L, n - 1);
        L--;
    }
    R = n - 1;
    while (R > 0) {
        swap(&A[0], &A[R]);
        R--;
        BuildSort(A, 0, R);
    }
}

//10 Лабаfloat
void QuickSort(int* A, int R, int L)
{ //Быстрая сортировка
    while (L < R) {
        int x = A[L]; //A[(int)((R+L)/2)];
        int i = L;
        int j = R;
        while (i <= j) {
            while (A[i] < x) {
                i++;
            }
            while (A[j] > x) {
                j--;
            }
            if (i <= j) {
                swap(&A[i], &A[j]);
                i++;
                j--;
            }
        }
        if (j - L > R - i) {
            QuickSort(A, R, i);
            R = j;
        }
        else {
            QuickSort(A, j, L);
            L = i;
        }
    }
}
void QuickSort(float* A, int R, int L)
{ //Быстрая сортировка
    while (L < R) {
        int x = A[L]; //A[(int)((R+L)/2)];
        int i = L;
        int j = R;
        while (i <= j) {
            while (A[i] < x) {
                i++;
            }
            while (A[j] > x) {
                j--;
            }
            if (i <= j) {
                swap(&A[i], &A[j]);
                i++;
                j--;
            }
        }
        if (j - L > R - i) {
            QuickSort(A, R, i);
            R = j;
        }
        else {
            QuickSort(A, j, L);
            L = i;
        }
    }
}

void QuickSort(int* A, int n)
{ //Быстрая сортировка
   QuickSort(A, n - 1, 0);
}
void QuickSort(float* A, int n)
{ //Быстрая сортировка
   QuickSort(A, n - 1, 0);
}
