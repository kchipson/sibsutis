#include <stdlib.h>
#include <iostream>
#include <string.h>
using namespace std;

struct students1 {
    char fam[20];
    int a1; // a-assessment (оценка)
    int a2; // a-assessment (оценка)
    int a3; // a-assessment (оценка)
    int a4; // a-assessment (оценка)
    struct students1* next;
};

students1* create(unsigned int *i)
{
    students1 *current, *previous, *head;
    // previous - указатель на предыдущую структуру, head- указатель на первую структуру
    cout << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~СТРУДЕНТЫ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" << endl;
    cout << "// <Фамилия> <1-я оценка> <2-я оценка> <3-я оценка> <4-я оценка>" << endl;
    cout << "                          //0= Закончить                         " << endl
         << endl;
    head = previous = new students1; //выделение памяти для первой структуры
	(*i)++;
    cin >> previous->fam >> previous->a1 >> previous->a2 >> previous->a3 >> previous->a4;
    while (1) {
    	(*i)++;
        current = new students1;
        cin >> current->fam;
        if (!strcmp(current->fam, "0")) {
        	(*i)--;
            break;
        }
        cin >> current->a1 >> current->a2 >> current->a3 >> current->a4;
        previous->next = current; //ссылка в предыдущей на текущую
        previous = current; // сохранение адреса текущей
    }
    previous->next = NULL;
    return head;
}
void list(students1* head)
{
    students1* current;
    current = head;
    while (current != NULL) { // пока не конец списка
        cout << endl
             << "Фамилия: " << (current->fam);
        cout << endl
             << "Оценки: " << (current->a1) << "  " << (current->a2) << "  " << (current->a3) << "  " << (current->a4);
        cout << endl;
        current = current->next; // продвижение по списку
    }
    cout << endl;
}

students1* Sort_list(students1* head, unsigned int n)
{
    students1 *previous, *current, *next;
    //        cout<< strcmp(current->fam, current->next->fam)<<endl;

    for (int i = 0; i < n; i++) {
    	previous = 0;
    	current = head;
    	next=current->next ;
	    while (next != NULL) { // пока не конец списка

	    	//cout<<"HEAD "<<head<<"\n"<<"previous "<<previous<<"\n"<<"current "<<current<<"\n";
	        if (strcmp(current->fam, next->fam) > 0) {
	        	//cout<<"Меняем "<<current->fam<<" & "<<next->fam<<endl;
	        	
	        	if(current==head){
				
	        		head=next;
	        		current->next=next->next;
	        		next->next=current;	
	        		next=current;
	        	}	
	        	else{
					previous->next=next;
					current->next=next->next;
					next->next=current;
					next=current;
					
	        	}
	            
	        }
	        previous = current;
	        current = current->next; // продвижение по списку
	        next= next->next; 
	    }
	}
	return head;
}

void free_list(students1* head)
{
    students1 *p, *q;
    q = p = head;
    while (p != NULL) {
        p = q->next;
        delete q;
        q = p;
    }
    head = NULL;
}

void one()
{
    //1.Сформировать односвязный список, состоящий из структур, содержащих информацию:
    // фамилия студента и 4 оценки.
    //Отсортировать список  по возрастанию (по фамилии).
    // Вывести полученный список.
    unsigned int size=0;
    students1* head; // адрес головы списка
    head = create(&size);
    list(head);
    system("pause");
	head=Sort_list(head,size);
    list(head);
    free_list(head);
}

struct students2 {
    char fam[20];
    int a1; // a-assessment (оценка)
    int a2; // a-assessment (оценка)
    int a3; // a-assessment (оценка)
    int a4; // a-assessment (оценка)
    struct students2* prev;
    struct students2* next;
};

students2* create()
{
    students2 *prev, *curr, *next, *head;
    // previous - указатель на предыдущую структуру, head- указатель на первую структуру
    cout << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~СТРУДЕНТЫ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" << endl;
    cout << "// <Фамилия> <1-я оценка> <2-я оценка> <3-я оценка> <4-я оценка>" << endl;
    cout << "                          //0= Закончить                         " << endl
         << endl;
    head = prev = new students2; //выделение памяти для первой структуры
    cin >> prev->fam >> prev->a1 >> prev->a2 >> prev->a3 >> prev->a4;
    prev->prev = NULL;
    while (1) {
        curr = new students2;
        cin >> curr->fam;
        if (!strcmp(curr->fam, "0")) {
            break;
        }
        cin >> curr->a1 >> curr->a2 >> curr->a3 >> curr->a4;
        curr->prev=prev;
        prev->next = curr; //ссылка в предыдущей на текущую
        prev = curr; // сохранение адреса текущей
    }
    prev->next = NULL;
    return head;
}

void list2(students2* head)
{
    students2* current;
    current = head;
    while (current != NULL) { // пока не конец списка
        cout << endl
             << "Фамилия: " << (current->fam);
        cout << endl
             << "Оценки: " << (current->a1) << "  " << (current->a2) << "  " << (current->a3) << "  " << (current->a4);
        cout << endl;
        current = current->next; // продвижение по списку
    }
    cout << endl;
}

students2* check(students2* head)
{
    students2 *prev=head->prev, *curr=head, *next=head->next;


    while (curr != NULL) { // пока не конец списка
    	//cout<<"HEAD "<<head<<"\n"<<"previous "<<prev<<"\n"<<"current "<<curr<<"\n"<<"next "<<next<<"\n";
        if ((curr->a1< 3)||(curr->a2< 3)||(curr->a3< 3)||(curr->a4< 3) ) {
        	if(curr==head){
        		head=next;
        		next->prev=NULL;
        	}	
        	else{
				prev->next=next;
				if (next!=NULL)
					next->prev=prev;		
        	}
    		delete curr;
			curr=next;
			if (next!=NULL)
				next=next->next;
            
        }
        else{

			prev= curr;
			curr = next; // продвижение по списку
			if (next!=NULL)
				next= next->next; 

		}

    }

	return head;
}

void free_list2(students2* head)
{
    students2 *p, *q;
    q = p = head;
    while (p != NULL) {
        p = q->next;
        delete q;
        q = p;
    }
    head = NULL;
}
void two()
{
	//2.Сформировать двусвязный список, состоящий из структур, содержащих информацию:
    //фамилия студента и 4 оценки. Найти и удалить из списка студентов, имеющих хотя бы одну неудовлетворительную оценку.
    //Вывести список до и после удаления записей.
	students2* head; // адрес головы списка
    head = create();
    list2(head);
    system("pause");
    head=check(head);
    list2(head);
    free_list2(head);

}

int main()
{
    setlocale(LC_ALL, "Russian");
    system("chcp 1251  > text");
    int choice;
    cout << "Input number of task (Number from 1 to 2):";
    cin >> choice;
    system("CLS");
    if (choice == 1) {
        one();
    }
    else if (choice == 2) {
        two();
    }
    return 0;
}
