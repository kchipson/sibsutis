
#include "Filling_method.h"
#include <graphics.h>
#include "Checks.h"
#include "Sorting_method.h"
#include <conio.h>
#include <iostream>
#include <math.h>

using namespace std;
HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
void PrintList(tLE *head, tLE *tail = NULL)
{
    tLE *p;
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

void DeleteList(tLE *(&head), tLE *(&tail))
{

    tLE *p, *t;
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

//*************************   КОНСТАНТЫ(Начало)   *************************
//Общие
int screen_width = GetSystemMetrics(SM_CXSCREEN), screen_height = GetSystemMetrics(SM_CYSCREEN); // Задание размеров окна
int *A;                                                                                          // Массив
int n;                                                                                           //Размерность массива

//Таблица
char temp[12];                              //Временная переменная для функции itoa()
int border_null_x = 50, border_null_y = 45; //Точка отсчета для таблицы (левый верхний угол)
int height = 60, width = 200;               //Высота и ширина клетки

//*************************   КОНСТАНТЫ(Конец )   *************************

void statistics()
{
    int M_real = 0, C_real = 0;
    initwindow(screen_width, screen_height); // открыть окно графики
    // -----------------------------------------------------------------------------
    // -00000000000000-000000--00000000-000000--000000-00000000000000----00000000---
    // -00111111111100-001100--00111100-001100--001100-00111111111100----00111100---
    // -00110000001100-001100--00110000-001100--001100-00110000001100----00001100---
    // -001100--001100-001100--001100---001100--001100-001100--001100------001100---
    // -001100--001100-00110000001100---00110000001100-001100--001100------001100---
    // -001100--001100-00111111111100---00111111111100-001100--001100------001100---
    // -001100--001100-00110000001100---00110000001100-001100--001100------001100---
    // -001100--001100-001100--001100---001100--001100-001100--001100------001100---
    // -00110000001100-001100--00110000-001100--001100-00110000001100----0000110000-
    // -00111111111100-001100--00111100-001100--001100-00111111111100----0011111100-
    // -00000000000000-000000--00000000-000000--000000-00000000000000----0000000000-
    // -----------------------------------------------------------------------------

    //***************************   ТАБЛИЦА(Начало)   ***************************

    settextstyle(8, 0, 1); // Задание стиля текста
    setcolor(9);           // Задание цвета

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y);          //Верхняя граница шапки
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //Правая граница шапки
    lineto(border_null_x, border_null_y + height);                     //Нижняя граница шапки
    lineto(border_null_x, border_null_y);                              //Левая граница шапки

    outtextxy(border_null_x + width * 3, border_null_y + height / 4, (char *)"MergeSort"); // Вывод

    for (n = 1; n < 7; n++)
    { //горизонтальные линии
        //outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * (1.2 + 5), border_null_y + height * (1 + n));
    }

    line(border_null_x + width * (1.2 + 5), border_null_y + height, border_null_x + width * (1.2 + 5), border_null_y + height * 7); //Правая граница
    line(border_null_x, border_null_y + height, border_null_x, border_null_y + height * 7);                                         //Левая граница
    line(border_null_x + width * (1.5), border_null_y + height, border_null_x + width * (1.5), border_null_y + height * 7);
    for (n = 1; n < 3; n++)
    {
        line(border_null_x + width * (1.5 + 1.56 * n), border_null_y + height, border_null_x + width * (1.5 + 1.56 * n), border_null_y + height * 7);
    }

    setcolor(15); // Задание цвета (15-белый)
    outtextxy(border_null_x + width * (0.75), border_null_y + height + (height / 3.5), (char *)"n");
    outtextxy(border_null_x + width * (1.5 + 1.56) - width * (0.85), border_null_y + height + (height / 3.5), (char *)"Inc");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 2) - width * (0.85), border_null_y + height + (height / 3.5), (char *)"Dec");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 3) - width * (0.9), border_null_y + height + (height / 3.5), (char *)"Rand");

    setcolor(3); // Задание цвета
    for (n = 1; n < 6; n++)
    {
        outtextxy(border_null_x + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(n * 100, temp, 10));
    }

    //***************************   ТАБЛИЦА(Конец )   ***************************

    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Начало)   *********************
    tLE *head = NULL, *tail = NULL;

    setcolor(15); // Задание цвета (15-белый)

    for (n = 1; n < 6; n++)
    {
        QueueFillInc(n * 100, head, tail);
        MergeSort(head, tail, C_real, M_real);
        DeleteList(head, tail);
        outtextxy(border_null_x + width * (1.5) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }

    for (n = 1; n < 6; n++)
    {
        QueueFillDec(n * 100, head, tail);
        MergeSort(head, tail, C_real, M_real);
        DeleteList(head, tail);
        outtextxy(border_null_x + width * (1.5 + 1.56) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }

    for (n = 1; n < 6; n++)
    {
        QueueFillRand(n * 100, head, tail);
        MergeSort(head, tail, C_real, M_real);
        DeleteList(head, tail);
        outtextxy(border_null_x + width * (1.5 + 1.56 * 2) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }
    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Конец )   *********************

    getch();
    closegraph(); // закрываем графическое окно
}