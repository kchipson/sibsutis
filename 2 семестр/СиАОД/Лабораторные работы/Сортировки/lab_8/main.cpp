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
    cout <<endl<< "            ÍÀ×ÀËÜÍÛÉ ÑÏÈÑÎÊ\n";
    for (i = 0; i < structSize; i += 1) {
        cout << data[i].surname << " " << data[i].name
             << endl
             << "  Íîìåð: " << data[i].number
             << endl
             << "  Email: " << data[i].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }
    system("pause");
    SortByField(data, surnameSort, "surname"); //sortByField(Ñïèñîê, èíäåêñíûé ìàññèâ , ïîëå ñîðòèðîâêè);
    SortByField(data, emailSort, "email"); //sortByField(Ñïèñîê, èíäåêñíûé ìàññèâ , ïîëå ñîðòèðîâêè);
    cout << endl
         << "++++++++++++++++++++++++++++++++++++++++";
    cout << endl
         << "    ÎÒÑÎÐÒÈÐÎÂÀÍÍÛÉ ÏÎ ÔÀÌÈËÈÈ ÑÏÈÑÎÊ\n";
    for (i = 0; i < structSize; i += 1) {
        temp = surnameSort[i];
        cout << data[temp].surname << " " << data[temp].name
             << endl
             << "  Íîìåð: " << data[temp].number
             << endl
             << "  Email: " << data[temp].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }

    system("pause");
    cout << endl
         << "++++++++++++++++++++++++++++++++++++++++";
    cout << endl
         << "    ÎÒÑÎÐÒÈÐÎÂÀÍÍÛÉ ÏÎ EMAIL ÑÏÈÑÎÊ\n";
    for (i = 0; i < structSize; i += 1) {
        temp = emailSort[i];
        cout << data[temp].surname << " " << data[temp].name
             << endl
             << "  Íîìåð: " << data[temp].number
             << endl
             << "  Email: " << data[temp].email;
        cout << "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
    }

    delete[] data;
    data = NULL;
    return 0;
}
