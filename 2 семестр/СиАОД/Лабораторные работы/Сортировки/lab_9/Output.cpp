#include "Checks.h"
#include "Sorting_method.h"
#include "Filling_method.h"
#include <graphics.h>
#include <conio.h>
#include <iostream>
#include <math.h>
using namespace std;

extern int M_real, C_real;
extern double M_theoretical, C_theoretical;

void PrintMas(int* A, int n, bool sorted = false)
{ //Вывод в терминал

    if (!sorted) { //Если неотсортированный
        cout << endl
             << "Начальный массив: " << endl;
        for (int i = 0; i < n; i++)
            cout << A[i] << " ";

        cout << endl
             << "Контрольная сумма в начальном массиве: " << CheckSum(A, n) << endl;
        cout << "Число неубывающих серий в начальном массиве: " << RunNumber(A, n)
             << endl;
    }
    else { //Если отсортированный
        cout << endl
             << "Отсортированный массив: " << endl;
        for (int i = 0; i < n; i++)
            cout << A[i] << " ";
        cout << endl
             << "Контрольная сумма в отсортированном массиве: " << CheckSum(A, n)
             << endl;
        cout << "Число неубывающих серий в отсортированном массиве: "
             << RunNumber(A, n) << endl;

        //cout << endl
        //     << "* Число теоретических сравнений: " << C_theoretical;
        cout << endl
             << "Число фактических сравнений: " << C_real;
        //cout << endl
        //     << "* Число теоретических перестановок: " << M_theoretical;
        cout << endl
             << "Число фактических перестановок: " << M_real << endl;

        // cout << endl
        //      << "Число теоретических сравнений + перестановок: "
        //      << C_theoretical + M_theoretical;
        cout << endl
             << "Число фактических сравнений + перестановок: " << C_real + M_real
             << endl;
    }
}

void graph()
{
    //*************************   КОНСТАНТЫ(Начало)   *************************
    //Общие
    int screen_width = GetSystemMetrics(SM_CXSCREEN), screen_height = GetSystemMetrics(SM_CYSCREEN); // Задание размеров окна
    int* A; // Массив
    int n; //Размерность массива

    //Таблица
    char temp[10]; //Временная переменная для функции itoa()
    int border_null_x = 50, border_null_y = 45; //Точка отсчета для таблицы (левый верхний угол)
    int height = 60, width = 200; //Высота и ширина клетки

    //*************************   КОНСТАНТЫ(Конец )   *************************

    initwindow(screen_width, screen_height); // открыть окно графики

    //***************************   ТАБЛИЦА(Начало)   ***************************

    settextstyle(8, 0, 1); // Задание стиля текста
    setcolor(9); // Задание цвета

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //Верхняя граница шапки
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //Правая граница шапки
    lineto(border_null_x, border_null_y + height); //Нижняя граница шапки
    lineto(border_null_x, border_null_y); //Левая граница шапки

    outtextxy(border_null_x + width * 3, border_null_y + height / 4, (char*)"HeapSort"); // Вывод

    for (n = 1; n < 7; n++) { //горизонтальные линии
        //outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * (1.2 + 5), border_null_y + height * (1 + n));
    }

    line(border_null_x + width * (1.2 + 5), border_null_y + height, border_null_x + width * (1.2 + 5), border_null_y + height * 7); //Правая граница
    line(border_null_x, border_null_y + height, border_null_x, border_null_y + height * 7); //Левая граница
    line(border_null_x + width * (1.5), border_null_y + height, border_null_x + width * (1.5), border_null_y + height * 7);
    for (n = 1; n < 3; n++) {
        line(border_null_x + width * (1.5 + 1.56 * n), border_null_y + height, border_null_x + width * (1.5 + 1.56 * n), border_null_y + height * 7);
    }

    setcolor(15); // Задание цвета (15-белый)
    outtextxy(border_null_x + width * (0.75), border_null_y + height + (height / 3.5), (char*)"n");
    outtextxy(border_null_x + width * (1.5 + 1.56) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 2) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 3) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");

    setcolor(3); // Задание цвета
    for (n = 1; n < 6; n++) {
        outtextxy(border_null_x + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(n * 100, temp, 10));
    }

    //***************************   ТАБЛИЦА(Конец )   ***************************

    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Начало)   *********************
    setcolor(15); // Задание цвета (15-белый)

    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillInc(A, n*100);
        HeapSort(A, n*100);
        outtextxy(border_null_x + width * (1.5) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa((M_real+C_real), temp, 10));
    }

    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillDec(A, n*100);
        HeapSort(A, n*100);
        outtextxy(border_null_x + width * (1.5 + 1.56) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa((M_real+C_real), temp, 10));
    }

    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillRand(A, n*100);
        HeapSort(A, n*100);
        outtextxy(border_null_x + width * (1.5 + 1.56 * 2) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa((M_real+C_real), temp, 10));
    }
    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Конец )   *********************

    int k = getch();
    while (k != '\r')
        k = getch(); // если не нажата Esc
    closegraph(); // закрываем графическое окно
}