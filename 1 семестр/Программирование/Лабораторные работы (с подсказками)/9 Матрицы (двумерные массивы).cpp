#include <stdlib.h> 
#include <iostream> 
using namespace std;
#include <ctime>
#include "windows.h"
int random (int N) { return rand()%N; }

void one(){ 
//1.	Матрица А имеет размерность 10x20. В матрице поменять местами 1-ю и 2-ю строки, 3-ю и 4-ю строки, …., 9-ю и 10-ю строки. 

const int M =10; // число строк
const int N =20; // число столбцов
int i, j,c,a[M][N];
for ( i = 0; i < M; i ++ ) // цикл по строкам
	for ( j = 0; j < N; j ++ ) // цикл по столбцам строки (элементы строки)
		a[i][j]=random(20);
		
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nNachal'naya matrica:\n";
for ( i = 0; i < M; i ++ ) 
	{
	for ( j = 0; j < N; j ++ ){
		cout.width(2);// задает ширину поля
		cout<<a[i][j]<<"  ";
	}
	cout<<"\n";
}	
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nIzmenennaya matrica:\n";
for ( i = 0; i < M; i+=2 )
	for ( j = 0; j < N; j ++ ){
	
		c=a[i][j];
		a[i][j]=a[i+1][j];
		a[i+1][j]=c;
	}
for ( i = 0; i < M; i ++ ) {
	for ( j = 0; j < N; j ++ ){
		cout.width(2);// задает ширину поля
		cout<<a[i][j]<<"  ";
	}
	cout<<"\n";
	}
} 

void two(){ 
//2.	Задан двумерный массив NxN вещественных чисел, N=5. 
//Необходимо каждый элемент соответствующей строки разделить на сумму элементов этой же строки. 
const int N =5; // число строк и столбцов
int i, j;
float c, a[N][N];
for ( i = 0; i < N; i ++ ) // цикл по строкам
	for ( j = 0; j < N; j ++ ) // цикл по столбцам строки
	{
		a[i][j]=(float)rand()*20/RAND_MAX;
	}
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nNachal'naya matrica:\n";
for ( i = 0; i < N; i ++ ) 
	{
	for ( j = 0; j < N; j ++ )
		cout<<a[i][j]<<"  ";
	cout<<"\n";
	}	
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nIzmenennaya matrica:\n";

for ( i = 0; i < N; i ++ ) 
	{
	for ( j = 0; j < N; j ++ )
		c+=a[i][j];
	for ( j = 0; j < N; j ++ )
		cout<<a[i][j]/c<<"  ";
	c=0;
	cout<<"\n";
	}	
} 

void three(){ 
//3.Матрица А имеет размерность 5х5. Найти транспонированную к А матрицу (т.е. поменять местами строки и столбцы).
const int N =5; // число строк и столбцов
int i, j;
float c, a[N][N];
for ( i = 0; i < N; i ++ ) // цикл по строкам
	for ( j = 0; j < N; j ++ ) // цикл по столбцам строки
	{
		a[i][j]=random(20);
	}
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nNachal'naya matrica:\n";
for ( i = 0; i < N; i ++ ){
		for ( j = 0; j < N; j ++ ){
			cout.width(2);// задает ширину поля
			cout<<a[i][j]<<"  ";
		}			
		cout<<"\n";
	}	
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nIzmenennaya matrica:\n";

for ( i = 0; i < N; i++ )
	for ( j = i+1; j < N; j ++ ){
		c=a[i][j];
		a[i][j]=a[j][i];
		a[j][i]=c;
	}
	
for ( i = 0; i < N; i ++ ) {
	for ( j = 0; j < N; j ++ ){
		cout.width(2);// задает ширину поля
		cout<<a[i][j]<<"  ";
	}	
	cout<<"\n";
	}
} 
void four(){ 
//4. Сформировать из случайных чисел матрицу 3х3 - магический квадрат,
//т.е.такой, в котором суммы элементов во всех строках и столбцах одинаковы. 
//(алгоритм подбора, матрица генерируется до тех пор, пока не получиться магический квадрат). Подсчитать количество генераций.
int a[9],i,k=0;
srand(time(NULL));
while (1){
	for (i=0; i<9 ; i++){
		a[i]=1 + rand() % 10;
	}

//	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\n\nArray:\n";
//		cout<<a[0]<<"  "<<a[1]<<"  "<<a[2]<<"\n";
//		cout<<a[3]<<"  "<<a[4]<<"  "<<a[5]<<"\n";
//		cout<<a[6]<<"  "<<a[7]<<"  "<<a[8]<<"\n";

	k++;
//	cout<<k<<"\n";

	int n=a[0]+a[1]+a[2];
	if (n==(a[3]+a[4]+a[5]) && n==(a[6]+a[7]+a[8]) && n==(a[0]+a[3]+a[6]) && n==(a[1]+a[4]+a[7]) && n==(a[2]+a[5]+a[8]) && n==(a[0]+a[4]+a[8]) && n==(a[2]+a[4]+a[6])){
		cout<<"\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nGeneraciya nomer: "<<k;
		cout<<"\n\nArray:\n";
		cout<<a[0]<<"  "<<a[1]<<"  "<<a[2]<<"\n";
		cout<<a[3]<<"  "<<a[4]<<"  "<<a[5]<<"\n";
		cout<<a[6]<<"  "<<a[7]<<"  "<<a[8]<<"\n";
		cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
		break;
	}

	
}
 
} 

main(){ 
    int choice; 
    printf("Input number of task (Number from 1 to 4): "); 
    scanf("%d",&choice); 
    
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    } 
    else if(choice == 3){ 
        three(); 
    } 
    else if(choice == 4){ 
    	four(); 
    } 


system("PAUSE");
return 0; 
}
