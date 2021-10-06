#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;
#define N 15

void recursion_one(){
	int x;
	cin>>x;
	if (x != 0){
		if (x>0) cout<<x<<"   ";
		recursion_one();	

	} 
	
}
void one(){
	cout<<"Введите числа:\n";
	//1. Ввести в рекурсивной функции с клавиатуры последовательность чисел заканчивающихся числом ноль, и вывести на экран только положительные числа. 
	//Массив не использовать.
	recursion_one();
	cout<<"\n";
} 

void recursion_two(int * a,int i=0, bool plus=0){
	if (i<N){
		if (plus && a[i]>0){
			cout<<a[i]<<" "; 
		}
		if (!plus && a[i]<0){
			cout<<a[i]<<" "; 
		}
		recursion_two(a,i+1, plus);
	}
	else if (!plus){
		recursion_two(a,0, 1);
	}	
}

void two(){ 
	//2. Дан массив ненулевых  целых чисел из N элементов. Используя рекурсию, 
	//напечатать сначала все отрицательные, а потом - все положительные   числа этой последовательности.
	// Реализовать в одной функции, которая вызывается один раз.
	int arr[N];
	srand(time(NULL));
	for (int i=0;i<15;i++)
		arr[i]=rand()%100-50;
	
	cout<<"Начальный массив:\n";
	for (int i=0;i<15;i++)
		cout<<arr[i]<<"  ";
	cout<<"\n\n\n";
	cout<<"Результат:\n";
	recursion_two(arr);

	cout<<"\n";
} 


void recursion_three(int x){
		if (x>0){
			if (x>1)  
				recursion_three(x/2); 
			cout<<(x-(x/2)*2); 
		}
		else cout<"Введите положительное число";
}


void three(){
	//	3. Написать рекурсивную функцию для перевода числа из десятичной системы счисления в двоичную.
	int x;
	cout<<"Введите число: ";
	cin>>x;
	cout<<"\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nЧисло в 10 системе: "<<x<<"\nЧисло в 2 системе: ";
	recursion_three(x);
	cout<<endl;

}

main(){ 
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
    int choice; 
   	cout<<"Input number of task (Number from 1 to 3):"; 
    cin>>choice;
	system("CLS"); 
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    }
    
    else if(choice == 3){ 
        three(); 
    }
    
system("PAUSE");
return 0; 
}




