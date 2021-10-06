#include <stdlib.h>
#include <math.h>
#include <iostream>
using namespace std;
#include <graphics.h>
#include <ctime>


void snowflake (int d, int ch,int p){
	setcolor(rand() % 14+1); //���� ��������
	
	for (int j=-p/10;j<=p/10;j++){ //��������� �������� j-�������
		moveto(d+j,ch-p);
		lineto(d-j,ch+p);

		moveto(d-sqrt(p*p-(p/2)*(p/2)),ch-p/2+j);
		lineto(d+sqrt(p*p-(p/2)*(p/2)),ch+p/2-j);
		
		moveto(d+sqrt(p*p-(p/2)*(p/2)),ch-p/2+j);
		lineto(d-sqrt(p*p-(p/2)*(p/2)),ch+p/2-j);
	}
}
int main()
{
	int d=GetSystemMetrics(SM_CXSCREEN),ch=GetSystemMetrics(SM_CYSCREEN),i,j,code;
	int chislo_sneg=500;
	int x[chislo_sneg], y[chislo_sneg];
	int p;
	initwindow (d, ch); // ������� ���� ��� �������

	srand(time(NULL));
	
	while (1){
		if ( kbhit() ) // ���� ������ ��������
			if ( getch() == 27 )  // ���� ������ Esc
            	break; // ����� �� �����


		for (i=0; i<(rand() % (chislo_sneg-25)+25); i++){ // ���-�� ������� �� ���
		p=rand() %25+5;
		x[i]= rand() % (d-p*2)+p;
		y[i]= rand() % (ch-p*2)+p;
		snowflake(x[i],y[i],p);
		}
		
		Sleep(500);
		setfillstyle ( 1, 0);
		bar (0, 0, d, ch);		
	}
	
	closegraph(); // ��������� ����������� ����
	return 0;
}


