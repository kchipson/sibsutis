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
    char temp[10]; //Временная переменная для функции itoa()
    int border_null_x = 15, border_null_y = 45; //Точка отсчета для таблицы (левый верхний угол)
    int height = 60, width = 100; //Высота и ширина клетки

    //График
    int origin_x = screen_width * 0.5, origin_y = screen_height * 0.85; //Точка отсчета для Графика (левый нижний угол)
    int x_step = 25, y_step = 25; //Шаг по x
    int x_coefficient=1,y_coefficient=2; // Коэффициент step'a
    int signature_step=50; // Подпись цены деления

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
        }

        lineto(origin_x + n * x_coefficient, origin_y - (C_real + M_real) / 1000 * y_coefficient);
        delete A;
        n += x_step;
    }
}

void statistics_sort(int sort)
{  
    
    initwindow(screen_width, screen_height); // открыть окно графики
//***************************   ШАПКА(Начало)   ***************************

    // 1 столбец- 120 px, 2-6 столбцы - 100
    settextstyle(8, 0, 1); // Задание стиля текста
    setcolor(5); // Задание цвета (5-пурпурный)

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //Верхняя граница шапки
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //Правая граница шапки
    lineto(border_null_x, border_null_y + height); //Нижняя граница шапки
    lineto(border_null_x, border_null_y); //Левая граница шапки

    outtextxy(border_null_x + width * 0.6, border_null_y + height / 4, (char*)"n"); // Вывод n в шапке

    for (n = 1; n < 6; n++) {
        outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x + width * (1.2 + n - 1), border_null_y, border_null_x + width * (1.2 + n - 1), border_null_y + height);
    }

    setcolor(15); // Задание цвета (15-белый)
//***************************   ШАПКА(Конец )   ***************************

//************************   ГРАФИК_Null(Начало)  *************************
    //Ось X
    moveto(origin_x, origin_y); //В начальное положение
    lineto(screen_width * 0.99, origin_y);

    //Стрелочка
		    lineto(screen_width * 0.98, origin_y - screen_height * 0.01);
		    moveto(screen_width * 0.99, origin_y);
		    lineto(screen_width * 0.98, origin_y + screen_height * 0.01);
		    setcolor(6); outtextxy(screen_width * 0.98, origin_y + screen_height * 0.02, (char*)"n"); setcolor(15);

    n = x_step;
    while ((origin_x + n*x_coefficient) < screen_width * 0.97) {
        if (n % signature_step == 0) {
            setcolor(6);
            outtextxy(origin_x + n*x_coefficient - screen_width * 0.01, origin_y + screen_height * 0.02, itoa(n, temp, 10));
        }
        moveto(origin_x + n*x_coefficient, origin_y - screen_height * 0.005);
        lineto(origin_x + n*x_coefficient, origin_y + screen_height * 0.005);
        setcolor(15);
        n += x_step;
    }

    //Ось Y
    moveto(origin_x, origin_y); //В начальное положение
    lineto(origin_x, 0 + screen_height * 0.01);

    //Стрелочка
			lineto(origin_x* 0.99, screen_height * 0.03);
			moveto(origin_x, 0 + screen_height * 0.01);
			lineto(origin_x*1.01, screen_height * 0.03);
			setcolor(6); outtextxy(origin_x*1.015, screen_height * 0.01,(char*)"M+C,k"); setcolor(15);

    n = y_step;
    while ((origin_y - n*y_coefficient) > screen_height * 0.05) {
        if (n % signature_step == 0) {
            setcolor(6);
            outtextxy(origin_x * 1.010, origin_y - n*y_coefficient - screen_height * 0.012, itoa(n, temp, 10));
        }
        moveto(origin_x - screen_width * 0.003, origin_y - n*y_coefficient);
        lineto(origin_x + screen_width * 0.004, origin_y - n*y_coefficient);
        setcolor(15);
        n += y_step;
    }
//************************   ГРАФИК_Null(Конец )  *************************

//**************************   ТАБЛИЦА(Начало)   **************************

    moveto(border_null_x, border_null_y + height);
    switch (sort) {
    case 1:
        setfillstyle(1, 9); // сплошная заливка экрана
        bar(0, 0, screen_width, screen_height); // заливаем экран
        settextstyle(8, 6, 8);
        outtextxy(screen_width / 2 - screen_width / 3.5,
            screen_height / 2 - screen_height / 8,
            (char*)"НЕ РЕАЛИЗОВАНО! ");
        break;
    case 2:
        setfillstyle(1, 9); // сплошная заливка экрана
        bar(0, 0, screen_width, screen_height); // заливаем экран
        settextstyle(8, 6, 8);
        outtextxy(screen_width / 2 - screen_width / 3.5,
            screen_height / 2 - screen_height / 8,
            (char*)"НЕ РЕАЛИЗОВАНО! ");
        break;

    case 3:
        lineto(border_null_x, border_null_y + height * 7); // левая граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 7);// нижняя граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // правая граница табл
        
        for (n = 0; n < 5; n++)  //Отрисовка горизонтальных линий внутри табл
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 7);
        
        line(border_null_x + width * 0.6, border_null_y + height,border_null_x + width * 0.6, border_null_y + height * 7); //Столбец n пополам
        for (n = 1; n < 7; n++) { //Отрисовка вертикальных линий внутри табл
            line(border_null_x + width * 1.2 / 2, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);
            if (n == 3)
                line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * 0.6, border_null_y + height * (1 + n));
        }
        settextstyle(8, 5, 1); // Задание стиля текста (Поворот на 90)
        setcolor(2); // Задание цвета (2-зеленый)
         outtextxy(border_null_x + width * 0.4, border_null_y + height * 1.2, (char*)"M+C BubbleSort");
        setcolor(3); // Задание цвета (3-бирюзовый)
         outtextxy(border_null_x + width* 0.4, border_null_y + height * (1.2 + 3), (char*)"M+C ShakerSort");

        settextstyle(8, 0, 1); // Задание стиля текста
        setcolor(15); // Задание цвета (15-белый)
        outtextxy(border_null_x + width * 0.7, border_null_y + height * 1.3, (char*)"Уб.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (1 + 1.3), (char*)"Ран.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (2 + 1.3), (char*)"Воз.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (3 + 1.3), (char*)"Уб.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (4 + 1.3), (char*)"Ран.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (5 + 1.3), (char*)"Воз.");

        for (int j = 0; j < 4; j += 3) { // Заполнение таблицы
            for (n = 100; n < 501; n += 100) {
                A = new int[n];
                for (int i = 0; i < 3; i++) {
                    M_real = 0, C_real = 0;
                    if (i == 0)
                        FillDec(A, n);
                    if (i == 1)
                        FillRand(A, n);
                    if (i == 2)
                        FillInc(A, n);
                    if (j==0)
                        BubbleSort(A, n);
                    else
                        ShakerSort(A,n);
                    outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height * (i + 1) + height * j+ height / 4, itoa(C_real + M_real, temp, 10));
                }
                delete A;
            }
        }
        break;
    case 4:
        lineto(border_null_x, border_null_y + height * 5); // левая граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 5); // нижняя граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // правая граница табл

        for (n = 0; n < 5; n++) //Отрисовка горизонтальных линий внутри табл
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 5);

        for (n = 1; n < 4; n++) //Отрисовка вертикальных линий внутри табл
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);

        setcolor(14);
        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 4, (char*)"Select"); // Вывод Select
        setcolor(2); // Задание цвета (2- зеленый)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*2+ height / 4, (char*)"Bubble"); // Вывод Bubble
        setcolor(3); // Задание цвета (3- бирюзовый)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*3+ height / 4, (char*)"Shaker"); // Вывод Shaker
        setcolor(4); // Задание цвета (4- красный)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*4+ height / 4, (char*)"Insert"); // Вывод Insert

        setcolor(15); // Задание цвета (15- белый)
        for (int j = 0; j < 4; j++) {
            for (n = 100; n < 501; n += 100) { // Заполнение таблицы
                A = new int[n];

                FillRand(A, n);

                if (j == 0)
                    SelectSort(A, n);
                else if (j == 1)
                    BubbleSort(A, n);
                else if (j == 2)
                    ShakerSort(A, n);
                else if (j == 3)
                    InsertSort(A, n);

                outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * j + height / 4, itoa(C_real + M_real, temp, 10));
            }
            delete A;
        }
        break;
    case 5:
        lineto(border_null_x, border_null_y + height * 4); // левая граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 4); // нижняя граница табл
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // правая граница табл

        for (n = 0; n < 5; n++) //Отрисовка горизонтальных линий внутри табл
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 4);

        for (n = 1; n < 3; n++) //Отрисовка вертикальных линий внутри табл
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);

        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 6, (char*)"Кол-во "); // Вывод
        outtextxy(border_null_x , border_null_y + height+ height / 2, (char*)"К-сортировок"); // Вывод
        setcolor(2);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*2+ height / 4, (char*)"Insert"); // Вывод
        setcolor(14);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*3+ height / 4, (char*)"Shell"); // Вывод
        setcolor(15);


        for (n = 100; n < 501; n += 100) { // Заполнение таблицы Insert
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 1 + height / 4, itoa(C_real + M_real, temp, 10));
            delete A;
        }
        for (n = 100; n < 501; n += 100) { // Заполнение таблицы Shell
            A = new int[n];
            FillRand(A, n);
            C_real = 0;
            M_real = 0;
            ShellSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 2 + height / 4, itoa(C_real + M_real, temp, 10));
            delete A;
        }
        

        for (n = 100; n < 501; n += 100) { // Заполнение таблицы k
		
            A = new int[n];
            FillRand(A, n);
            ShellSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height / 4, itoa((log2(n)-1), temp, 10));
            delete A;

        }
        break;
    case 6:
        setfillstyle(1, 0); // сплошная заливка экрана
        bar(0, 0, screen_width, screen_height); // заливаем экран
         // 1 столбец- 120 px, 2-6 столбцы - 100
        settextstyle(8, 0, 1); // Задание стиля текста
        setcolor(5); // Задание цвета (5-пурпурный)

        moveto(border_null_x, border_null_y);
        lineto(border_null_x + width * (1.2 + 10), border_null_y); //Верхняя граница шапки
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height); //Правая граница шапки
        lineto(border_null_x, border_null_y + height); //Нижняя граница шапки
        lineto(border_null_x, border_null_y); //Левая граница шапки

        outtextxy(border_null_x + width * 0.6, border_null_y + height / 4, (char*)"n"); // Вывод n в шапке

        for (n = 1; n < 11; n++) {
            outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
            line(border_null_x + width * (1.2 + n - 1), border_null_y, border_null_x + width * (1.2 + n - 1), border_null_y + height);
        }
        setcolor(15); // Задание цвета (15-белый)



        lineto(border_null_x, border_null_y + height * 3); // левая граница табл
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height * 3); // нижняя граница табл
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height); // правая граница табл

        for (n = 0; n < 10; n++) //Отрисовка горизонтальных линий внутри табл
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 3);

        for (n = 1; n < 2; n++) //Отрисовка вертикальных линий внутри табл
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 10, border_null_y + height + height * n);

        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 4, (char*)"Bsearch1 "); // Вывод
        setcolor(14);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*2+ height / 4, (char*)"Bsearch2"); // Вывод
        setcolor(15);


        for (n = 100; n < 1001; n += 100) { // Заполнение таблицы
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            BSearch1(A, n, A[1-1]);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 0 + height / 4, itoa(C_real, temp, 10));
            delete A;
        }
        for (n = 100; n < 1001; n += 100) { // Заполнение таблицы
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            BSearch2(A, n, A[1-1]);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 1 + height / 4, itoa(C_real, temp, 10));
            delete A;
        }
        
        break;
    }
//**************************   ТАБЛИЦА(Конец )   **************************

//**************************   ГРАФИК(Начало)   ***************************
    switch (sort) {
    case 3:
        /*!Сортировки:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
              ! Заполение:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(Сортировка, Цвет, Заполение);
        graph(2, 2); // Задание цвета (2- зеленый)
        graph(3, 3); // Задание цвета (3- бирюзовый)
        break;
    case 4:
        /*!Сортировки:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
              ! Заполение:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(Сортировка, Цвет, Заполение);
        graph(1, 14); // Задание цвета (14- желтый)
        graph(2, 2);  // Задание цвета (2- зеленый)
        graph(3, 3);  // Задание цвета (15- бирюзовый)
        graph(4, 4);  // Задание цвета (4- красный)
        break;
    case 5:
       /*!Сортировки:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
                5) ShellSort
              ! Заполение:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(Сортировка, Цвет, Заполение);
        graph(5, 14); // Задание цвета (14- желтый)
        graph(4, 2);  // Задание цвета (2- зеленый)
        break;
    }

    int k=getch();
    while (k!='\r') k=getch(); // если не нажата Esc
    closegraph(); // закрываем графическое окно
//**************************   ГРАФИК(Конец )   ***************************

}
