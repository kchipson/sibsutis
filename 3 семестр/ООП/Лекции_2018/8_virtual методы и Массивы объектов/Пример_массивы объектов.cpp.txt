#include <iostream>
#include <conio.h>
#include <stdlib.h>

using namespace std;

class A{
 protected:
      int  x;
public:
     A(){cout<< "Constr-r  A default \n"; };
     A(int i){cout<< "Constr-r  A initialized \n"; }; 

}; 

class B{
 protected:
      int  y;
public:
    // B(int  j)  {cout<< "Constr-r B \n"; }; 
   virtual  void  Show(void) {cout<< "function Show B"<<"  "<<this<<endl; };
}; 

class D: public B{
 
public:
    // B(int  j)  {cout<< "Constr-r B \n"; }; 
   virtual  void  Show(void) {cout<< "function Show D "<<"  "<<this<<endl; };
}; 

int main()  { 

  /* A aobj(25);   // работает конструктор с параметром  
                                              //     (инициализации)  A(int   i)
   A a1obj;    // работает конструктор без параметров
                                               //                 (по умолчанию) A()
   //B bobj(10);   // ошибка: не работает конструктор с параметром 
                                               //        (инициализации) B(int j)
   B  b1obj; // - ???

  b1obj.Show();
*/

/*B * pb[2];

pb[0] = new B;
pb[1] = new B;


for (int i=0; i<2; i++)
                           pb[i] -> Show();
*/


/*B *pb1 = new B[10];
    
for(int i = 0; i < 10; i++)
            pb1[i].Show();



for (int i=0; i<10; i++)
                           delete  pb1;
*/                           
B **pb2;
                           
 pb2 = new B*[2];
 
//for(int i = 0; i < 5; i++)
//            pb2[i]=new B;  
    pb2[0]=new B; 
    pb2[1]=new D; 
    
for(int i = 0; i < 2; i++)
  
            pb2[i]->Show();                          
                           
for (int i=0; i<2; i++)
                           delete  pb2[i];



getch(); 
 return 0;  
}















