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
{ //����� � ��������

    if (!sorted) { //���� �����������������
        cout << endl
             << "��������� ������: " << endl;
        for (int i = 0; i < n; i++)
            cout << A[i] << " ";

        cout << endl
             << "����������� ����� � ��������� �������: " << CheckSum(A, n) << endl;
        cout << "����� ����������� ����� � ��������� �������: " << RunNumber(A, n)
             << endl;
    }
    else { //���� ���������������
        cout << endl
             << "��������������� ������: " << endl;
        for (int i = 0; i < n; i++)
            cout << A[i] << " ";
        cout << endl
             << "����������� ����� � ��������������� �������: " << CheckSum(A, n)
             << endl;
        cout << "����� ����������� ����� � ��������������� �������: "
             << RunNumber(A, n) << endl;

        cout << endl
             << "* ����� ������������� ���������: " << C_theoretical;
        cout << endl
             << "����� ����������� ���������: " << C_real;
        cout << endl
             << "* ����� ������������� ������������: " << M_theoretical;
        cout << endl
             << "����� ����������� ������������: " << M_real << endl;

        cout << endl
             << "����� ������������� ��������� + ������������: "
             << C_theoretical + M_theoretical;
        cout << endl
             << "����� ����������� ��������� + ������������: " << C_real + M_real
             << endl;
    }
}

//*************************   ���������(������)   *************************
//�����
int screen_width = GetSystemMetrics(SM_CXSCREEN), screen_height = GetSystemMetrics(SM_CYSCREEN); // ������� �������� ����
int* A; // ������
int n; //����������� �������

//�������
char temp[12]; //��������� ���������� ��� ������� itoa()
int border_null_x = 50, border_null_y = 45; //����� ������� ��� ������� (����� ������� ����)
int height = 60, width = 200; //������ � ������ ������

//������
int origin_x = screen_width * 0.05, origin_y = screen_height * 0.85; //����� ������� ��� ������� (����� ������ ����)
int x_step = 100, y_step = 2; //��� �� x � y
int x_coefficient = 1, y_coefficient = 15; // ����������� step'a
int signature_step_x = 50, signature_step_y = 10; // ������� ���� �������

//*************************   ���������(����� )   *************************

void graph(int sort, int color, int fill = 3)
{
    setcolor(color); // ������� �����
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

    initwindow(screen_width, screen_height); // ������� ���� �������
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

    //***************************   �������(������)   ***************************

    settextstyle(8, 0, 1); // ������� ����� ������
    setcolor(9); // ������� �����

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //������� ������� �����
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y); //����� ������� �����

    outtextxy(border_null_x + width * 3, border_null_y + height / 4, (char*)"QuickSortV1"); // �����

    for (n = 1; n < 7; n++) { //�������������� �����
        //outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * (1.2 + 5), border_null_y + height * (1 + n));
    }

    line(border_null_x + width * (1.2 + 5), border_null_y + height, border_null_x + width * (1.2 + 5), border_null_y + height * 7); //������ �������
    line(border_null_x, border_null_y + height, border_null_x, border_null_y + height * 7); //����� �������
    line(border_null_x + width * (1.5), border_null_y + height, border_null_x + width * (1.5), border_null_y + height * 7);
    for (n = 1; n < 3; n++) {
        line(border_null_x + width * (1.5 + 1.56 * n), border_null_y + height, border_null_x + width * (1.5 + 1.56 * n), border_null_y + height * 7);
    }

    setcolor(15); // ������� ����� (15-�����)
    outtextxy(border_null_x + width * (0.75), border_null_y + height + (height / 3.5), (char*)"n");
    outtextxy(border_null_x + width * (1.5 + 1.56) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 2) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 + 1.56 * 3) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");

    setcolor(3); // ������� �����
    for (n = 1; n < 6; n++) {
        outtextxy(border_null_x + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(n * 100, temp, 10));
    }

    //***************************   �������(����� )   ***************************

    //*********************   ���������� ������� (������)   *********************
    setcolor(15); // ������� ����� (15-�����)
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
    //*********************   ���������� ������� (����� )   *********************
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

    //************************   ������_Null(������)  *************************
    //��� X
    moveto(origin_x, origin_y); //� ��������� ���������
    lineto(screen_width * 0.99, origin_y);

    //���������
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

    //��� Y
    moveto(origin_x, origin_y); //� ��������� ���������
    lineto(origin_x, 0 + screen_height * 0.01);

    //���������
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
    //************************   ������_Null(����� )  *************************

    //**************************   ������(������)   ***************************
    /*!����������:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
                5) ShellSort
                6) HeapSort
                7) QuickSortV1

              ! ���������:
                1) FillInc
                2) FillDec
                3) Random
        graph(����������, ����, ���������);  
        */

    graph(5, 2);
    graph(6, 4);
    graph(7, 5);

    setcolor(2); // ������� �����
    outtextxy(origin_x * 2, origin_y * 0.05, (char*)"ShellSort");
    setcolor(4); // ������� �����
    outtextxy(origin_x * 2, origin_y * 0.1, (char*)"HeapSort");
    setcolor(5); // ������� �����
    outtextxy(origin_x * 2, origin_y * 0.15, (char*)"QuickSortV1");

    //**************************   ������(����� )   ***************************
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

    //***************************   �������(������)   ***************************

    settextstyle(8, 0, 1); // ������� ����� ������
    setcolor(9); // ������� �����

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //������� ������� �����
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y); //����� ������� �����

    outtextxy(border_null_x + width * 2.35, border_null_y + height / 4, (char*)"QuickSortV1"); // �����
    outtextxy(border_null_x + width * 4.75, border_null_y + height / 4, (char*)"QuickSortV2"); // �����

    for (n = 1; n < 7; n++) { //�������������� �����
        //outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * (1.2 + 5), border_null_y + height * (1 + n));
    }

    line(border_null_x + width * (1.2 + 5), border_null_y + height, border_null_x + width * (1.2 + 5), border_null_y + height * 7); //������ �������
    line(border_null_x, border_null_y + height, border_null_x, border_null_y + height * 7); //����� �������
    line(border_null_x + width * (1.5), border_null_y + height, border_null_x + width * (1.5), border_null_y + height * 7); // ����������� "N"

    for (n = 1; n < 6; n++) {
        line(border_null_x + width * (1.5 + 1.56 * float(n) / 2), border_null_y + height, border_null_x + width * (1.5 + 1.56 * float(n) / 2), border_null_y + height * 7);
    }

    setcolor(15); // ������� ����� (15-�����)
    outtextxy(border_null_x + width * (0.75), border_null_y + height + (height / 3.5), (char*)"n");
    outtextxy(border_null_x + width * (1.5 + 1.15) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 + 1.95) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 + 2.75) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 1.15) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Inc");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 1.95) - width * (0.85), border_null_y + height + (height / 3.5), (char*)"Dec");
    outtextxy(border_null_x + width * (1.5 * 2.55 + 2.75) - width * (0.9), border_null_y + height + (height / 3.5), (char*)"Rand");
    setcolor(3); // ������� �����
    for (n = 1; n < 6; n++) {
        outtextxy(border_null_x + width * (0.69), border_null_y + height * (1 + n) + (height / 3.5), itoa(n * 100, temp, 10));
    }

    //***************************   �������(����� )   ***************************

    //*********************   ���������� ������� (������)   *********************
    setcolor(15); // ������� ����� (15-�����)

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
    //*********************   ���������� ������� (����� )   *********************
    getch();
    closegraph(); // ��������� ����������� ����
}