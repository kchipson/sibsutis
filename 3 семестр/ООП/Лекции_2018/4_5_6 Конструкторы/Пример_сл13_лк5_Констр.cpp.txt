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
     void  Show(void) {cout<< "function Show \n"; };
}; 

int main()  { 

   A aobj(25);   // работает конструктор с параметром  
                                              //     (инициализации)  A(int   i)
   A a1obj;    // работает конструктор без параметров
                                               //                 (по умолчанию) A()
   //B bobj(10);   // ошибка: не работает конструктор с параметром 
                                               //        (инициализации) B(int j)
   B  b1obj; // - ???

  b1obj.Show();

getch(); 
 return 0;  
}















