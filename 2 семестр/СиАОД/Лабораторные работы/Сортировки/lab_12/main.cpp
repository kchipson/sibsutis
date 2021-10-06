#include <math.h>
#include <iostream>
#include <conio.h>
#include "Filling_method.h"
#include "Checks.h"
#include "Functions.h"
#include "Sorting_method.h"
#include "Structure.h"

using namespace std;

int main()
{
    double M_theoretical, C_theoretical;
    int M_real = 0, C_real = 0;
    int n, t, f;
    tLE *head = NULL, *tail = NULL;
    setlocale(LC_ALL, "Russian");
    system("CLS");

    do
    {
        system("CLS");
        cout
            << "1. ���������� " << endl
            << "2. ���������� " << endl
            << endl;

        cout
            << " \nPress [Esc] to exit \n";
        t = _getch();
        system("CLS");
        switch (t)
        {

        case '1':
            system("CLS");
            cout << "������� n: ";
            cin >> n;
            M_theoretical = n * ceil(log2(n)) + n;
            C_theoretical = n * ceil(log2(n));
            cout << endl
                 << "�������� ������ ���������� �������:" << endl
                 << "1.FillInc (���������� �������������� �������)" << endl
                 << "2.FillDec (���������� ���������� �������)" << endl
                 << "3.FillRand (��������� ���������� �������)" << endl
                 << "�����: ";

            f = _getch();
            switch (f)
            {

            case '1':
                QueueFillInc(n, head, tail);
                break;
            case '2':
                QueueFillDec(n, head, tail);
                break;
            case '3':
                QueueFillRand(n, head, tail);
                break;
            }
            system("CLS");
            cout << "**************************************************************" << endl;
            PrintList(head, tail);
            cout << "**************************************************************" << endl;
            MergeSort(head, tail, C_real, M_real);
            PrintList(head, tail);
            cout << endl
                 << "M_theoretical = " << M_theoretical << endl
                 << "C_theoretical < " << C_theoretical << endl
                 << "M_real = " << M_real << endl
                 << "C_real = " << C_real << endl;
            cout << "**************************************************************" << endl;
            cout << "         ������� ����� ������� ��� ����������� ..." << endl;
            _getch();
            DeleteList(head, tail);
            break;
        case '2':
            statistics();
            break;

        case 27:
            return 0;
        }
    } while (1);
    return 0;
}
