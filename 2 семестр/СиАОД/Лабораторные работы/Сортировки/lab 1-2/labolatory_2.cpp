#include <stdlib.h> 
#include <iostream>
#include <math.h>
#include <ctime>
using namespace std;

int M_real=0, C_real=0;	 //����������� �������� ���������� ��������� � ��������� (� � �)
int RunNumber(int A[],int n){
    int sequence=1;  // ����� ����������� �����
    for (int i=0;i<n-1;i++)
        if(A[i]>A[i+1]) sequence++;
    return sequence;
}

int CheckSum(int A[],int n){
    int sum=0; // ����������� �����
    for (int i=0;i<n;i++)
        sum+=A[i];
    return sum;
}

void PrintMas(int A[],int n){ // �����
    for (int i=0;i<n;i++)
        cout<<A[i]<<" ";
}

int FillInc(int A[],int n){   
    for (int i=0;i<n;i++)
          A[i]=i;
    return 0;
}

int FillDec(int A[],int n){
    for (int i=0;i<n;i++)
        A[i]=n-i-1;
    return 0;
}

int FillRand(int A[],int n){
    srand(time(NULL));
    for (int i=0;i<n;i++)
        A[i]=rand() % (n*n)-n;
    return 0;
}

int SelectSort(int A[],int n){ // ���������� SelectSort
	int min,position,changes;
    for (int i=0;i<n;i++){
    	min=A[i];
    	changes=0;
    	for (int j=i+1;j<n;j++){
			C_real++;
    		if (A[j]< min) {	
    			min=A[j];
    			position=j;
    			changes=1;
			}	
		}
		 
		if (changes){
			M_real++;M_real++;
			A[position]=A[i];
    		A[i]=min;
		}
	}
	return 0;
}

main(){ 
	srand(time(NULL));
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
	cout << "������� n: ";
	int n,t;
    cin>>n;
    double M_theoretical=3*(n-1), C_theoretical=(n*n-n)/2; //������������� ������ ���������� ��������� � ��������� (� � �)
    int *A;
    A = new int[n];

	cout <<endl<< "�������� �������:"<<endl<< "1.FillInc(���������� ������� �� �����������)"<<endl<< "2.FillDec(���������� ������� �� ��������)"<<endl<< "3.FillRand(��������� ���������� �������)"<<endl<<endl;
	cin>>t;
	switch(t){
		case 1 :FillInc(A,n);
				break;
		case 2 : FillDec(A,n);
				break;
		case 3 : FillRand(A,n);
				break;
	}
	system("CLS");
	cout<<endl<<"��������� ������: "<<endl;
	PrintMas(A,n);
	cout<<endl<<endl<<"����������� ����� � ��������� �������: "<<endl<<CheckSum(A,n)<<endl;
	cout<<endl<<"����� ����������� ����� � ��������� �������: "<<endl<<RunNumber(A,n)<<endl;
		
	cout<<endl<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	SelectSort(A, n);
	
	cout<<endl<<endl<<"��������������� ������: "<<endl;
    PrintMas(A,n);
    cout<<endl<<endl<<"����������� ����� � ��������������� �������: "<<endl<<CheckSum(A,n)<<endl;
    cout<<endl<<"����� ����������� ����� � ��������������� �������: "<<endl<<RunNumber(A,n)<<endl;
    
    cout<<endl<<"����� ������������� ���������:  "<<C_theoretical;
    cout<<endl<<"����� ����������� ���������:  "<<C_real;
    cout<<endl<<endl<<"����� ������������� ������������:  "<<M_theoretical;
    cout<<endl<<"����� �����������  ������������:  "<<M_real;
	
	
return 0; 
}




