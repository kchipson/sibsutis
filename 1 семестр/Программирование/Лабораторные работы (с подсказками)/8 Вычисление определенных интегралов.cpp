#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 
#include <vector>

void one(){ 
	//1.f(x)=(1-x) lg x/?(1-lg x);  a=2; b=7;   
	
	//1) ‘ормула трапеций
	//I1=h*(a[0]/2+a[1]+a[2]+Е+a[N-1]+a[N]/2)
	//2) ‘ормула —импсона
	//I2=h/3*( a[0]+a[N] + 4*(a[1]+a[3]+Е+a[N-1]) +
	//2*(a[2]+a[4]+Е+a[N-2]))

	float a,b,h,x,I1=0,I2=0;
	int i,n;
	printf("n (10,100,1000)= ");
	scanf("%d",&n);

	printf("\na,b = ");
	scanf("%f %f",&a,&b);
	h=(b-a)/n;
	printf("h = %f\n",h);
	float arr[int(n+1)];
	
	for ( i=0,  x=a; i<=n; i++,x+=h){
		//(1-x) lg x/(корень(1-lg x))
		arr[i]=((1-x)*log10(x))/sqrt(1-log10(x));
		printf("x = %f   arr[%d]=%f\n",x,i,arr[i]);
	}
	
	for ( i=0;i<=n;i++){
	//1) ‘ормула трапеций
	//I1=h*(a[0]/2+a[1]+a[2]+Е+a[N-1]+a[N]/2)
	//2) ‘ормула —импсона
	//I2=h/3*( a[0]+a[N] + 4*(a[1]+a[3]+Е+a[N-1]) +
	//2*(a[2]+a[4]+Е+a[N-2]))
		if (i==0 || i==n) {
			I1+=(arr[i]/2);
			I2+=arr[i];	
			
		}
		
		else{
			I1+=arr[i];
			if (i & 1) I2+=arr[i]*4;
			else I2+=arr[i]*2;
		}
	}
	
	printf("\nI1=%.3f\nI2=%.3f\n",I1*h, h/3*I2);
		
} 

main(){ 
    one(); 
	system("PAUSE");
	return 0; 
}
