#include <stdlib.h> 
#include <iostream>
#include <math.h>
#include <ctime>

using namespace std;
const int n=10;
int A[n];  

int RunNumber(){
    int sequence=1;
    for (int i=0;i<n-1;i++)
        if(A[i]>A[i+1]) sequence++;
    cout<<endl<<"sequence= "<<sequence<<endl;
    return 0;
}

int CheckSum(){
    int sum=0;
    for (int i=0;i<n;i++)
        sum+=A[i];
    cout<<endl<<"Sum= "<<sum;
    return 0;
}
int Addition(){
	int min1=0,min2=1;
	for (int i=1;i<n;i++)
    	if (A[i]<A[min1])
      		min1=i;
	for (int i=1;i<n;i++)
       	if (A[i]<A[min2] && i!=min1)
        	min2=i;  	
    //cout<<endl << "min1= " <<	min1<<endl << "min2= " <<min2<<endl;
    if (min2>min1)
		for (int i=min1+1;i<min2;i++)
	        if (min1!=min2)
				A[i]=0;	
	if (min2<min1)
		for (int i=min2+1;i<min1;i++)
	        if (min1!=min2)
				A[i]=0;	
}

int PrintMas(){
     for (int i=0;i<n;i++)
          cout<<A[i]<<" ";
     CheckSum();
     RunNumber();
     return 0;
}

int FillInc(){   
    for (int i=0;i<n;i++)
		A[i]=i;
    PrintMas();
    Addition();
    PrintMas();
     return 0;
}

int FillDec(){
     for (int i=0;i<n;i++)
          A[i]=n-i-1;
    PrintMas();
    Addition();
    PrintMas();
     return 0;
}

int FillRand(){
     srand(time(NULL));
     for (int i=0;i<n;i++)
          A[i]=rand() % n;
    PrintMas();
    Addition();
    PrintMas();
     return 0;
}



main(){ 
	int choice; 
   	cout<<"Input number of task (Number from 1 to 3):"; 
    cin>>choice; 
    if(choice == 1){ 
        FillInc(); 
    } 
    else if(choice == 2){ 
        FillDec(); 
    }
    else if(choice == 3){ 
        FillRand(); 
    }

system("PAUSE");
return 0; 
}




