#include <iostream>
#include <conio.h>
#include "Additions/Filling_method.h"
#include "Additions/Output.h"
#include "Additions/Checks.h"
#include "Additions/Sorting_method.h"

using namespace std;

//������������� ������ ���������� ��������� � ��������� (� � �)
double M_theoretical = 0, C_theoretical = 0;
//����������� �������� ���������� ��������� � ��������� (� � �)
int M_real = 0, C_real = 0;

int choice()
{
    int t;
    cout << endl
         << "C���������:" << endl
         << "1.SelectSort (����� ������� ������)" << endl
         << "2.BubbleSort (����� ��������)" << endl
         << "3.ShakerSort (��������� ����������)" << endl
         << "4.InsertSort (����� ������� ���������)" << endl
         << "5.ShellSort (����� �����)" << endl
         //<<"6.BSearch1 � BSearch2"<<endl
         << "�����: ";

    cin >> t;
    return t;
}

void type(int x)
{
    int t, n, X;
    int* A;
    if (x == 1) {
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
        cin >> t;
        switch (t) {
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
        t = choice();
        cout << "**************************************************************";
        PrintMas(A, n, false);
        switch (t) {
        case 1:
            SelectSort(A, n);
            break;
        case 2:
            BubbleSort(A, n);
            break;
        case 3:
            ShakerSort(A, n);
            break;
        case 4:
            InsertSort(A, n);
            break;
        case 5:
            ShellSort(A, n);
            break;
        }
        PrintMas(A, n, true);
        cout << "**************************************************************";
        delete A;
    }

    if (x == 2) {
        system("CLS");
        cout << "������� n: ";
        cin >> n;
        A = new int[n];
        FillRand(A, n);
        ShellSort(A, n);

        cout << endl
             << "�������� ������ ������ ��������:" << endl
             << "1.BSearch1" << endl
             << "2.BSearch2" << endl
             << "3.BSearch1 � BSearch2" << endl
             << "�����: ";
        cin >> t;

        cout << endl
             << "������: " << endl;
        int tm=0;
        for (int i = 0; i < n; i++){
            tm++;
            cout.width(10); 
            cout <<"A["<<i<<"]="<< A[i]<<"   ";
            if (tm==5){
                tm=0;
                cout<<endl;
            }
        }

        cout << endl
             << "������� ��������: " << endl;
        cin >> X;
        switch (t) {
        case 1:
            if (BSearch1(A, n, X) == -1)
                cout << "������� ������� �� ������!" << endl;
            else
                cout << endl
                     << "������� ������� ��������� � " << BSearch1(A, n, X) << " �������" << endl;
            cout << endl
                 << "����� ������������� ���������: " << C_theoretical;
            cout << endl
                 << "����� ���������: " << C_real;
            cout << endl;
            break;
        case 2:
            if (BSearch2(A, n, X) == -1)
                cout << "������� ������� �� ������!" << endl;
            else
                cout << endl
                     << "������� ������� ��������� � " << BSearch2(A, n, X) << " �������" << endl;
            cout << endl
                 << "����� ������������� ���������: " << C_theoretical;
            cout << endl
                 << "����� ���������: " << C_real;
            cout << endl;
            break;
        case 3:
            cout << "******************** Bsearch1 ********************" << endl;
            if (BSearch1(A, n, X) == -1)
                cout << "������� ������� �� ������!" << endl;
            else
                cout << endl
                     << "������� ������� ��������� � " << BSearch1(A, n, X) << " �������" << endl;
            cout << endl
                 << "����� ������������� ���������: " << C_theoretical;
            cout << "����� ���������: " << C_real;
            cout << endl
                 << endl;
            cout << "******************** Bsearch2 ********************" << endl;
            if (BSearch2(A, n, X) == -1)
                cout << "������� ������� �� ������!" << endl;
            else
                cout << endl
                     << "������� ������� ��������� � " << BSearch2(A, n, X) << " �������" << endl;
            cout << endl
                 << "����� ������������� ���������: " << C_theoretical;
            cout << "����� ���������: " << C_real;
            cout << endl
                 << endl;
            break;
        }
        delete A;
    }

    if (x == 3) {
        t = choice();
        switch (t) {
        case 1:
            statistics_sort(1);
            break;
        case 2:
            statistics_sort(2);
            break;
        case 3:
            statistics_sort(3);
            break;
        case 4:
            statistics_sort(4);
            break;
        case 5:
            statistics_sort(5);
            break;
        case 6:
            statistics_sort(6);
            break;
        }
    }
}
int main()
{
    setlocale(LC_ALL, "Russian");
    system("CLS");

    int t;
    do {
        system("CLS");
        cout
            << "1. ����������" << endl
            << "2. ����� " << endl
            << "3. ���������� " << endl
            << "�����: ";
        cin >> t;

        switch (t) {
        case 1:
            type(1);
            break;
        case 2:
            type(2);
            break;
        case 3:
            type(3);
            break;
        }
        cout << " \nPress [Esc] to exit \n";

    } while (_getch() != 27);
    return 0;
}
