#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;



void one(){
//1. Сгенерировать одномерный динамический массив A из m элементов. Вводится число k (k<m).
//Получить из А матрицу B, по k элементов в строке.  
//Если m не кратно k, недостающие элементы последней строки дополнить нулями.
int m,k;
	int *A;
	cout<<"Размерность массива: ";
	cin>>m;
	A= new int[m];
	
	if (( A == NULL) ) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	exit(0);
	}
	
	cout<<"k : ";
	cin>>k;
	
	int c=0,count=0,i,j;
	for (i=0; i<m; i++){
		A[i]=rand( )%101-50;
	}
		
    int** B = new int*[k];
    
	if (( B == NULL) ) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	exit(0);
	}
    
	for (i=0;i*k<m;i++){
        B[i] = new int[k];
        count++;
        for (j=0; j<k; j++)
        	B[i][j]=0;
    }
    
	for (i=0;i*k<m;i++){
        for (j=0; j<k; j++){
        	if (c<m){
            	B[i][j]=A[c];
        		c++;    		
			}
			else break;
    	}
    }
	
	cout<<"Массив А:"<<endl;
	for (i=0; i<m; i++){
		cout<<A[i]<<"  ";
	}
	
	
	cout<<endl<<"Массив B:"<<endl;
	
	for (i=0; i<count; i++){  // Вывод массива
		for (j=0; j<k; j++){
			cout.width(3);
			cout<<B[i][j]<<"  ";
		}
		cout<<endl;
	} 
    
    

} 




void two(){ 
//  2. Создать двумерный массив с переменной длиной строки, в который записать таблицу умножения следующего вида:

//1
//2   4
//3   6   9
//4   8  12 16
//5  10 15 20 25
//6  12 18 24 30 36
//7  14 21 28 35 42 49
//8  16 24 32 40 48 56 64
//9   18 27 36 45 54 63 72 81

	int count=1,i,j;
	const int n=10;
	int** A = new int*[n];
 
 	if (( A == NULL) ) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	exit(0);
	}   
	
	for (i=0;i<n;i++){
        A[i] = new int[count];
        for (j=0; j<count; j++)
        	A[i][j]=count*(j+1);
        count++;
    }
    cout<<endl;
	count=1;
	for (i=0;i<n;i++){
        for (j=0; j<count; j++){
			cout.width(3);
			cout<<A[i][j]<<"  ";
		}
        count++;
        cout<<endl;
    }
    
    cout<<endl;
    



} 


main(){ 
	srand(time(NULL));
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text"); 
    int choice; 
   	cout<<"Input number of task (Number from 1 to 2):"; 
    cin>>choice; 
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    }

system("PAUSE");
return 0; 
}




