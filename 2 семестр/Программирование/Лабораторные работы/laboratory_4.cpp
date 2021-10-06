#include <stdlib.h> 
#include <iostream>
#include <ctime>
using namespace std;

void one(){
//Выполнить следующие задания, используя оператор new и функцию malloc().
//1.Задан двумерный динамический массив B  размерности m x n. (n=5, m вводить с клавиатуры). 
//Заполнить её случайными числами. Получить новую динамическую матрицу С[m-1][n-1]  путем удаления из В строки и столбца,
// в которых содержится максимальный элемент исходной матрицы.
	const int n=5; // количество элементов в строке
	typedef int str[n];//str - новый тип: массив (строка) из n целых чисел
	int i,j,m,max_i=0,max_j=0;
	str *B; // указатель на строку
	cout << "m =  ";
	cin >> m;
	B = new str[m]; // выделяем память под матрицу по адресу a, m строк по n элементов в строке 
	if ( B == NULL ) 
	{   cout << "Не удалось выделить память";
	exit(0);
	}

	// заполняем матрицу случайными числами
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			B[i][j]=rand()%101-50;
		}
	} 

	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			if (B[i][j]>B[max_i][max_j]){
				max_i=i;
				max_j=j;
			}		
		}
	}
	typedef int str2[n-1];//str2 - новый тип: массив (строка) из n-1 целых чисел
	str2* C;
	C = (str2*)malloc((m-1)*sizeof(str2));
	
	if ( C == NULL ) 
	{   cout << "Не удалось выделить память";
	exit(0); 
	}
	
	for (i=0; i<m; i++){  
		if (i<max_i){
			for (j=0; j<n; j++){
				if (j<max_j){
					C[i][j]=B[i][j];
				}	
				else if(j>max_j){
					C[i][j-1]=B[i][j];
				}	
			}
		}
		else if(i>max_i){
			for (j=0; j<n; j++){
				if (j<max_j){
					C[i-1][j]=B[i][j];
				}	
				else if(j>max_j){
					C[i-1][j-1]=B[i][j];
				}	
			}			
		}
	}
	cout<<"B массив: "<<endl;
	
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			cout.width(3);
			cout<<B[i][j]<<"  ";
		}
		cout<<endl;
	}
	
	
	cout<<"C массив: "<<endl;

	for (i=0; i<m-1; i++){  
		for (j=0; j<n-1; j++){
			cout.width(3);
			cout<<C[i][j]<<"  ";
		}
		cout<<endl;
	}
	
	cout<<endl;
	free(C);
	delete B; 

} 





void two(){ 
//Выполнить следующие задания, используя оператор new и функцию malloc().
//2. Задан двумерный динамический массив А  размерности   m x n. ( m и n вводить с клавиатуры).
//Заполнить его случайными числами.  Создать массив D  размером m+1 на  n+1, в который записать элементы массива А 
//и суммы элементов соответствующих строк и столбцов исходного массива А.  
//В элемент D[m+1][n+1] поместить сумму всех элементов исходного массива.

	int n,m,i,j;
    cout << "Введите n: ";
    cin >> n;
    cout << "Введите m: ";
    cin >> m;
    typedef int str[n];//str - новый тип: массив (строка) из n целых чисел
	str* A;
	A = (str*)malloc((m)*sizeof(str));
	if ( A == NULL ){
		cout << "Не удалось выделить память";
		exit(0); 
	}
	// заполняем матрицу случайными числами
	for (i=0; i<m; i++){  
		for (j=0; j<n; j++){
			A[i][j]=rand()%101-50;
		}
	} 
	
	
    int** D = new int*[n+1];
    for (int i = 0; i < m+1; i++){
        D[i] = new int[n+1];
    }
    
    if ( D == NULL ){
		cout << "Не удалось выделить память";
		exit(0); 
	}
    int sum=0; // Сумма всего массива
    for (i=0;i<m;i++){  //Заполнение крайнего правого столбца и подсчет суммы
    	D[i][n]=0;
    	for (j=0; j<n;j++){
    		D[i][j]=A[i][j];
    		sum+=A[i][j];
    		D[i][n]+=A[i][j];
		}
	}
	
	for (i=0;i<n;i++){  //Заполнение крайней нижней строки
    	D[m][i]=0;
    	for (j=0; j<m;j++){
    		D[m][i]+=D[j][i];
		}	
	}
	D[m][n]=sum;



	for (i=0; i<m+1; i++){  // Вывод измененного массива
		for (j=0; j<n+1; j++){
			cout.width(3);
			cout<<D[i][j]<<"  ";
		}
		cout<<endl;
	} 
	
	free(A);
	delete D; 

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




