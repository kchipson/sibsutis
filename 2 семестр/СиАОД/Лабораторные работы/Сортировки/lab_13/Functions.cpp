
#include "Filling_method.h"
#include <graphics.h>
#include "Checks.h"
#include "Sorting_method.h"
#include <conio.h>
#include <iostream>
#include <math.h>

using namespace std;
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
void PrintList(tLE16 *head, tLE16 *tail)
{
    tLE16 *p;
    int q = 0;

    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
    cout << "[" << head << "]" << endl;
    for (p = head; p; p = p->next)
    {
        if (q == 5)
        {
            cout << endl;
            q = 0;
        }
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 3));
        cout << "[" << p << "]";
        cout.width(10);
        cout.setf(ios::left);
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
        cout << p->data;
        q++;
    }
    if (tail != NULL)
    {
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
        cout << endl
             << "[" << tail << "]" << endl;
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
    }
    cout << endl
         << " Контрольная сумма: " << CheckSum(head);
    cout << endl
         << " Число серий: " << RunNumber(head);
    cout << endl;
} //Вывод в терминал

void PrintList(tLE32 *head, tLE32 *tail)
{
    tLE32 *p;
    int q = 0;

    SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
    cout << "[" << head << "]" << endl;
    for (p = head; p; p = p->next)
    {
        if (q == 5)
        {
            cout << endl;
            q = 0;
        }
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 3));
        cout << "[" << p << "]";
        cout.width(10);
        cout.setf(ios::left);
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
        cout << p->data;
        q++;
    }
    if (tail != NULL)
    {
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
        cout << endl
             << "[" << tail << "]" << endl;
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7));
    }
    cout << endl
         << " Контрольная сумма: " << CheckSum(head);
    cout << endl
         << " Число серий: " << RunNumber(head);
    cout << endl;
} //Вывод в терминал

void DeleteList(tLE16 *(&head), tLE16 *(&tail))
{

    tLE16 *p, *t;
    for (p = head; p; p = t)
    {
        t = p->next;
        delete p;
        /*         SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
        cout << endl
             << "DELETE [" << p << "]" << endl;
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7)); */
    }
    head = tail = NULL;
}
void DeleteList(tLE32 *(&head), tLE32 *(&tail))
{

    tLE32 *p, *t;
    for (p = head; p; p = t)
    {
        t = p->next;
        delete p;
        /*         SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 4));
        cout << endl
             << "DELETE [" << p << "]" << endl;
        SetConsoleTextAttribute(hConsole, (WORD)((0 << 4) | 7)); */
    }
    head = tail = NULL;
}
