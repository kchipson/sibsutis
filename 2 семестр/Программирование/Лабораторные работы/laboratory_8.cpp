#include <stdlib.h> 
#include <iostream>
#include <ctime>
#include <string.h> 
using namespace std;

int one(){
//1.���� ���������� �  ������ ������. ������ ����� ���: ����� �����, ���������� ����������� �����, ����� ����������� � ���. 
//  * ������������ ������ �� �������. 
//  * ������������� ��� � ������� ���������� ������� �� �������� ����������� � ����. 
//  * ������� ������ � ���������� ����������� � ������ ����� � �������� ����������� � ���.
	struct admission_to_universities {
		int number; 
		int count;
		int received;} ; //���������� ��������� 
	
	int k;//���-�� ����;
	cout<< "���������� ����: ";
	cin>>k;
	cout<<endl<<"           ������� ���������� � ������ \n";
	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~/";
	cout<<" � �����, ���-�� ����������� , ����� ����������� � ���   "<<endl;
	struct admission_to_universities *Schools= new struct admission_to_universities[k];
	if (Schools == NULL) // ���� �� ������� �������� ������ 
	{
    	cout<<" �� ������� �������� ������\n";
    	return 1; // ����� �� ������, ��� ������ 1
	}
	
	int i,j;
	for (i=0;i<k;i++){
		cin>> Schools[i].number >>Schools[i].count>>Schools[i].received;
	}
	
	struct admission_to_universities **Sort= new struct admission_to_universities*[k];
	struct admission_to_universities *temp;
	if (Sort == NULL) // ���� �� ������� �������� ������ 
	{
    	cout<<" �� ������� �������� ������\n";
    	return 1; // ����� �� ������, ��� ������ 1
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
	
	cout<<" ��������� ����� ��������������� ������ ����������: "<<endl;
	for (i=0;i<k;i++){
		cout<<" ����� �"<<(*Sort[i]).number<<", ���-�� �����������: "<<(*Sort[i]).count<<", ���-�� ����������� � ���: "<<(*Sort[i]).received<<endl;
	}
		
	return 0;
} 




int two(){ 
//2.���� ���������� � �������� � ���������. ������ ����� ���: ����� �������, ������� �������, ���������, ���������� �����������. 
//  * ������������ ������ �� �������. 
//  * ��������� ���������� ��������� ����������� � ������� �� � ��������� ������.
//  * ������� ������ �  ���������� ������, ���������� ��������� � ������� ������� �� ������ �������� �� ������� ����������.

	struct hostel {
		int room; 
		float area;
		char  faculty[10];
		int count;} ; //���������� ��������� 

	int i,j,k;//k-���-�� �������;
	cout<< "���������� �������: ";
	cin>>k;
	cout<<endl<<"      ������� ���������� � �������� � ��������� \n";
	cout<<"~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
	cout<<" � �������, ������� �������, ���������, ���������� �����������  "<<endl;
	struct hostel *info= new struct hostel[k];

	char **faculty = new char*[k];
	
	for (i=0;i<k;i++){
        faculty[i] = new char[10];
         faculty[i][0] ='\n';
    }
    
 
 	if (( faculty == NULL)|| (info == NULL)) // ���� �� ������� �������� ������ 
	{
    	cout<<" �� ������� �������� ������\n";
    	return 1;
	}   
	
	int fac=0,flag; //fac- ���-�� �����������
	for (i=0;i<k;i++){
		cin>> info[i].room >>info[i].area>>info[i].faculty>>info[i].count;

		flag=0;
		for (j=0;j<=fac;j++)
			if (!strcmp(info[i].faculty, faculty[j])){ //���� ������� ��� ���������� �����
				flag++;	
				break;
			} 
		
		if (!flag){
			faculty[fac]=info[i].faculty;
			fac++;	
		}
	}
	cout<<endl<<"~~~~~~~~~~~~~~~~����������~~~~~~~~~~~~~~~~"<<endl;
	

	for (i=0;i<fac;i++){

		cout<<faculty[i]<<endl;

		}

	cout<<"__________________________________________"<<endl;
	cout<<"     ����� �����������: "<<fac<<endl<<endl;
	

	int room, count;
	float area;
	for (i=0;i<fac;i++){
		area=0, count=0,room=0;
		for (j=0;j<k;j++){
			//cout<<"i="<<i<<" || faculty[i]="<<faculty[i]<<" || j= "<<j<<"|| info[j].faculty="<<info[j].faculty<<endl;
			if 	(!strcmp(info[j].faculty, faculty[i])){ //���� ������� ��� ���������� �����
				room++;
				area+=info[j].area;
				count+=info[j].count;
			}
		}
		cout<<endl<<"----------- ���������"<<faculty[i]<<" -----------"<<endl;
		cout<<endl<<"���-�� ������ �� ����������- "<<room;
		cout<<endl<<"���-�� ���������- "<<count;
		cout<<endl<<"������� ������� �� ������ ��������- "<<area/count<<endl<<endl;
		
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


 

