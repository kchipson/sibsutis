#include <math.h>
#include <iostream>
#include <conio.h>
#include "Filling_method.h"
#include "Output.h"
#include "Sorting_method.h"

using namespace std;

//Теоретические оценки количества пересылок и сравнений (М и С)
double M_theoretical = 0, C_theoretical = 0;
//Фактические значения количества пересылок и сравнений (М и С)
int M_real = 0, C_real = 0,Depth_max=0,Depth=0;

int main()
{
    int *A, n, f,t;
    setlocale(LC_ALL, "Russian");
    system("CLS");

    do {
        system("CLS");
        cout
            << "1. Сортировка " << endl
            << "2. Статистика " << endl
            << "0. Выход" << endl
            << "Выбор: ";
        t=_getch();
        switch (t) {
        case '1':
            system("CLS");
            cout << "Введите n: ";
            cin >> n;
            A = new int[n];

            cout << endl
                 << "Выберите способ заполнения массива:" << endl
                 << "1.FillInc (Заполнение массива по возрастанию)" << endl
                 << "2.FillDec (Заполнение массива по убыванию)" << endl
                 << "3.FillRand (Случайное заполнение массива)" << endl
                 << "Выбор: ";

            f=_getch();
            switch (f) {

            case '1':
                FillInc(A, n);
                break;
            case '2':
                FillDec(A, n);
                break;
            case '3':
                FillRand(A, n);
                break;
            }
            system("CLS");
            cout << "**************************************************************";
            PrintMas(A, n, false);
            C_theoretical = M_theoretical = n * log(n);
            C_real = 0;
            M_real = 0;
            Depth=0;
            Depth_max=0;
            QuickSortV1(A, n-1);
            PrintMas(A, n, true);
            cout << "**************************************************************";
            break;

        case '2':
            statistics();
            break;

        case '0':
            return 0;

        }

        cout << " \nPress [Esc] to exit \n";

    } while (_getch() != 27);
    return 0;
}
