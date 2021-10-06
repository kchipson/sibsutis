#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 
	//�������� ���������� ����� ��� ��������� ����������������� ����� ��������� �����������, 
	//����� ��������� ������� ���� �� ������ ����������� ������ �������� ��������.
void one(){ 
	//1.	��������� ����������� �������� ����� �� c ������� ���� �������� � ��������� �� e=0.00001, ���
	//Pi=4*(1-1/3+1/5-1/7+1/9�.)
	double Pi=1,x=1,e=0.00001;
	int n=1;
		while (fabs(x)>= e){
			x=(pow((-1),n)/(2*n+1));
			Pi+=x;
			n+=1;
		}
	printf("Pi= %.6f \n",(4*Pi));
} 
float y(float a,float b,float c,float x){
	return ((a*pow(x,2)+b*x+c)*sin(x));
}
void two(){ 
	//2.����� ���������� � ���������� �������� ������� 
	//y= (a*x^2+b*x+c)*sin(x) 
	//��� ��������� x �� x���  �� x ���  � ����� h.  
	//������� �������� y. �������� ������:
	//a  = 2.14;  b= - 4.21;  c = 3.25; x���= -13.5; x��� = -4.5;
	//h= 0.5 .
	//(����� min=-361.783, max=308.497)
	float a,b ,c,x ,xn,xk,h,min,max;
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
	min=max=y(a,b,c,xn);
	x=xn;

	while (x<=xk){
		printf("x= %.3f    y=%.3f\n\n",x,y(a,b,c,x));
		if (min>y(a,b,c,x)) min=y(a,b,c,x);
		if (max<y(a,b,c,x)) max=y(a,b,c,x);
		x+=h;
	}

	printf("--------------------------------\n");
	printf("Ymin= %.3f\n",min);
	printf("Ymax= %.3f\n",max);
	printf("--------------------------------\n");
} 

void three(){ 
	//3.����� � ������� ������� ����� �  �� ���������� � ��������� �� 2 �� n, n ������ � ����������.
	long int n,i=2,del,q;
	printf("n = ");
	scanf("%d",&n);
	printf("--------------------------------\n");
	while (i<=n){
		del=0;
			for (int k=1; k<=i; k++){
				if (i % k==0) del++;
			}
		if (del==2){
			printf("%d  ",i);
			q++;
		}
		i++;
	
	}
	printf("\nq=%d ",q);
	printf("\n");
	
} 


main(){ 
    int choice; 
    printf("Input number of task (Number from 1 to 3): "); 
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

system("PAUSE");
return 0; 
}
