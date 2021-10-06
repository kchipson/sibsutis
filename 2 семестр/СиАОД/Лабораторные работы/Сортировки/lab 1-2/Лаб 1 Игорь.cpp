#include <stdio.h>
#include <conio.h>
#include <iostream>
#include <math.h>
#include <ctime>
using namespace std;


void CheckSum(int A[],int n){
     int f=0;
     for(int i=0;i<n;i++){
             f+=A[i];
     }
     cout << f<<endl;
     cout << endl;
}
void RunNumber(int A[],int b[],int n){
     int k=1,f=1,d=0,s=0;
     for(int i=0;i<n-1;i++){
         f++;
         if(A[i]>A[i+1]){
            k++;
            b[d]=f;
            d++;
            f=0;
            }
     }

     for(int i=0;i<k;i++){
             s+=b[i];
     }
     
     cout<<k <<" "<<(float)s/(float)k;
     cout << endl;
     
}
void PrintMas(int A[],int n){
     for(int i=0;i<n;i++){
             cout << A[i]<<" ";
     }
     cout << endl;
}

void FillInc(int A[],int b[],int n){
     int t;
     for(int i=1;i<=n;i++){
             A[i-1]=i;
     }
     cout << "Выберите функцию"<<endl;
    cout << "1.CheckSum"<<endl;
    cout << "2.RunNumber"<<endl;
    cout << "3.PrintMas"<<endl;
     cin>>t;
     switch(t){
    case 1 : CheckSum(A,n);
    break;
    case 2 : RunNumber(A,b,n);
    break;
    case 3 : PrintMas(A,n);
    break;
}
}
void FillDec(int A[],int b[],int n){
     int t;
     for(int i=n;i>0;i--){
             A[n-i]=i;
     }
     cout << "Выберите функцию"<<endl;
    cout << "1.CheckSum"<<endl;
    cout << "2.RunNumber"<<endl;
    cout << "3.PrintMas"<<endl;
     cin>>t;
    switch(t){
    case 1 : CheckSum(A,n);
    break;
    case 2 : RunNumber(A,b,n);
    break;
    case 3 : PrintMas(A,n);
    break;
}
}
//int FillRand(int A[],int b[],int n){
//	srand( time(NULL) );
//     int t;
//     for(int i=0;i<n;i++){
//             A[i]= rand() % n;
//     }
//     cout << "Выберите функцию"<<endl;
//    cout << "1.CheckSum"<<endl;
//    cout << "2.RunNumber"<<endl;
//    cout << "3.PrintMas"<<endl;
//     cin>>t;
//    switch(t){
//    case 1 : CheckSum(A,n);
//    break;
//    case 2 : RunNumber(A,b,n);
//    break;
//    case 3 : PrintMas(A,n);
//    break;
//    }
//}

int main(){
    int n;
    cin>>n;
    int A[n];
    int b[n];
    int t,f=1;
    while(f){
    cout << "Выберите функцию"<<endl;
    cout << "1.FillInc"<<endl;
    cout << "2.FillDec"<<endl;
    cout << "3.FillRand"<<endl;
    cout << "4.Quit"<<endl;
    cin>>t;
    switch(t){
    case 1 : FillInc(A,b,n);
    break;
    case 2 : FillDec(A,b,n);
    break;
//    case 3 : FillRand(A,b,n);
    break;
    case 4 : f=0;
    break;
    }
}
    system("PAUSE");
}
