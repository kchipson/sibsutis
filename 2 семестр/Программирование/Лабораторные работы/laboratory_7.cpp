#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;
int BubbleSort(int* A, int n)
{ // Метод пузырька BubbleSort
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
    cout<<endl<<"Кол-во сравнений: "<<c<<endl;
    return 0;
}

int search(int *A,int n,int x){
	int c;
	for (int i=0;i<n;i++){
		c++;
		if (A[i]==x){
			int j=i;
			cout << x<< " находится в ячейке(ах) с индексом: ";
			while ((A[j]==x)&&(j<n)){
				cout<<j<<";  ";
				j++;
			}
			    cout<<endl<<"Кол-во сравнений: "<<c<<endl;
			return 0;
		}
	}
	cout<<endl<<"Кол-во сравнений: "<<c<<endl;
	cout<< "Элемент не найден";
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
        	cout << x<< " находится в ячейке(ах) с индексом: ";
        	while (A[j]==x){
        		j--;     		
        	}
        	j++;
            while (A[j]==x){
        		cout<<j<<";  ";
				j++;
			}
			cout<<endl<<"Кол-во сравнений: "<<c<<endl;
			return 0;
       	}
       	
    }
    cout<<endl<<"Кол-во сравнений: "<<c<<endl;
    cout<< "Элемент не найден";
	return 0;

}
void one(){
//1. Написать функцию, сортирующую в порядке убывания элементы одномерного массива. 
//В главной программе вызвать функцию для двух разных по количеству элементов массивов N=100 и N=1000.
//Написать две функции поиска заданных элементов в каждом из отсортированных массивов - перебором и бинарным поиском.
//Вывести количество операций сравнения в каждой функции.
	int n=100,m=1000,i,x;
	int *A;
	int *B;	
	A= new int[n];
	for (i=0;i<n;i++)
		A[i]=rand()%1001-500;
		
	cout<< "Начальный массив A:"<<endl;
	for (i=0;i<n;i++)// Вывод массива
		cout<<A[i]<<"  ";

	BubbleSort(A,n);
	cout<< endl << "Отсортированный массив A:"<<endl;		
	for (i=0; i<n; i++)  // Вывод массива
		cout<<A[i]<<"  ";
	cout <<endl<<endl<< "Ищем перебором: ";
	cin>>x;
	search(A,n,x);
	cout <<endl<<endl<< "Ищем бинарным поиском: ";
	cin>>x;
	binary_search(A,n,x);
	
	cout<<endl;
	system("PAUSE");
	B= new int[m];	
	for (i=0;i<m;i++)
		B[i]=rand()%1001-500;
		
	
	cout<<endl<<endl<< "Начальный массив B:"<<endl;
	for (i=0;i<m;i++)// Вывод массива
		cout<<B[i]<<"  ";

	BubbleSort(B,m);
	cout<< endl << "Отсортированный массив B:"<<endl;
	for (i=0; i<m; i++)  // Вывод массива
		cout<<B[i]<<"  ";
		
	cout <<endl<<endl<< "Ищем перебором: ";
	cin>>x;
	search(B,m,x);
	cout <<endl<<endl<< "Ищем бинарным поиском: ";
	cin>>x;
	binary_search(B,m,x);
	cout<<endl<<endl;
	
} 




void two(){ 
//2. Написать функцию, которая вычисляет для двумерного массива с переменной длинной строк сумму элементов  каждой строки. 
//Длинна каждой строки хранится в 0 элементе соответствующей строки. 
//Массив сформировать с помощью случайных чисел, и вывести на экран в главной программе.
	int n,i,j;
	cout<<"n : ";
	cin>>n;
			 
    int** B = new int*[n];
    int* S = new int[n];
	if (( B == NULL) ) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
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
	cout<<endl<< "Сумма строк: "<<endl;
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




