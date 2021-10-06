#include <math.h>
#include <iostream>
#include <conio.h>
#include "Filling_method.h"
#include "Output.h"
#include "Sorting_method.h"

using namespace std;

//������������� ������ ���������� ��������� � ��������� (� � �)
double M_theoretical = 0, C_theoretical = 0;
//����������� �������� ���������� ��������� � ��������� (� � �)
int M_real = 0, C_real = 0,Depth_max=0,Depth=0;

int main()
{
    int *A, n, f,t;
    setlocale(LC_ALL, "Russian");
    system("CLS");

    do {
        system("CLS");
        cout
            << "1. ���������� " << endl
            << "2. ���������� " << endl
            << "0. �����" << endl
            << "�����: ";
        t=_getch();
        switch (t) {
        case '1':
            system("CLS");
            cout << "������� n: ";
            cin >> n;
            A = new int[n];

            cout << endl
                 << "�������� ������ ���������� �������:" << endl
                 << "1.FillInc (���������� ������� �� �����������)" << endl
                 << "2.FillDec (���������� ������� �� ��������)" << endl
                 << "3.FillRand (��������� ���������� �������)" << endl
                 << "�����: ";

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
