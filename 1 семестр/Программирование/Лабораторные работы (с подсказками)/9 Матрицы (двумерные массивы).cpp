#include <stdlib.h> 
#include <iostream> 
using namespace std;
#include <ctime>
#include "windows.h"
int random (int N) { return rand()%N; }

void one(){ 
//1.	������� � ����� ����������� 10x20. � ������� �������� ������� 1-� � 2-� ������, 3-� � 4-� ������, �., 9-� � 10-� ������. 

const int M =10; // ����� �����
const int N =20; // ����� ��������
int i, j,c,a[M][N];
for ( i = 0; i < M; i ++ ) // ���� �� �������
	for ( j = 0; j < N; j ++ ) // ���� �� �������� ������ (�������� ������)
		a[i][j]=random(20);
		
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nNachal'naya matrica:\n";
for ( i = 0; i < M; i ++ ) 
	{
	for ( j = 0; j < N; j ++ ){
		cout.width(2);// ������ ������ ����
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
		cout.width(2);// ������ ������ ����
		cout<<a[i][j]<<"  ";
	}
	cout<<"\n";
	}
} 

void two(){ 
//2.	����� ��������� ������ NxN ������������ �����, N=5. 
//���������� ������ ������� ��������������� ������ ��������� �� ����� ��������� ���� �� ������. 
const int N =5; // ����� ����� � ��������
int i, j;
float c, a[N][N];
for ( i = 0; i < N; i ++ ) // ���� �� �������
	for ( j = 0; j < N; j ++ ) // ���� �� �������� ������
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
//3.������� � ����� ����������� 5�5. ����� ����������������� � � ������� (�.�. �������� ������� ������ � �������).
const int N =5; // ����� ����� � ��������
int i, j;
float c, a[N][N];
for ( i = 0; i < N; i ++ ) // ���� �� �������
	for ( j = 0; j < N; j ++ ) // ���� �� �������� ������
	{
		a[i][j]=random(20);
	}
cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~"<<"\nNachal'naya matrica:\n";
for ( i = 0; i < N; i ++ ){
		for ( j = 0; j < N; j ++ ){
			cout.width(2);// ������ ������ ����
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
		cout.width(2);// ������ ������ ����
		cout<<a[i][j]<<"  ";
	}	
	cout<<"\n";
	}
} 
void four(){ 
//4. ������������ �� ��������� ����� ������� 3�3 - ���������� �������,
//�.�.�����, � ������� ����� ��������� �� ���� ������� � �������� ���������. 
//(�������� �������, ������� ������������ �� ��� ���, ���� �� ���������� ���������� �������). ���������� ���������� ���������.
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
