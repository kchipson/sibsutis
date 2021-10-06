#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;
int BubbleSort(int* A, int n)
{ // ����� �������� BubbleSort
    int temp,c;
    for (int i = 0; i < n; i++) {
        for (int j = n - 1; j > i; j--) {
            c++;
            if (A[j] < A[j - 1]) {
                temp = A[j];
                A[j] = A[j - 1];
                A[j - 1] = temp;

            }
        }
    }
    cout<<endl<<"���-�� ���������: "<<c<<endl;
    return 0;
}

int search(int *A,int n,int x){
	int c;
	for (int i=0;i<n;i++){
		c++;
		if (A[i]==x){
			int j=i;
			cout << x<< " ��������� � ������(��) � ��������: ";
			while ((A[j]==x)&&(j<n)){
				cout<<j<<";  ";
				j++;
			}
			    cout<<endl<<"���-�� ���������: "<<c<<endl;
			return 0;
		}
	}
	cout<<endl<<"���-�� ���������: "<<c<<endl;
	cout<< "������� �� ������";
	return 0;
}
int binary_search(int *A,int n,int x){
	int L = 0;
    int R = n;
    int j,c=0;

    while (L<R)
    {
    	//cout<<"l=: "<<L<<"    r=: "<<R<<endl;
        j = (L+R)/2;
        c++;
        if (x < A[j]) R = j;
        else if (x > A[j]) L = j;
        else if (x == A[j]) {
        	cout << x<< " ��������� � ������(��) � ��������: ";
        	while (A[j]==x){
        		j--;     		
        	}
        	j++;
            while (A[j]==x){
        		cout<<j<<";  ";
				j++;
			}
			cout<<endl<<"���-�� ���������: "<<c<<endl;
			return 0;
       	}
       	
    }
    cout<<endl<<"���-�� ���������: "<<c<<endl;
    cout<< "������� �� ������";
	return 0;

}
void one(){
//1. �������� �������, ����������� � ������� �������� �������� ����������� �������. 
//� ������� ��������� ������� ������� ��� ���� ������ �� ���������� ��������� �������� N=100 � N=1000.
//�������� ��� ������� ������ �������� ��������� � ������ �� ��������������� �������� - ��������� � �������� �������.
//������� ���������� �������� ��������� � ������ �������.
	int n=100,m=1000,i,x;
	int *A;
	int *B;	
	A= new int[n];
	for (i=0;i<n;i++)
		A[i]=rand()%1001-500;
		
	cout<< "��������� ������ A:"<<endl;
	for (i=0;i<n;i++)// ����� �������
		cout<<A[i]<<"  ";

	BubbleSort(A,n);
	cout<< endl << "��������������� ������ A:"<<endl;		
	for (i=0; i<n; i++)  // ����� �������
		cout<<A[i]<<"  ";
	cout <<endl<<endl<< "���� ���������: ";
	cin>>x;
	search(A,n,x);
	cout <<endl<<endl<< "���� �������� �������: ";
	cin>>x;
	binary_search(A,n,x);
	
	cout<<endl;
	system("PAUSE");
	B= new int[m];	
	for (i=0;i<m;i++)
		B[i]=rand()%1001-500;
		
	
	cout<<endl<<endl<< "��������� ������ B:"<<endl;
	for (i=0;i<m;i++)// ����� �������
		cout<<B[i]<<"  ";

	BubbleSort(B,m);
	cout<< endl << "��������������� ������ B:"<<endl;
	for (i=0; i<m; i++)  // ����� �������
		cout<<B[i]<<"  ";
		
	cout <<endl<<endl<< "���� ���������: ";
	cin>>x;
	search(B,m,x);
	cout <<endl<<endl<< "���� �������� �������: ";
	cin>>x;
	binary_search(B,m,x);
	cout<<endl<<endl;
	
} 




void two(){ 
//2. �������� �������, ������� ��������� ��� ���������� ������� � ���������� ������� ����� ����� ���������  ������ ������. 
//������ ������ ������ �������� � 0 �������� ��������������� ������. 
//������ ������������ � ������� ��������� �����, � ������� �� ����� � ������� ���������.
	int n,i,j;
	cout<<"n : ";
	cin>>n;
			 
    int** B = new int*[n];
    int* S = new int[n];
	if (( B == NULL) ) // ���� �� ������� �������� ������ 
	{
    	cout<<" �� ������� �������� ������\n";
    	exit(0);
	}
	for(int i=0;i<n;i++){
		int r=rand()%(n-1)+1;
		B[i]=new int[r+1];
		B[i][0]=r;
		for(int j=1;j<r+1;j++){
			B[i][j]=rand()%101-50;
		}
	}
	
	for(int i=0;i<n;i++){
		S[i]=0;
		for(int j=0;j<B[i][0]+1;j++){
			cout<<B[i][j]<<"   ";
			if (j>0)
				S[i]+=B[i][j]; 
		}
		cout<<endl;
	}
	cout<<endl<< "����� �����: "<<endl;
	for(int i=0;i<n;i++){
		cout<< S[i]<< "  ";
	}
	cout<<endl;
} 


main(){ 
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text"); 
	srand(time(NULL));
    int choice; 
   	cout<<"Input number of task (Number from 1 to 2):"; 
    cin>>choice; 
    system("CLS");
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    }

system("PAUSE");
return 0; 
}




