#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 
#include <vector>
using namespace std;
int random (int N) { return rand()%N; }

float y(float a,float b,float c,float x){
	return ( a*pow(x,2)*sin(x)+b*x+c );
}
void one(){ 
	//1. Вычислить и записать в массив значения функции y=a*x2*sin(x)+b*x+c при изменении x от хнач до хкон с шагом h. Массив значений отсортировать по убыванию методом пузырька и напечатать.  
	//a =2.14;  b= -4.21; c= 3.25; хнач = -4.5, хкон= -33.5, h= 0.5; 
	float a,b,c,x,xn,xk,h;

	printf("a,b,c = ");
	scanf("%f %f %f",&a,&b,&c);
	printf("--------------------------------\n");
	printf("x nachal'noe = ");
	scanf("%f",&xn);
	printf("x konechnoe = ");
	scanf("%f",&xk);
	printf("--------------------------------\n");
	printf("shag = ");
	scanf("%f",&h);
	printf("--------------------------------\n");
	int z=(int(abs(xk-xn)/h));
	double arr[z],men;
	x=xn;
	for (int i=0; i<=z; i++){
		arr[i]= y(a,b,c,x);
		printf("x=  %f  a[%d]=  %f \n",x,i,arr[i]);
		x-=h;
	}

	for ( int i = 0; i < z; i ++ ) 
		for ( int j = z-1; j >= i; j -- ) 
			if ( arr[j] < arr[j+1] ){		
				men = arr[j]; 
				arr[j] = arr[j+1];
				arr[j+1] = men;
			}
	printf("\n Massiv znachenij po ubyvaniyu:\n");
	for ( int i = 0; i <= z; i++ )
		printf("%f  ", arr[i]);
	printf("\n");
} 

void two(){ 
	//2.  Сформировать с помощью датчика случайных чисел в диапазоне     [0,10] массив из 15 элементов целого типа. Вывести его на экран.  
	//Вывести элементы массива, исключая ранее встречавшиеся.
	int arr[15], a = 0, b = 10;	
	for (int i = 0; i < 15; i++ )
		arr[i] = random(b-a+1) + a;
	printf("\nArray:\n");      
	for ( int i = 0; i < 15; i ++ )
		printf("%2d  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n");	
	printf("Array without repetition:\n"); 
	bool boo; 
	for ( int i = 0; i < 15; i ++ ){
		boo=0;
		for (int j = 0; j < i; j++ ){
			if (arr[i]==arr[j]){
				boo=1;
				break;
			}		
		}
		if (boo==0)
			printf("%2d  ",arr[i]);	
	}
	printf("\n"); 		
} 

void three(){ 
	//3. Сформировать с помощью датчика случайных чисел в диапазоне [-10,10]     
	//массив из 20 элементов вещественного типа. Вывести его на экран.  
	//Сформировать из положительных элементов массива А массив В. Вывести массив В
	float arr[20];
	int a = -10, b = 10;	
	for (int i = 0; i < 20; i++ )
	arr[i] = (float)rand()*(b-a)/RAND_MAX + a; 
	printf("\nArray:\n");      
	for ( int i = 0; i < 20; i++ )
		printf("%3f  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	vector<float>  arrB;  	
	for ( int i = 0; i < 20; i ++ ){
		if (arr[i]>0){
			arrB.push_back(arr[i]);
		}
	}
	printf("\nArrayB '+':\n");
	for ( int i = 0;i<arrB.size() ; i++ )
		printf("%3f  ",arrB[i]);
	printf("\n");
			
} 

void four(){ 
	//4. Сформировать с помощью датчика случайных чисел в диапазоне [0,20] два массива C и D, из 20 элементов целого типа каждый. 
	//Вывести их на экран.  Отсортировать массивы C и D по возрастанию и объединить их в массив E, таким образом, чтобы он также 
	//оказался отсортирован (добиться сортировки массива Е алгоритмом объединения, заново массив Е не сортировать!) 

	int a = 0, b = 20,c; 
	int arrC[20];	
	for (int i = 0; i < 20; i++ )
		arrC[i] = random(b-a+1) + a;
	printf("\nArray C:\n");      
	for ( int i = 0; i < 20; i ++ )
		printf("%2d  ",arrC[i]);	
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");	
	
	int arrD[20];
	for (int i = 0; i < 20; i++ )
		arrD[i] = random(b-a+1) + a;
	printf("\nArray D:\n");      
	for ( int i = 0; i < 20; i ++ )
		printf("%2d  ",arrD[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
		
	for (int i = 0; i < 20-1; i++ ) 
		for (int j = 20-2; j >= i; j-- ){
			if ( arrC[j] > arrC[j+1] ){ 
				c = arrC[j]; 
				arrC[j] = arrC[j+1]; 
				arrC[j+1] = c;
			}
			if ( arrD[j] > arrD[j+1] ){ 
				c = arrD[j]; 
				arrD[j] = arrD[j+1]; 
				arrD[j+1] = c;
			}
		} 
			
	printf("\n Otsortirovannyj massiv C:\n");
	for (int i = 0; i < 20; i++ )
		printf("%2d  ", arrC[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	printf("\n Otsortirovannyj massiv D:\n");
	for (int i = 0; i < 20; i++ )
		printf("%2d  ", arrD[i]);	
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	
	vector<int>  arrE; 
	for (int i = 0; i < 20; i++ ){
		if (arrC[i]<arrD[i]){
			arrE.push_back(arrC[i]);
			if (arrD[i]<arrC[i+1])
				arrE.push_back(arrD[i]);
			else 
				arrE.push_back(arrC[i+1]);
		}
		else{
			arrE.push_back(arrD[i]);
			if (arrC[i]<arrD[i+1])
				arrE.push_back(arrC[i]);
			else 
				arrE.push_back(arrD[i+1]);
		}
	}
	printf("\nOb_edinennye massivy C i D v massiv E:\n");
	for ( int i = 0;i<arrE.size() ; i++ ){
		printf("%2d  ",arrE[i]);	
	}
	printf("\n");

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
