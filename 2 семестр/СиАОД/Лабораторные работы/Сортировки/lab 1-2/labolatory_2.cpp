#include <stdlib.h> 
#include <iostream>
#include <math.h>
#include <ctime>
using namespace std;

int M_real=0, C_real=0;	 //Фактические значения количества пересылок и сравнений (М и С)
int RunNumber(int A[],int n){
    int sequence=1;  // Число неубывающих серий
    for (int i=0;i<n-1;i++)
        if(A[i]>A[i+1]) sequence++;
    return sequence;
}

int CheckSum(int A[],int n){
    int sum=0; // Контрольная сумма
    for (int i=0;i<n;i++)
        sum+=A[i];
    return sum;
}

void PrintMas(int A[],int n){ // Вывод
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

int SelectSort(int A[],int n){ // Сортировка SelectSort
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
	cout << "Введите n: ";
	int n,t;
    cin>>n;
    double M_theoretical=3*(n-1), C_theoretical=(n*n-n)/2; //Теоретические оценки количества пересылок и сравнений (М и С)
    int *A;
    A = new int[n];

	cout <<endl<< "Выберите функцию:"<<endl<< "1.FillInc(Заполнение массива по возрастанию)"<<endl<< "2.FillDec(Заполнение массива по убыванию)"<<endl<< "3.FillRand(Случайное заполнение массива)"<<endl<<endl;
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
	cout<<endl<<"Начальный массив: "<<endl;
	PrintMas(A,n);
	cout<<endl<<endl<<"Контрольная сумма в начальном массиве: "<<endl<<CheckSum(A,n)<<endl;
	cout<<endl<<"Число неубывающих серий в начальном массиве: "<<endl<<RunNumber(A,n)<<endl;
		
	cout<<endl<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	SelectSort(A, n);
	
	cout<<endl<<endl<<"Отсортированный массив: "<<endl;
    PrintMas(A,n);
    cout<<endl<<endl<<"Контрольная сумма в отсортированном массиве: "<<endl<<CheckSum(A,n)<<endl;
    cout<<endl<<"Число неубывающих серий в отсортированном массиве: "<<endl<<RunNumber(A,n)<<endl;
    
    cout<<endl<<"Число теоретических сравнений:  "<<C_theoretical;
    cout<<endl<<"Число фактических сравнений:  "<<C_real;
    cout<<endl<<endl<<"Число теоретических перестановок:  "<<M_theoretical;
    cout<<endl<<"Число фактических  перестановок:  "<<M_real;
	
	
return 0; 
}




