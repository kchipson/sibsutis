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

        //cout << endl
        //     << "* ����� ������������� ���������: " << C_theoretical;
        cout << endl
             << "����� ����������� ���������: " << C_real;
        //cout << endl
        //     << "* ����� ������������� ������������: " << M_theoretical;
        cout << endl
             << "����� ����������� ������������: " << M_real << endl;

        // cout << endl
        //      << "����� ������������� ��������� + ������������: "
        //      << C_theoretical + M_theoretical;
        cout << endl
             << "����� ����������� ��������� + ������������: " << C_real + M_real
             << endl;
    }
}

void graph()
{
    //*************************   ���������(������)   *************************
    //�����
    int screen_width = GetSystemMetrics(SM_CXSCREEN), screen_height = GetSystemMetrics(SM_CYSCREEN); // ������� �������� ����
    int* A; // ������
    int n; //����������� �������

    //�������
    char temp[10]; //��������� ���������� ��� ������� itoa()
    int border_null_x = 50, border_null_y = 45; //����� ������� ��� ������� (����� ������� ����)
    int height = 60, width = 200; //������ � ������ ������

    //*************************   ���������(����� )   *************************

    initwindow(screen_width, screen_height); // ������� ���� �������

    //***************************   �������(������)   ***************************

    settextstyle(8, 0, 1); // ������� ����� ������
    setcolor(9); // ������� �����

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //������� ������� �����
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y); //����� ������� �����

    outtextxy(border_null_x + width * 3, border_null_y + height / 4, (char*)"HeapSort"); // �����

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
    //*********************   ���������� ������� (����� )   *********************

    int k = getch();
    while (k != '\r')
        k = getch(); // ���� �� ������ Esc
    closegraph(); // ��������� ����������� ����
}