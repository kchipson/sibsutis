#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 
#include <vector>
int random (int N) { return rand()%N; }
void one(){ 
	//1. Сформировать с помощью датчика случайных чисел в диапазоне [-10,10] массив из 20 элементов целого типа. 
	//Вывести его на экран.  Затем вывести на экран  все положительные элементы массива, и все отрицательные элементы.
	
	int arr[20], a = -10, b = 10;	
	for (int i = 0; i < 20; i++ )
		arr[i] = random(b-a+1) + a;
	printf("\nArray:\n");      
	for ( int i = 0; i < 20; i ++ )
		printf("%3d  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	printf("\n'+' chisla:  \n");
	for ( int i = 0; i < 20; i ++ )
		if (arr[i]>0)
			printf("%3d  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	printf("\n'-' chisla:  \n");
	for ( int i = 0; i < 20; i ++ )
		if (arr[i]<0)
			printf("%3d  ",arr[i]);
	printf("\n");
} 
long int fac(int n){
	long int fac=1;
	for (int i=1;i<=n;i++)
		fac*=i;
	return fac;
}
void two(){ 
	//2. Для значений i=1, 2,..,n вычислить число сочетаний из n по
	//i и занести результаты в массив  С={С1,С2,..,Сn}, используя
	//Ci= n!/(i!(n - i)!).  Число n>0 ввести с клавиатуры. Полученный массив       вывести на экран.
	int n;
	printf("n=  ");
	scanf("%d",&n);
	std::vector<int>  arr;	
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	for (int i = 1; i <= n; i++ )
		arr.push_back( fac(n)/(fac(i)*fac(n-i)));
	printf("\nArray:\n");      
	for ( int i = 0; i < n; i ++ )
		printf("%2d  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
} 

void three(){ 
	//3.	Сформировать с помощью датчика случайных чисел в диапазоне [0,10] массив из 20 элементов вещественного типа.
	// Вывести его на экран. Вывести элементы массива, большие своих соседей справа и слева.
	float arr[20];
	int a = 0, b = 10;	
	srand(1);
	for (int i = 0; i < 20; i++ )
	arr[i] = (float)rand()*(b-a)/RAND_MAX + a; 
	printf("\nArray:\n");      
	for ( int i = 0; i < 20; i ++ )
		printf("%2f  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
	printf("\nEhlementy massiva, bol'shie svoih sosedej:  \n");
	for ( int i = 1; i < 19; i ++ )
		if ((arr[i]>arr[i-1])&&(arr[i]>arr[i+1]))
			printf("%f  ",arr[i]);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
		
} 

void four(){ 
//4.	Написать программу для проверки номера банковской карты по алгоритму Луна 
//(необходимо просуммировать все четные по номеру цифры последовательности, далее прибавить к сумме все нечетные по номеру цифры,
// помноженные на 2, при этом если произведение получается больше 9, то из него вычитается 9. Сумма должна быть кратной 10).
//4111111111111111- да
	int card, card2, c=0,res=0;
	printf("Number card: ");
	scanf("%d",&card);
	card2=card;
	while(card2){
		card2/=10;
		c++;		
	}
	
	int arr[c];
	for (int i=c-1;i>=0;i--){
		arr[i]=card%10;
		card/=10;
	}
	for (int i=0;i<c;i+=2)	
		res+=arr[i];
	for (int i=1;i<c;i+=2)
		res+=arr[i]*2>9?(arr[i]*2-9):(arr[i]*2);
	res%10==0?printf("Nomer vernyj\n"):printf("Nomer nevernyj\n");
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
