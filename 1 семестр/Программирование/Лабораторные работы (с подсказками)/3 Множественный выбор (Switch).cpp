#include <stdlib.h> 
#include <stdio.h> 
#include <math.h> 

void one(){ 
	//1. Вводится число М - номер месяца. Определить номер квартала и номер полугодия по введенному номеру месяца.	
	int m;
    printf("\n Vvedite mesyac:  ");  scanf("%i",&m);
    printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    switch(m)
    {
		case 1:case 2:case 3:
			printf("I kvartal \n"); break;
		case 4:case 5:case 6:
			printf("II kvartal \n"); break;
		case 7:case 8:case 9:
			printf("III kvartal \n"); break;
		case 10:case 11:case 12:
			printf("IV kvartal \n"); break;
		default: printf("\n Error \n");
    }   
    switch(m)
    {
		case 1:case 2:case 3:case 4:case 5:case 6:
			printf("I polugodie \n"); break;
		case 7:case 8:case 9:case 10:case 11:case 12:
			printf("II polugodie \n"); break;
		default: printf("\n Error \n");
    }
    printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    system("PAUSE");

} 

void two(){ 
	//2. Вводится  целое число С. Если -9<=c<=9 вывести величину числа в словесной форме с учетом знака, в противном случае - предупреждающее сообщение и повторный ввод.
	int c;
	bool True=true;
	while (True){
		printf("\n Vvedite chislo(-9;9):  ");  
		scanf("%i",&c);
		printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
		switch(c){
			case -9:
				{	
					printf("Minus devyat' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break;
				}
			case -8:
				{	
					printf("Minus vosem' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -7:
				{	
					printf("Minus sem' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -6:
				{	
					printf("Minus shest' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -5:
				{	
					printf("Minus pyat' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -4:
				{	
					printf("Minus chetyre \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -3:
				{	
					printf("Minus tri \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -2:
				{	
					printf("Minus dva \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case -1:
				{	
					printf("Minus odin \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 0:
				{	
					printf("Nol' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 1:
				{	
					printf("Odin \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 2:
				{	
					printf("Dva \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 3:
				{	
					printf("Tri \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 4:
				{	
					printf("CHetyre \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 5:
				{	
					printf("Pyat' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 6:
				{	
					printf("SHest' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 7:
				{	
					printf("Sem' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 8:
				{	
					printf("Vosem' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			case 9:
				{	
					printf("Devyat' \n");
					printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
					True=false;
					break; 
				}
			default: 
				printf("\n Error \n");
		}
			
	}
} 

void three(){ 
	//3. В китайском гороскопе года носят следующие названия: крыса, корова, тигр, заяц, дракон, змея,  лошадь, овца, обезьяна, петух, собака, свинья. Учитывая, что 2008 - год крысы, написать программу, определяющую название года по его номеру.
	int g;
    printf("\n Vvedite god:  ");  scanf("%i",&g);
    printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    switch(g%12)
    {
		case 1:
			printf("God petuha \n"); break;
		case 2:
			printf("God sobaki \n"); break;
		case 3:
			printf("God svin'i \n"); break;
		case 4:
			printf("God krysy \n"); break;
		case 5:
			printf("God korovy \n"); break;
		case 6:
			printf("God tigra \n"); break;
		case 7:
			printf("God zajca \n"); break;
		case 8:
			printf("God drakona \n"); break;
		case 9:
			printf("God zmei \n"); break;
		case 10:
			printf("God Loshadi \n"); break;
		case 11:
			printf("God ovcy  \n"); break;		
		case 0:
			printf("God obez'yany \n"); break;
		default: printf("\n Error \n");
    }
    
    printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    system("PAUSE");
} 

void four(){ 
	//4.Вводится номер  месяца М и дня  D. Определить  порядковый номер дня в году Т, соответствующий этой дате.
	int arr[]={31,28,31,30,31,30,31,31,30,31,30,31};
	int m,d;
    printf("\n Vvedite mesyac:  ");  scanf("%i",&m);
    printf("\n Vvedite den':  ");  scanf("%i",&d);
    printf("\n~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    switch(m)
    {
		case 1:
			printf("Den' v godu: %i \n",d); break;
		case 2:
			printf("Den' v godu: %i \n",arr[0]+d); break;
		case 3:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+d),(arr[0]+arr[1]+d+1)); break;
		case 4:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+d),(arr[0]+arr[1]+arr[2]+d+1)); break;
		case 5:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+d),(arr[0]+arr[1]+arr[2]+arr[3]+d+1)); break;
		case 6:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+d+1)); break;
		case 7:
				printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+d+1)); break;
		case 8:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+d+1)); break;
		case 9:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+d+1)); break;
		case 10:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+d+1)); break;
		case 11:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+arr[9]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+arr[9]+d+1)); break;
		case 12:
			printf("Den' v godu: %i(%i)\n",(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+arr[9]+arr[10]+d),(arr[0]+arr[1]+arr[2]+arr[3]+arr[4]+arr[5]+arr[6]+arr[7]+arr[8]+arr[9]+arr[10]+d+1)); break;
			
		default: printf("\n Error \n");
    }
    printf("~~~~~~~~~~~~~~~~~~~~~~~~~~\n");
    system("PAUSE");
} 


main(){ 
    int choice; 
    printf("Input number of task (Number from 1 to 4): "); 
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
 
return 0; 
}
