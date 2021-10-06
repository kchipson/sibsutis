#include "Checks.h"
#include "Sorting_method.h"
#include "Filling_method.h"
#include <graphics.h>
#include <conio.h>
#include <iostream>
#include <math.h>
using namespace std;

extern int M_real, C_real,Depth,Depth_max;
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

        cout << endl
             << "* Число теоретических сравнений: " << C_theoretical;
        cout << endl
             << "Число фактических сравнений: " << C_real;
        cout << endl
             << "* Число теоретических перестановок: " << M_theoretical;
        cout << endl
             << "Число фактических перестановок: " << M_real << endl;

        cout << endl
             << "Число теоретических сравнений + перестановок: "
             << C_theoretical + M_theoretical;
        cout << endl
             << "Число фактических сравнений + перестановок: " << C_real + M_real
             << endl;
    }
}

//*************************   КОНСТАНТЫ(Начало)   *************************
//Общие
int screen_width = GetSystemMetrics(SM_CXSCREEN), screen_height = GetSystemMetrics(SM_CYSCREEN); // Задание размеров окна
int* A; // Массив
int n; //Размерность массива

//Таблица
char temp[12]; //Временная переменная для функции itoa()
int border_null_x = 50, border_null_y = 45; //Точка отсчета для таблицы (левый верхний угол)
int height = 60, width = 200; //Высота и ширина клетки

//График
int origin_x = screen_width * 0.05, origin_y = screen_height * 0.85; //Точка отсчета для Графика (левый нижний угол)
int x_step = 100, y_step = 2; //Шаг по x и y
int x_coefficient = 1, y_coefficient = 15; // Коэффициент step'a
int signature_step_x = 50, signature_step_y = 10; // Подпись цены деления

//*************************   КОНСТАНТЫ(Конец )   *************************

void graph(int sort, int color, int fill = 3)
{
    setcolor(color); // Задание цвета
    moveto(origin_x, origin_y);
    int n = x_step;

    while ((origin_x + n * x_coefficient) < screen_width * 0.97) {
        A = new int[n];
        switch (fill) {
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
        switch (sort) {
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
        case 6:
            HeapSort(A, n);
            break;
        case 7:
            C_real = 0;
            M_real = 0;
            QuickSortV1(A, n - 1);
            break;
        }

        lineto(origin_x + n * x_coefficient, origin_y - (C_real + M_real) / 1000 * y_coefficient);
        delete A;
        n += x_step;
    }
}

void statistics()
{

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
    setcolor(9); // Задание цвета

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //Верхняя граница шапки
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //Правая граница шапки
    lineto(border_null_x, border_null_y + height); //Нижняя граница шапки
    lineto(border_null_x, border_null_y); //Левая граница шапки

    outtextxy(border_null_x + width * 3, border_null_y + height / 4, (char*)"QuickSortV1"); // Вывод

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
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillInc(A, n*100);
        C_real = 0;
        M_real = 0;
        QuickSortV1(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillDec(A, n*100);
        C_real = 0;
        M_real = 0;
        QuickSortV1(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 + 1.56) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillRand(A, n*100);
        C_real = 0;
        M_real = 0;
        QuickSortV1(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 + 1.56 * 2) + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(M_real + C_real, temp, 10));
    }
    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Конец )   *********************
    getch();
    setfillstyle(1, 0);
    bar(0, 0, screen_width, screen_height);
    // ---------------------------------------------------------------------------------
    // -00000000000000-000000--00000000-000000--000000-00000000000000----00000000000000-
    // -00111111111100-001100--00111100-001100--001100-00111111111100----00111111111100-
    // -00110000001100-001100--00110000-001100--001100-00110000001100----00000000001100-
    // -001100--001100-001100--001100---001100--001100-001100--001100------------001100-
    // -001100--001100-00110000001100---00110000001100-001100--001100----00000000001100-
    // -001100--001100-00111111111100---00111111111100-001100--001100----00111111111100-
    // -001100--001100-00110000001100---00110000001100-001100--001100----00110000000000-
    // -001100--001100-001100--001100---001100--001100-001100--001100----001100---------
    // -00110000001100-001100--00110000-001100--001100-00110000001100----00110000000000-
    // -00111111111100-001100--00111100-001100--001100-00111111111100----00111111111100-
    // -00000000000000-000000--00000000-000000--000000-00000000000000----00000000000000-
    // ---------------------------------------------------------------------------------

    //************************   ГРАФИК_Null(Начало)  *************************
    //Ось X
    moveto(origin_x, origin_y); //В начальное положение
    lineto(screen_width * 0.99, origin_y);

    //Стрелочка
    lineto(screen_width * 0.98, origin_y - screen_height * 0.01);
    moveto(screen_width * 0.99, origin_y);
    lineto(screen_width * 0.98, origin_y + screen_height * 0.01);
    setcolor(6);
    outtextxy(screen_width * 0.98, origin_y + screen_height * 0.02, (char*)"n");
    setcolor(15);

    n = x_step;
    while ((origin_x + n * x_coefficient) < screen_width * 0.97) {
        if (n % signature_step_x == 0) {
            setcolor(6);
            outtextxy(origin_x + n * x_coefficient - screen_width * 0.01, origin_y + screen_height * 0.02, itoa(n, temp, 10));
        }
        moveto(origin_x + n * x_coefficient, origin_y - screen_height * 0.005);
        lineto(origin_x + n * x_coefficient, origin_y + screen_height * 0.005);
        setcolor(15);
        n += x_step;
    }

    //Ось Y
    moveto(origin_x, origin_y); //В начальное положение
    lineto(origin_x, 0 + screen_height * 0.01);

    //Стрелочка
    lineto(origin_x * 0.85, screen_height * 0.03);
    moveto(origin_x, 0 + screen_height * 0.01);
    lineto(origin_x * 1.15, screen_height * 0.03);
    setcolor(6);
    outtextxy(origin_x * 0.2, screen_height * 0.01, (char*)"M+C,k");

    setcolor(15);
    n = y_step;
    while ((origin_y - n * y_coefficient) > screen_height * 0.05) {
        if (n % signature_step_y == 0) {
            setcolor(6);
            outtextxy(origin_x * 0.2, origin_y - n * y_coefficient - screen_height * 0.012, itoa(n, temp, 10));
        }
        moveto(origin_x - screen_width * 0.003, origin_y - n * y_coefficient);
        lineto(origin_x + screen_width * 0.004, origin_y - n * y_coefficient);
        setcolor(15);
        n += y_step;
    }
    //************************   ГРАФИК_Null(Конец )  *************************

    //**************************   ГРАФИК(Начало)   ***************************
    /*!Сортировки:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
                5) ShellSort
                6) HeapSort
                7) QuickSortV1

              ! Заполение:
                1) FillInc
                2) FillDec
                3) Random
        graph(Сортировка, Цвет, Заполение);  
        */

    graph(5, 2);
    graph(6, 4);
    graph(7, 5);

    setcolor(2); // Задание цвета
    outtextxy(origin_x * 2, origin_y * 0.05, (char*)"ShellSort");
    setcolor(4); // Задание цвета
    outtextxy(origin_x * 2, origin_y * 0.1, (char*)"HeapSort");
    setcolor(5); // Задание цвета
    outtextxy(origin_x * 2, origin_y * 0.15, (char*)"QuickSortV1");

    //**************************   ГРАФИК(Конец )   ***************************
    getch();
    setfillstyle(1, 0);
    bar(0, 0, screen_width, screen_height);

    // ---------------------------------------------------------------------------------
    // -00000000000000-000000--00000000-000000--000000-00000000000000----00000000000000-
    // -00111111111100-001100--00111100-001100--001100-00111111111100----00111111111100-
    // -00110000001100-001100--00110000-001100--001100-00110000001100----00000000001100-
    // -001100--001100-001100--001100---001100--001100-001100--001100------------001100-
    // -001100--001100-00110000001100---00110000001100-001100--001100----00000000001100-
    // -001100--001100-00111111111100---00111111111100-001100--001100----00111111111100-
    // -001100--001100-00110000001100---00110000001100-001100--001100----00000000001100-
    // -001100--001100-001100--001100---001100--001100-001100--001100------------001100-
    // -00110000001100-001100--00110000-001100--001100-00110000001100----00000000001100-
    // -00111111111100-001100--00111100-001100--001100-00111111111100----00111111111100-
    // -00000000000000-000000--00000000-000000--000000-00000000000000----00000000000000-
    // ---------------------------------------------------------------------------------

    //***************************   ТАБЛИЦА(Начало)   ***************************

    settextstyle(8, 0, 1); // Задание стиля текста
    setcolor(9); // Задание цвета

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //Верхняя граница шапки
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //Правая граница шапки
    lineto(border_null_x, border_null_y + height); //Нижняя граница шапки
    lineto(border_null_x, border_null_y); //Левая граница шапки

    outtextxy(border_null_x + width * 2.35, border_null_y + height / 4, (char*)"QuickSortV1"); // Вывод
    outtextxy(border_null_x + width * 4.75, border_null_y + height / 4, (char*)"QuickSortV2"); // Вывод

    for (n = 1; n < 7; n++) { //горизонтальные линии
        //outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * (1.2 + 5), border_null_y + height * (1 + n));
    }

    line(border_null_x + width * (1.2 + 5), border_null_y + height, border_null_x + width * (1.2 + 5), border_null_y + height * 7); //Правая граница
    line(border_null_x, border_null_y + height, border_null_x, border_null_y + height * 7); //Левая граница
    line(border_null_x + width * (1.5), border_null_y + height, border_null_x + width * (1.5), border_null_y + height * 7); // Ограничение "N"

    for (n = 1; n < 6; n++) {
        line(border_null_x + width * (1.5 + 1.56 * float(n) / 2), border_null_y + height, border_null_x + width * (1.5 + 1.56 * float(n) / 2), border_null_y + height * 7);
    }

    setcolor(15); // Задание цвета (15-белый)
    outtextxy(border_null_x + width * (0.75), border_null_y + height + (height / 3.5), (char*)"n");
    outtextxy(border_null_x + width * (1.5 + 1.15) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 + 1.95) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 + 2.75) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 1.15) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 1.95) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 2.75) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");
    setcolor(3); // Задание цвета
    for (n = 1; n < 6; n++) {
        outtextxy(border_null_x + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(n * 100, temp, 10));
    }

    //***************************   ТАБЛИЦА(Конец )   ***************************

    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Начало)   *********************
    setcolor(15); // Задание цвета (15-белый)

    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillInc(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV1(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillDec(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV1(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 + 0.75) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillRand(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV1(A, n*100- 1);
        outtextxy(border_null_x + width * (1.5 + 1.5) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillInc(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV2(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 * 3-0.7) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillDec(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV2(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 * 3 + 0.05) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    C_real = 0;
    M_real = 0;
    for (n = 1; n < 6; n++) {
        A = new int[n*100];
        FillRand(A, n*100);
        Depth=0;
        Depth_max=0;
        QuickSortV2(A, n*100 - 1);
        outtextxy(border_null_x + width * (1.5 * 3+0.8) + width * (0.4), border_null_y + height * (1 + n) + (height / 3.5), itoa(Depth_max, temp, 10));
    }
    //*********************   ЗАПОЛНЕНИЕ ТАБЛИЦЫ (Конец )   *********************
    getch();
    closegraph(); // закрываем графическое окно
}