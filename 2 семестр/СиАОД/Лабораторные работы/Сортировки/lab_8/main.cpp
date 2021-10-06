#include <iostream>
#include <cstdlib>
#include <string>
#include "Additions/Structure.h"
#include "Additions/Functions.h"
using namespace std;

int main()
{
    system("cls");
    setlocale(LC_ALL, "Russian");
    int i, temp;
    phone_book* data;
    data = generateStructure();

    int surnameSort[structSize];
    int emailSort[structSize];
    cout << endl
         << "++++++++++++++++++++++++++++++++++++++++";
    cout <<endl<< "            ��������� ������\n";
    for (i = 0; i < structSize; i += 1) {
        cout << data[i].surname << " " << data[i].name
             << endl
             << "  �����: " << data[i].number
             << endl
             << "  Email: " << data[i].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }
    system("pause");
    SortByField(data, surnameSort, "surname"); //sortByField(������, ��������� ������ , ���� ����������);
    SortByField(data, emailSort, "email"); //sortByField(������, ��������� ������ , ���� ����������);
    cout << endl
         << "++++++++++++++++++++++++++++++++++++++++";
    cout << endl
         << "    ��������������� �� ������� ������\n";
    for (i = 0; i < structSize; i += 1) {
        temp = surnameSort[i];
        cout << data[temp].surname << " " << data[temp].name
             << endl
             << "  �����: " << data[temp].number
             << endl
             << "  Email: " << data[temp].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }

    system("pause");
    cout << endl
         << "++++++++++++++++++++++++++++++++++++++++";
    cout << endl
         << "    ��������������� �� EMAIL ������\n";
    for (i = 0; i < structSize; i += 1) {
        temp = emailSort[i];
        cout << data[temp].surname << " " << data[temp].name
             << endl
             << "  �����: " << data[temp].number
             << endl
             << "  Email: " << data[temp].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }

    delete[] data;
    data = NULL;
    return 0;
}
