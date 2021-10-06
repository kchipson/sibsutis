#include <stdlib.h> 
#include <iostream>
#include <math.h>
using namespace std;


double stepen(double,int);
double fact(int);
double cosTaylor(double);

void one(){
	//1.�������� ������� ���������� � ������� y=x?, ��� n - ����� ������������� ��� ������������� �����; x -  ������������ �����. ������������ ����.
	double x;
	int step; 
	system("CLS");
	cout<<"\n�����:   "; 
    cin>>x; 
 	cout<<"\n�������:   "; 
    cin>>step; 
    cout<<"\n***************************************\n�����  "<<x<<" �(��) "<<step<<" ������� = "<<stepen(x,step)<<"\n\n\n";
} 

void two(){ 
//2.�������� ������� ���������� cosinus � ������� ���� �������  cosinus(x) =1 - x2/2! + x4/4! � + ((-1)n *x2n)/(2n!)  � ��������� �� eps=0.0001. 
//� �������� ��������� �������� x. �������� ���������� �������� �� ��������� ����������� ������� cos(x)
	double x;
	system("CLS");
	cout<<"\n������� �����:   "; 
	cin>>x;
	
	cout<<"\n***************************************\n������� �� �������: "<<cosTaylor(x)<<"\n������� ����������� ������� cos(x) ���������� math: "<<cos(x)<<"\n\n\n";
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


//system("PAUSE");
return 0; 
}

double stepen( double x,int n){
	if (n==0){
		return 1;	
	}

	else{
		double res=1;
		if (n>0){
			for (int i=1;i<=n;i++){
				res*=x;
			}
		}
		if (n<0){
			for (int i=-1;i>=n;i--){
				res/=x;
			}		
		}
		return res;
	}	
}


 double factorial(int a){
	double res=1;
	for (int i=1;i<a+1;i++) {
	res*=i;
}
	return res;
	
}

double cosTaylor(double x){
	
//2.�������� ������� ���������� cosinus � ������� ���� �������  cosinus(x) =1 - x2/2! + x4/4! � + ((-1)n *x2n)/(2n!)  � ��������� �� eps=0.0001. 
//� �������� ��������� �������� x. �������� ���������� �������� �� ��������� ����������� ������� cos(x)
	double t=1,eps=0.0001,ch=1;
	int n=1;
	while (x>M_PI*2)
		x-=M_PI*2;
	while(fabs(ch)>eps){
		ch=(pow(-1,n) *pow(x,2*n))/(factorial(2*n));		
		n++;
		t+=ch;
	}
	return t;	
	
}



