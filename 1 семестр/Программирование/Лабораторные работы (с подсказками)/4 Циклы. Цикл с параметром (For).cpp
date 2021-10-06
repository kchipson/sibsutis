#include <stdlib.h> 
#include <stdio.h>
#include <math.h>

void one(){ 
     //1)   S= 1+ 2 + 3+...+ 117;  (s=6903)
     int S=0;
     for(int i=1; i<118; i++){
         S+=i;
     }
     printf("S= %d \n", S);
} 

void two(){ 
     //2)   S= sin1 + sin 2 +...+ sin25;  (s=-0.058)
     float S=0;
     for(int i=1; i<26; i++){
         S+=sin(i);
     }
     printf("S= %.3f \n", S);
}
void three(){ 
     //3)   S= tg2 + tg4 +...+ tg(N*2); N = ввести с клавиатуры (при N=19 S=1)
     float S=0;
     int n;
     printf("input n: ");
     scanf("%d",&n);
     for(int i=1; i<=n; i++){
         S+=tan(i*2);
     }
     printf("S= %.2f \n", S);
} 

void four(){ 
     //4)   S= ln 0.1 + ln 0.3 +...+ ln1.9  (s=-2.726)
     float S=0, x=0.1;
     for(int i=0; i<10; i++){
         S+=log(x);
         x+=0.2;
         printf("S= %.3f \n", S);
     }
} 

void five(){ 
    //5)   S= 0.18x + (0.20x)^2 + (0.22x)^3 +...+ (0.36x)^10;
    //(x=1, s=0.236)
    float S, s, x, n=0.02;
    printf("Input X: ");
    scanf("%f", &x);
    for(int i=1; i<11; i++){
    	s=((0.16+n)*x);
    	S+= pow(s,i);
    	n+=0.02;
	}
	printf("S= %.3f \n", S);
}

void six(){ 
	//6) S= 1 - 2 + 3 - 4 + ... + (- 1)**N, N > 0 выводится с клавиатуры. 
	//(n=20, s=-10) 
	int n,s=0; 
	printf("Input N: "); 
	scanf("%d", &n); 
	for(int i=1; i<=n; i++){ 
		s+=pow((-1),(i+1))*i; 
		} 
	printf("S= %d \n",(s));  
}

void seven(){ 
    //7)   P= M! = 1* 2* 3*...*M, M вводится с клавиатуры; (m=5, P=120)
    int P=1, m;
    printf("Input M: ");
    scanf("%d", &m);
    for(int i=1; i<=m; i++){
    	P*=i;
	}
	printf("P= %d \n", P);
}

void eight(){ 
    //8)   P= 2* 4* 6*...* 12;   (P=46080)
	int P=1, x;
	printf("Input Number: ");
	scanf("%d", &x);
	for(int i=2; i<=x; i+=2){
		P*=i;
	}
	printf("P= %d \n", P);
}

void nine(){ 
    //9)  S= 1+ x/1! + x**2/2!+...+ x**N/N!, N>0 вводится с клавиатуры. (x=5, N=10, s=146.38)
	float S=1, x, N;
    int F=1;
	printf ("Input x, N: ");
    scanf ("%f%f",&x,&N);
	for(int i=1; i<=N; i++){
		F*=i;
		S+=(pow(x,i)/F);
	}
	printf("S= %.2f \n", S);
}
main(){ 
    int choice; 
    printf("Input number of task (Number from 1 to 9): "); 
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
    system("PAUSE");
return 0; 
}
