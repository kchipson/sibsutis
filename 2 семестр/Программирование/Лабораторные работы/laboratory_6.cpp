#include <stdlib.h> 
#include <iostream>
#include <math.h>
#include <windows.h>
using namespace std;

int calculation (int a,int b,int c,float *P,float *S){
	
	*P=a+b+c;
	*S=sqrt((*P/2)*((*P/2)-a)*((*P/2)-b)*((*P/2)-c));
	if ((a < b+c) && (b < a+c) && (c < a+b))
		return 0;
	else return 1;
	
}

void one(){
//1. Написать функцию, которая вычисляет периметр и площадь треугольника.
// В функцию передаётся длина его сторон. Результаты возвращаются через параметры-указатели. 
//В функции также предусмотреть ошибку в введённых данных 
//(если такой треугольник может существовать, функция возвращает 1, иначе 0 через своё имя).
	int a,b,c;
	float P,S;
	cout<< "Стороны треугольника: ";
	cin>> a>>b>>c;

	if (calculation(a,b,c,&P,&S)==0){
		cout<<"Периметр треугольника: "<< P<<endl<<"Площадь треугольника: "<< S<<endl;
	}
	else cout<<"Введены некорректные стороны треугольника!"<<endl;
} 

long long factorial(int a){
	long long res=1;
	for (int i=1;i<a+1;i++) {
		res*=i;
	}
	return res;	
}

void probability(int n,int m,float &pd,float &pm){
	float p=0.45;
	float q=1-p;
	float c=(factorial(n)/(factorial(m)*factorial(n-m)));
//	cout<<"c= "<<c<<endl;
//	cout<<"pow(p,m)= "<<pow(p,m)<<endl;
//	cout<<"pow(q,n-m)= "<<pow(q,n-m)<<endl;
	pd= c*pow(p,m)*pow(q,n-m);
//	cout<<"pow(q,m)= "<<pow(q,m)<<endl;
//	cout<<"pow(p,n-m)= "<<pow(p,n-m)<<endl;
	pm= c*pow(q,m)*pow(p,n-m);
}

void two(){ 
//СМ. ДОКУМЕНТ
	int n,m;
	do{	
		cout<< "Введите n: ";
		cin >> n;
		if (n<0) cout<<"Ошибка ввода!Проверьте корректрость введенных данных!"<<endl;
		Sleep(200);
		system("CLS");
	}while(n<0);
	
	do{	
		cout<<endl<< "Введите m: ";
		cin >>m;
		if (m>n) cout<<"Ошибка ввода!Проверьте корректрость введенных данных!"<<endl;
		Sleep(200);
		system("CLS");
	}while(m>n);
	
	float pd,pm;
	probability(n,m,pd,pm);
	
	cout<< "Вероятность того, что среди n детей будет m девочек= "<<pd<<endl;
	cout<< "Вероятность того, что среди n детей будет m мальчиков= "<<pm<<endl;

	
} 


main(){ 
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




