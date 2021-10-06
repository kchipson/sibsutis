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
    double M_theoretical, C_theoretical = 0;
    int M_real = 0, temp = 0;
    int n, t, f, u;
    tLE16 *head16 = NULL, *tail16 = NULL;
    tLE32 *head32 = NULL, *tail32 = NULL;
    setlocale(LC_ALL, "Russian");
    system("CLS");

    do
    {
        system("CLS");
        cout
            << "1. ���������� " << endl
            << endl;

        cout
            << " \nPress [Esc] to exit \n";
        t = _getch();
        system("CLS");
        switch (t)
        {

        case '1':
            M_real = 0, temp = 0;
            system("CLS");
            cout << "������� n: ";
            cin >> n;

            cout << endl
                 << "�������� ������ ���������� ������:" << endl
                 << "1.FillInc (���������� �������������� �������)" << endl
                 << "2.FillDec (���������� ���������� �������)" << endl
                 << "3.FillRand (��������� ���������� �������)" << endl
                 << "�����: ";

            f = _getch();
            system("CLS");
            cout << endl
                 << "�������� ��� ����� ����� ����� ����� ����������� ����������:" << endl
                 << "* 2(������������) " << endl
                 << "* 4(���������������)" << endl
                 << "�����: ";
            u = _getch();
            switch (u)
            {
            case '2':
                switch (f)
                {
                case '1':
                    QueueFillInc(n, head16, tail16);
                    break;
                case '2':
                    QueueFillDec(n, head16, tail16);
                    break;
                case '3':
                    QueueFillRand(n, head16, tail16);
                    break;
                }
                system("CLS");
                M_theoretical = 2 * (n + 256);
                cout << "***********************��������� ������***********************" << endl;
                PrintList(head16, tail16);
                cout << "************��������������� �� ����������� ������ ************" << endl;
                DigitalSort(head16, tail16, temp, 0);
                M_real = temp;
                PrintList(head16, tail16);
                cout << "**************��������������� �� �������� ������**************" << endl;
                DigitalSort(head16, tail16, temp, 1);
                PrintList(head16, tail16);
                DeleteList(head16, tail16);
                break;
            case '4':
                switch (f)
                {
                case '1':
                    QueueFillInc(n, head32, tail32);
                    break;
                case '2':
                    QueueFillDec(n, head32, tail32);
                    break;
                case '3':
                    QueueFillRand(n, head32, tail32);
                    break;
                }
                system("CLS");
                M_theoretical = 4 * (n + 256);
                cout << "***********************��������� ������***********************" << endl;
                PrintList(head32, tail32);
                cout << "************��������������� �� ����������� ������ ************" << endl;
                DigitalSort(head32, tail32, temp, 0);
                M_real = temp;
                PrintList(head32, tail32);
                cout << "**************��������������� �� �������� ������**************" << endl;
                DigitalSort(head32, tail32, temp, 1);
                PrintList(head32, tail32);
                DeleteList(head32, tail32);
                break;
            }
            cout << endl
                 << "M_theoretical = " << M_theoretical << endl
                 << "C_theoretical = " << C_theoretical << endl
                 << "M_real = " << M_real << endl
                 << "C_real = 0" << endl;
            cout << "**************************************************************" << endl;
            cout << "         ������� ����� ������� ��� ����������� ..." << endl;
            _getch();
            break;

        case 27:
            return 0;
        }
    } while (1);
    return 0;
}
