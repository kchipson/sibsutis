//Задана криволинейная трапеция, ограниченная двумя пересекающимися линиями -  f1(x) и  f2(x).
// Найти абсциссы точек пересечения этих линий (a,b). Вывести в графическом режиме графики этих линий, 
// указав соответствующие надписи. Площадь образованной линиями трапеции закрасить заданным цветом.
//12. f1(x)= sqrt(1-x*x)    f2(x)= 0        морской волны
#include <stdlib.h>
#include <graphics.h>
#include <math.h>
#include <iostream>
using namespace std;
main()
{
	int d=1360,ch=768,i,j,n=100;
	initwindow(d,ch); 
	for (i=d/2-1;i<=d/2+1;i++){ // Отрисовка оси Y
		moveto(i,ch);
		lineto(i,0);
		lineto(i-10,30);
		moveto(i,0);
		lineto(i+10,30);  		
	}
	outtextxy ( d/2-25, 5, (char*)"y" );

	for (i=ch/2-1;i<=ch/2+1;i++){ // Отрисовка оси X
		moveto(0,i);
		lineto(d,i);
		lineto(d-30-10,i-10);
		moveto(d,i);
		lineto(d-30-10,i+10); 		
	}
	outtextxy ( d-25, ch/2-25, (char*)"x" );
	
	for (i=d/2;i<=d;i+=n){ // Отрисовка единичных отрезков для положтельных x
		for (j=-1;j<2;j++){
			moveto(i+j,ch/2-5);
			lineto(i+j,ch/2+5);	
		}
	}	
	for (i=d/2;i>=0;i-=n){ // Отрисовка единичных отрезков  для отрицательных x
		for (j=-1;j<2;j++){
			moveto(i+j,ch/2-5);
			lineto(i+j,ch/2+5);	
		}	
	}
	for (i=ch/2;i>=0;i-=n){ // Отрисовка единичных отрезков для положтельных y
		for (j=-1;j<2;j++){
			moveto(d/2-5,i+j);
			lineto(d/2+5,i+j);	
		}
	}
	for (i=ch/2;i<=ch;i+=n){ // Отрисовка единичных отрезков для отрицательных y
		for (j=-1;j<2;j++){
			moveto(d/2-5,i+j);
			lineto(d/2+5,i+j);	
		}
	}
	
	setcolor (5); 
	for (i=ch/2-1;i<=ch/2+1;i++){ // Отрисовка f(x)=0
		moveto(0,i);
		lineto(d,i);
	}
	outtextxy (d-175, ch/2-25, (char*)"F(x)=0" );	
	
	
	double f;
	for (i=-1;i<2;i++){
		moveto(d/2-1*n,ch/2+i);
		for  (double q=-1+((double)1/n);q<1;q+=((double)1/n) ){
			//cout<<"q= "<<q<<"\n";
			f=sqrt(1-q*q);
			//cout<<"f:"<<f<<"\n";
			lineto(d/2+q*n,ch/2-f*n+i);
			//cout<<"x:"<<(d/2+q*n)<<"         y:"<<(ch/2-f*n+i)<<"\n";			
		}
		lineto(d/2+1*n,ch/2+i);
		//cout<<"------------------------------------";
	}

	outtextxy (d/2+n, ch/2-n/2, (char*)"F1(x)= sqrt(1-x*x) " );
	setfillstyle ( 1, 3 );
	floodfill (d/2-4,ch/2-4,5);	

	
	system("PAUSE");            
	closegraph(); // закрываем графическое окно

}

