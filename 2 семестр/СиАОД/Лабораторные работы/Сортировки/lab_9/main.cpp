#include <iostream>
#include <conio.h>
#include "Filling_method.h"
#include "Output.h"
#include "Sorting_method.h"

using namespace std;

//������������� ������ ���������� ��������� � ��������� (� � �)
double M_theoretical = 0, C_theoretical = 0;
//����������� �������� ���������� ��������� � ��������� (� � �)
int M_real = 0, C_real = 0;

int main()
{
    int *A, n, f;
    setlocale(LC_ALL, "Russian");
    system("CLS");
    int t;
    do {
        system("CLS");
        cout
            << "1. ���������� " << endl
            << "2. ���������� " << endl
            << "�����: ";
        cin >> t;

        switch (t) {
        case 1:
            cout << "������� n: ";
            cin >> n;
            A = new int[n];

            cout << endl
                 << "�������� ������ ���������� �������:" << endl
                 << "1.FillInc (���������� ������� �� �����������)" << endl
                 << "2.FillDec (���������� ������� �� ��������)" << endl
                 << "3.FillRand (��������� ���������� �������)" << endl
                 << "�����: ";
            cin >> f;
            switch (f) {
            case 1:
                FillInc(A, n);
                break;
            case 2:
                FillDec(A, n);
                break;
            case 3:
                FillRand(A, n);
                break;
            }
            cout << "**************************************************************";
            PrintMas(A, n, false);
            HeapSort(A, n);
            PrintMas(A, n, true);
            cout << "**************************************************************";
            break;
        case 2:
            graph();
            break;
        }

        cout << " \nPress [Esc] to exit \n";

    } while (_getch() != 27);
    return 0;
}
