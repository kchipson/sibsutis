#include <stdlib.h> 
#include <iostream>
#include <ctime>
#include <string.h> 
using namespace std;

int one(){
//1.Дана информация о  школах города. Запись имеет вид: номер школы, количество выпускников школы, число поступивших в ВУЗ. 
//  * сформировать массив из записей. 
//  * отсортировать его с помощью индексного массива по проценту поступивших в ВУЗы. 
//  * вывести данные о количестве выпускников в каждой школе и проценту поступивших в ВУЗ.
	struct admission_to_universities {
		int number; 
		int count;
		int received;} ; //Объявление структуры 
	
	int k;//кол-во школ;
	cout<< "Количество школ: ";
	cin>>k;
	cout<<endl<<"           ВВЕДИТЕ ИНФОРМАЦИЮ О ШКОЛАХ \n";
	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/";
	cout<<" № школы, кол-во выпускников , число поступивших в ВУЗ   "<<endl;
	struct admission_to_universities *Schools= new struct admission_to_universities[k];
	if (Schools == NULL) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	return 1; // выход по ошибке, код ошибки 1
	}
	
	int i,j;
	for (i=0;i<k;i++){
		cin>> Schools[i].number >>Schools[i].count>>Schools[i].received;
	}
	
	struct admission_to_universities **Sort= new struct admission_to_universities*[k];
	struct admission_to_universities *temp;
	if (Sort == NULL) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	return 1; // выход по ошибке, код ошибки 1
	}
	
	for (i=0;i<k;i++){
		Sort[i]=&Schools[i];
	}

	for( i = 0 ; i < k - 1; i++) { 
       for(j = 0 ; j < k - i - 1 ; j++) {  
            if((*Sort[j]).received > (*Sort[j+1]).received) {           
              temp = Sort[j];
              Sort[j] = Sort[j+1] ;
              Sort[j+1] = temp; 
           }
        }
    }
	
	cout<<" Структура через отсортированный массив указателей: "<<endl;
	for (i=0;i<k;i++){
		cout<<" Школа №"<<(*Sort[i]).number<<", Кол-во выпускников: "<<(*Sort[i]).count<<", Кол-во поступивших в ВУЗ: "<<(*Sort[i]).received<<endl;
	}
		
	return 0;
} 




int two(){ 
//2.Дана информация о комнатах в общежитии. Запись имеет вид: номер комнаты, площадь комнаты, факультет, количество проживающих. 
//  * сформировать массив из записей. 
//  * вычислить количество различных факультетов и занести их в отдельный массив.
//  * вывести данные о  количестве комнат, количестве студентов и средней площади на одного студента по каждому факультету.

	struct hostel {
		int room; 
		float area;
		char  faculty[10];
		int count;} ; //Объявление структуры 

	int i,j,k;//k-кол-во записей;
	cout<< "Количество записей: ";
	cin>>k;
	cout<<endl<<"      ВВЕДИТЕ ИНФОРМАЦИЮ О КОМНАТАХ В ОБЩЕЖИТИИ \n";
	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
	cout<<" № комнаты, площадь комнаты, факультет, количество проживающих  "<<endl;
	struct hostel *info= new struct hostel[k];

	char **faculty = new char*[k];
	
	for (i=0;i<k;i++){
        faculty[i] = new char[10];
         faculty[i][0] ='\n';
    }
    
 
 	if (( faculty == NULL)|| (info == NULL)) // если не удалось выделить память 
	{
    	cout<<" Не удалось выделить память\n";
    	return 1;
	}   
	
	int fac=0,flag; //fac- кол-во факультетов
	for (i=0;i<k;i++){
		cin>> info[i].room >>info[i].area>>info[i].faculty>>info[i].count;

		flag=0;
		for (j=0;j<=fac;j++)
			if (!strcmp(info[i].faculty, faculty[j])){ //Если нашлось два одинаковых слова
				flag++;	
				break;
			} 
		
		if (!flag){
			faculty[fac]=info[i].faculty;
			fac++;	
		}
	}
	cout<<endl<<"~~~~~~~~~~~~~~~~ФАКУЛЬТЕТЫ~~~~~~~~~~~~~~~~"<<endl;
	

	for (i=0;i<fac;i++){

		cout<<faculty[i]<<endl;

		}

	cout<<"__________________________________________"<<endl;
	cout<<"     Всего факультетов: "<<fac<<endl<<endl;
	

	int room, count;
	float area;
	for (i=0;i<fac;i++){
		area=0, count=0,room=0;
		for (j=0;j<k;j++){
			//cout<<"i="<<i<<" || faculty[i]="<<faculty[i]<<" || j= "<<j<<"|| info[j].faculty="<<info[j].faculty<<endl;
			if 	(!strcmp(info[j].faculty, faculty[i])){ //Если нашлось два одинаковых слова
				room++;
				area+=info[j].area;
				count+=info[j].count;
			}
		}
		cout<<endl<<"----------- Факультет"<<faculty[i]<<" -----------"<<endl;
		cout<<endl<<"Кол-во комнат на факультете- "<<room;
		cout<<endl<<"Кол-во студентов- "<<count;
		cout<<endl<<"Средняя площадь на одного студента- "<<area/count<<endl<<endl;
		
	}
		
	return 0;
} 


main(){ 
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text"); 
	srand(time(NULL));
    int choice; 
   	cout<<"Input number of task (Number from 1 to 2):"; 
    cin>>choice; 
    system("CLS");
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    }

system("PAUSE");
return 0; 
}


 

