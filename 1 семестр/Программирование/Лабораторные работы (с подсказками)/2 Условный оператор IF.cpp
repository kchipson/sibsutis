#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 

void one(){ 
	//1)	���� 6 �����. �� ������� �� ����� ������ ��� ������ �� ������������?	
	float a[6]; 
	printf ("\n input ch1,ch2,ch3,ch4,ch5,ch6:\n");
	scanf ("%f%f%f%f%f%f",&a[0],&a[1],&a[2],&a[3],&a[4],&a[5]);
	(a[0]*a[1]*a[2]*a[3]*a[4]*a[5])>(a[0]+a[1]+a[2]+a[3]+a[4]+a[5])?printf("Summa men'she proizvedeniya na %.2f",a[0]*a[1]*a[2]*a[3]*a[4]*a[5]-(a[0]+a[1]+a[2]+a[3]+a[4]+a[5])) : (a[0]+a[1]+a[2]+a[3]+a[4]+a[5])>(a[0]*a[1]*a[2]*a[3]*a[4]*a[5])?printf("Summa bol'she proizvedeniya na %.2f",(a[0]+a[1]+a[2]+a[3]+a[4]+a[5]-a[0]*a[1]*a[2]*a[3]*a[4]*a[5])):printf("Summa ravna proizvedeniyu");
	printf ("\n");
	system("PAUSE");
} 

void two(){ 
	//2)	���� 5 �����.  ��������� ����� ������������� ����� ��� �����.
    float a[5]; 
    printf("Input ch1,ch2,ch3,ch4,ch5: "); 
    scanf("%f%f%f%f%f",&a[0],&a[1],&a[2],&a[3],&a[4]); 
	float sum=0;
    for(int i=0; i<5; i++){
    	if(a[i]>0) sum+=a[i];
    }
    printf ("\n Summa polozhitel'nyh chisel ravna %.2f\n", sum);
    system("PAUSE"); 
} 

void three(){ 
	//3)	���� 4 �����. ��� ������������� ����� ��� ����� �������� �� 0. 
    float a[4];
    printf("Input ch1,ch2,ch3,ch4: "); 
    scanf("%f %f %f %f",&a[0],&a[1],&a[2],&a[3]); 
    for(int i=0; i<4; i++){
    	if(a[i]<0) a[i]=0; 
    }
	printf ("\nNovyj poryadok %.2f, %.2f, %.2f, %.2f\n",a[0],a[1],a[2],a[3]);
	system("PAUSE");
} 

void four(){ 
	//4)	���� 8 �����. ���������� ������� ����� ��� ������������� � ������� �������������.
    float a[8];
    int m=0, p=0;
    printf ("\n input ch1,ch2,ch3,ch4,ch5,ch6,ch7,ch8 :\n");
    scanf ("%f%f%f%f%f%f%f%f",&a[0],&a[1],&a[2],&a[3],&a[4],&a[5],&a[6],&a[7]);
    for(int i=0; i<8; i++){
      if(a[i]>0) p++;
      else if(a[i]<0) m++;
    }
    	printf ("\n~~~~~~~~~~~~~~~~~~~\nPolozhitel'nyh  %i \nOtricatel'nyh  %i \n~~~~~~~~~~~~~~~~~~~\n\n",p,m);
	system("PAUSE");
} 

void five(){ 
    //5)	���� 4 �����. ���������� ���������� �����  �����������  ����� ���.
    float a[4];
    int m, n;
    printf ("\n input ch1,ch2,ch3,ch4 :\n");
    scanf ("%f%f%f%f",&a[0],&a[1],&a[2],&a[3]);
    m=a[0];
    for(int i=0; i<4; i++){
    	if(a[i]<m) m=a[i];
    }
    printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nPoryadkovyj(e) nomer(a) naimen'shego(yh) chisla(el) iz spiska: ");
    for(int i=0; i<4; i++){
    	if(a[i]==m) printf("%d; ",(i+1));
	}
    printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    system("PAUSE");
} 

void six(){ 
	//6)  ���� ������ �����. ����� �������� ����� ���������� � ���������� ����� ���.
	int ch1,ch2,ch3,ch4;
	printf ("\n input ch1,ch2,ch3,ch4 :\n");
	scanf ("%i%i%i%i",&ch1,&ch2,&ch3,&ch4);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nRaznost' mezhdu naibol'shim i naimen'shim chislah- %i\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n",(ch1>ch2&&ch1>ch3&&ch1>ch4 ? ch1 : ch2>ch3&&ch2>ch4? ch2 : ch3>ch4 ?ch3:ch4)-(ch1<ch2&&ch1<ch3&&ch1<ch4 ? ch1 : ch2<ch3&&ch2<ch4? ch2 : ch3<ch4 ?ch3:ch4));
	system("PAUSE");
} 

void seven(){ 
	//7) ���� 3 �����  K, M  � N. �������� �� �������� ������� ����� �������, ����� K < M < N.
	float k,m,n;

	printf ("\n input k,m,n:\n");
	scanf ("%f%f%f",&k,&m,&n);

	if (k>m){
		k+=m; 
		m =k-m; 
		k =k-m;
	}
	
	if (m>n){
	m+=n; 
	n =m-n; 
	m =m-n;
	}
	
	if (k>m){
		k+=m; 
		m =k-m; 
		k =k-m;
	}
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n K < M < N:\n %.2f <%.2f <%.2f\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n",k,m,n);
	system("PAUSE");

} 

void eight(){ 
	//8) ���� 4 ������ �����. ����� ����� ��� ��� ����������.
	float ch1,ch2,ch3,ch4,MAX,max;

	printf ("\n input ch1,ch2,ch3,ch4:\n");
	scanf ("%f%f%f%f",&ch1,&ch2,&ch3,&ch4);

	MAX=ch1>ch2&&ch1>ch3&&ch1>ch4 ? ch1 : ch2>ch3&&ch2>ch4? ch2 : ch3>ch4 ?ch3:ch4;
	if (ch1==MAX){
		max=ch2>ch3&&ch2>ch4? ch2 : ch3>ch4 ?ch3:ch4;
	}
	else if (ch2==MAX){
		max=ch1>ch3&&ch1>ch4? ch1 : ch3>ch4 ?ch3:ch4;
	}
	else if (ch3==MAX){
		max=ch1>ch2&&ch1>ch4? ch1 : ch2>ch4 ?ch2:ch4;
	}
	else if (ch4==MAX){
		max=ch1>ch2&&ch1>ch3? ch1 : ch2>ch3 ?ch2:ch3;
	}
	
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n Dva naibol'shih chisla: %.2f & %.2f\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n",MAX,max);
	system("PAUSE");

} 

void nine(){ 
	//9) ���� 3 �����. ��������  ������� ������� � ������� ��  ���� �����.
	float ch1,ch2,ch3;

	printf ("\n input ch1,ch2,ch3:\n");
	scanf ("%f%f%f",&ch1,&ch2,&ch3);

	if ((ch1<ch2&&ch1>ch3)||(ch1>ch2&&ch1<ch3)){
		ch2 = ch2 + ch3; 
		ch3 = ch2 - ch3; 
		ch2 = ch2 - ch3;
	}
	else if ((ch2<ch1&&ch2>ch3)||(ch2>ch1&&ch2<ch3)){
		ch1 = ch1 + ch3; 
		ch3 = ch1 - ch3; 
		ch1 = ch1 - ch3;
	}
	else if ((ch3<ch1&&ch3>ch2)||(ch3>ch1&&ch3<ch2)){
		ch1 = ch1 + ch2; 
		ch2 = ch1 - ch2; 
		ch1 = ch1 - ch2;
	}
} 
main(){ 
    int choice; 
    printf("Input number of task (Number from 1 to 9):"); 
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
    else if(choice == 5){ 
        five(); 
    } 
    else if(choice == 6){ 
        six(); 
    } 
    else if(choice == 7){ 
        seven(); 
    } 
    else if(choice == 8){ 
        eight(); 
    } 
    else if(choice == 9){ 
        nine(); 
    } 

return 0; 
}
