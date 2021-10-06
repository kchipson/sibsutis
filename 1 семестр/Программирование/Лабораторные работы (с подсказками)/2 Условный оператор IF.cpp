#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 

void one(){ 
	//1)	Даны 6 чисел. На сколько их сумма меньше или больше их произведения?	
	float a[6]; 
	printf ("\n input ch1,ch2,ch3,ch4,ch5,ch6:\n");
	scanf ("%f%f%f%f%f%f",&a[0],&a[1],&a[2],&a[3],&a[4],&a[5]);
	(a[0]*a[1]*a[2]*a[3]*a[4]*a[5])>(a[0]+a[1]+a[2]+a[3]+a[4]+a[5])?printf("Summa men'she proizvedeniya na %.2f",a[0]*a[1]*a[2]*a[3]*a[4]*a[5]-(a[0]+a[1]+a[2]+a[3]+a[4]+a[5])) : (a[0]+a[1]+a[2]+a[3]+a[4]+a[5])>(a[0]*a[1]*a[2]*a[3]*a[4]*a[5])?printf("Summa bol'she proizvedeniya na %.2f",(a[0]+a[1]+a[2]+a[3]+a[4]+a[5]-a[0]*a[1]*a[2]*a[3]*a[4]*a[5])):printf("Summa ravna proizvedeniyu");
	printf ("\n");
	system("PAUSE");
} 

void two(){ 
	//2)	Даны 5 чисел.  Вычислить сумму положительных среди них чисел.
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
	//3)	Даны 4 числа. Все отрицательные среди них числа заменить на 0. 
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
	//4)	Даны 8 чисел. Определить сколько среди них отрицательных и сколько положительных.
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
    //5)	Даны 4 числа. Определить порядковый номер  наименьшего  среди них.
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
	//6)  Даны четыре числа. Найти разность между наибольшим и наименьшим среди них.
	int ch1,ch2,ch3,ch4;
	printf ("\n input ch1,ch2,ch3,ch4 :\n");
	scanf ("%i%i%i%i",&ch1,&ch2,&ch3,&ch4);
	printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\nRaznost' mezhdu naibol'shim i naimen'shim chislah- %i\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n",(ch1>ch2&&ch1>ch3&&ch1>ch4 ? ch1 : ch2>ch3&&ch2>ch4? ch2 : ch3>ch4 ?ch3:ch4)-(ch1<ch2&&ch1<ch3&&ch1<ch4 ? ch1 : ch2<ch3&&ch2<ch4? ch2 : ch3<ch4 ?ch3:ch4));
	system("PAUSE");
} 

void seven(){ 
	//7) Даны 3 числа  K, M  и N. Поменять их значения местами таким образом, чтобы K < M < N.
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
	//8) Даны 4 разных числа. Найти среди них два наибольших.
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
	//9) Даны 3 числа. Поменять  местами большее и меньшее из  этих чисел.
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
