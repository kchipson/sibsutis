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
    char temp[10]; //��������� ���������� ��� ������� itoa()
    int border_null_x = 15, border_null_y = 45; //����� ������� ��� ������� (����� ������� ����)
    int height = 60, width = 100; //������ � ������ ������

    //������
    int origin_x = screen_width * 0.5, origin_y = screen_height * 0.85; //����� ������� ��� ������� (����� ������ ����)
    int x_step = 25, y_step = 25; //��� �� x
    int x_coefficient=1,y_coefficient=2; // ����������� step'a
    int signature_step=50; // ������� ���� �������

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
        }

        lineto(origin_x + n * x_coefficient, origin_y - (C_real + M_real) / 1000 * y_coefficient);
        delete A;
        n += x_step;
    }
}

void statistics_sort(int sort)
{  
    
    initwindow(screen_width, screen_height); // ������� ���� �������
//***************************   �����(������)   ***************************

    // 1 �������- 120 px, 2-6 ������� - 100
    settextstyle(8, 0, 1); // ������� ����� ������
    setcolor(5); // ������� ����� (5-���������)

    moveto(border_null_x, border_null_y);
    lineto(border_null_x + width * (1.2 + 5), border_null_y); //������� ������� �����
    lineto(border_null_x + width * (1.2 + 5), border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y + height); //������ ������� �����
    lineto(border_null_x, border_null_y); //����� ������� �����

    outtextxy(border_null_x + width * 0.6, border_null_y + height / 4, (char*)"n"); // ����� n � �����

    for (n = 1; n < 6; n++) {
        outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
        line(border_null_x + width * (1.2 + n - 1), border_null_y, border_null_x + width * (1.2 + n - 1), border_null_y + height);
    }

    setcolor(15); // ������� ����� (15-�����)
//***************************   �����(����� )   ***************************

//************************   ������_Null(������)  *************************
    //��� X
    moveto(origin_x, origin_y); //� ��������� ���������
    lineto(screen_width * 0.99, origin_y);

    //���������
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

    //��� Y
    moveto(origin_x, origin_y); //� ��������� ���������
    lineto(origin_x, 0 + screen_height * 0.01);

    //���������
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
//************************   ������_Null(����� )  *************************

//**************************   �������(������)   **************************

    moveto(border_null_x, border_null_y + height);
    switch (sort) {
    case 1:
        setfillstyle(1, 9); // �������� ������� ������
        bar(0, 0, screen_width, screen_height); // �������� �����
        settextstyle(8, 6, 8);
        outtextxy(screen_width / 2 - screen_width / 3.5,
            screen_height / 2 - screen_height / 8,
            (char*)"�� �����������! ");
        break;
    case 2:
        setfillstyle(1, 9); // �������� ������� ������
        bar(0, 0, screen_width, screen_height); // �������� �����
        settextstyle(8, 6, 8);
        outtextxy(screen_width / 2 - screen_width / 3.5,
            screen_height / 2 - screen_height / 8,
            (char*)"�� �����������! ");
        break;

    case 3:
        lineto(border_null_x, border_null_y + height * 7); // ����� ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 7);// ������ ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // ������ ������� ����
        
        for (n = 0; n < 5; n++)  //��������� �������������� ����� ������ ����
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 7);
        
        line(border_null_x + width * 0.6, border_null_y + height,border_null_x + width * 0.6, border_null_y + height * 7); //������� n �������
        for (n = 1; n < 7; n++) { //��������� ������������ ����� ������ ����
            line(border_null_x + width * 1.2 / 2, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);
            if (n == 3)
                line(border_null_x, border_null_y + height * (1 + n), border_null_x + width * 0.6, border_null_y + height * (1 + n));
        }
        settextstyle(8, 5, 1); // ������� ����� ������ (������� �� 90)
        setcolor(2); // ������� ����� (2-�������)
         outtextxy(border_null_x + width * 0.4, border_null_y + height * 1.2, (char*)"M+C BubbleSort");
        setcolor(3); // ������� ����� (3-���������)
         outtextxy(border_null_x + width* 0.4, border_null_y + height * (1.2 + 3), (char*)"M+C ShakerSort");

        settextstyle(8, 0, 1); // ������� ����� ������
        setcolor(15); // ������� ����� (15-�����)
        outtextxy(border_null_x + width * 0.7, border_null_y + height * 1.3, (char*)"��.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (1 + 1.3), (char*)"���.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (2 + 1.3), (char*)"���.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (3 + 1.3), (char*)"��.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (4 + 1.3), (char*)"���.");
        outtextxy(border_null_x + width * 0.7, border_null_y + height * (5 + 1.3), (char*)"���.");

        for (int j = 0; j < 4; j += 3) { // ���������� �������
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
        lineto(border_null_x, border_null_y + height * 5); // ����� ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 5); // ������ ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // ������ ������� ����

        for (n = 0; n < 5; n++) //��������� �������������� ����� ������ ����
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 5);

        for (n = 1; n < 4; n++) //��������� ������������ ����� ������ ����
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);

        setcolor(14);
        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 4, (char*)"Select"); // ����� Select
        setcolor(2); // ������� ����� (2- �������)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*2+ height / 4, (char*)"Bubble"); // ����� Bubble
        setcolor(3); // ������� ����� (3- ���������)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*3+ height / 4, (char*)"Shaker"); // ����� Shaker
        setcolor(4); // ������� ����� (4- �������)
        outtextxy(border_null_x + width * 0.25, border_null_y + height*4+ height / 4, (char*)"Insert"); // ����� Insert

        setcolor(15); // ������� ����� (15- �����)
        for (int j = 0; j < 4; j++) {
            for (n = 100; n < 501; n += 100) { // ���������� �������
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
        lineto(border_null_x, border_null_y + height * 4); // ����� ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height * 4); // ������ ������� ����
        lineto(border_null_x + width * (1.2 + 5), border_null_y + height); // ������ ������� ����

        for (n = 0; n < 5; n++) //��������� �������������� ����� ������ ����
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 4);

        for (n = 1; n < 3; n++) //��������� ������������ ����� ������ ����
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 5, border_null_y + height + height * n);

        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 6, (char*)"���-�� "); // �����
        outtextxy(border_null_x , border_null_y + height+ height / 2, (char*)"�-����������"); // �����
        setcolor(2);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*2+ height / 4, (char*)"Insert"); // �����
        setcolor(14);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*3+ height / 4, (char*)"Shell"); // �����
        setcolor(15);


        for (n = 100; n < 501; n += 100) { // ���������� ������� Insert
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 1 + height / 4, itoa(C_real + M_real, temp, 10));
            delete A;
        }
        for (n = 100; n < 501; n += 100) { // ���������� ������� Shell
            A = new int[n];
            FillRand(A, n);
            C_real = 0;
            M_real = 0;
            ShellSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 2 + height / 4, itoa(C_real + M_real, temp, 10));
            delete A;
        }
        

        for (n = 100; n < 501; n += 100) { // ���������� ������� k
		
            A = new int[n];
            FillRand(A, n);
            ShellSort(A, n);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height / 4, itoa((log2(n)-1), temp, 10));
            delete A;

        }
        break;
    case 6:
        setfillstyle(1, 0); // �������� ������� ������
        bar(0, 0, screen_width, screen_height); // �������� �����
         // 1 �������- 120 px, 2-6 ������� - 100
        settextstyle(8, 0, 1); // ������� ����� ������
        setcolor(5); // ������� ����� (5-���������)

        moveto(border_null_x, border_null_y);
        lineto(border_null_x + width * (1.2 + 10), border_null_y); //������� ������� �����
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height); //������ ������� �����
        lineto(border_null_x, border_null_y + height); //������ ������� �����
        lineto(border_null_x, border_null_y); //����� ������� �����

        outtextxy(border_null_x + width * 0.6, border_null_y + height / 4, (char*)"n"); // ����� n � �����

        for (n = 1; n < 11; n++) {
            outtextxy((border_null_x + width * (1.05 + n) - width / 2), border_null_y + height / 4, itoa(n * 100, temp, 10));
            line(border_null_x + width * (1.2 + n - 1), border_null_y, border_null_x + width * (1.2 + n - 1), border_null_y + height);
        }
        setcolor(15); // ������� ����� (15-�����)



        lineto(border_null_x, border_null_y + height * 3); // ����� ������� ����
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height * 3); // ������ ������� ����
        lineto(border_null_x + width * (1.2 + 10), border_null_y + height); // ������ ������� ����

        for (n = 0; n < 10; n++) //��������� �������������� ����� ������ ����
            line(border_null_x + width * (1.2 + n), border_null_y + height, border_null_x + width * (1.2 + n), border_null_y + height * 3);

        for (n = 1; n < 2; n++) //��������� ������������ ����� ������ ����
            line(border_null_x, border_null_y + height + height * n, border_null_x + width * 1.2 + width * 10, border_null_y + height + height * n);

        outtextxy(border_null_x + width * 0.25, border_null_y + height+ height / 4, (char*)"Bsearch1 "); // �����
        setcolor(14);
        outtextxy(border_null_x+ width * 0.25, border_null_y + height*2+ height / 4, (char*)"Bsearch2"); // �����
        setcolor(15);


        for (n = 100; n < 1001; n += 100) { // ���������� �������
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            BSearch1(A, n, A[1-1]);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 0 + height / 4, itoa(C_real, temp, 10));
            delete A;
        }
        for (n = 100; n < 1001; n += 100) { // ���������� �������
            A = new int[n];
            FillRand(A, n);
            InsertSort(A, n);
            BSearch2(A, n, A[1-1]);
            outtextxy(border_null_x + width * (n / 100 + 1) - width / 1.6, border_null_y + height + height * 1 + height / 4, itoa(C_real, temp, 10));
            delete A;
        }
        
        break;
    }
//**************************   �������(����� )   **************************

//**************************   ������(������)   ***************************
    switch (sort) {
    case 3:
        /*!����������:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
              ! ���������:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(����������, ����, ���������);
        graph(2, 2); // ������� ����� (2- �������)
        graph(3, 3); // ������� ����� (3- ���������)
        break;
    case 4:
        /*!����������:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
              ! ���������:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(����������, ����, ���������);
        graph(1, 14); // ������� ����� (14- ������)
        graph(2, 2);  // ������� ����� (2- �������)
        graph(3, 3);  // ������� ����� (15- ���������)
        graph(4, 4);  // ������� ����� (4- �������)
        break;
    case 5:
       /*!����������:
                1) SelectSort
                2) BubbleSort
                3) ShakerSort
                4) InsertSort
                5) ShellSort
              ! ���������:
                1) FillInc
                2) FillDec
                3) Random
            */
        // graph(����������, ����, ���������);
        graph(5, 14); // ������� ����� (14- ������)
        graph(4, 2);  // ������� ����� (2- �������)
        break;
    }

    int k=getch();
    while (k!='\r') k=getch(); // ���� �� ������ Esc
    closegraph(); // ��������� ����������� ����
//**************************   ������(����� )   ***************************

}
