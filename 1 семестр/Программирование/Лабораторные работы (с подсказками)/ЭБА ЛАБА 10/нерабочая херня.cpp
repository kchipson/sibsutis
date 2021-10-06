#include <stdlib.h> 
#include <iostream>
#include <cstring> 
using namespace std;


void one() {
	char pristavka[100],text[2000],*ucaz,*ucazend,*n,*zpt=NULL,*pr=NULL;
    //char stroka[1000],slovar[100][100], *p=stroka,*nul;
    //int number_of_char=0, number_of_end_word=0, lenght,nachalo = 0, i, j = 0;
 
    cout<<"Введите приставку: ";
    gets(pristavka);
    puts("Введите текст (до 2000 символов): ");
    gets(text);
	int i=0, j=0;
// 	while ( text[i] != '\0' ) {
//
//		ucaz = strstr(text, pristavka);
//		ucazend = strstr(text, " ");
//		system("PAUSE");
//		for (p=ucaz; p<=ucazend;p++){
//			cout<<p;
//		}
//	}
	ucaz=(strstr(text, pristavka));
	pr=(strstr(text, " "));
	zpt=(strstr(text, ","));

//	cout<<(&((char)(strstr(n, pristavka)))>&ucazend);
//	cout<<(&ucaz)<<endl;
//	cout<<(&ucazend);

	if ((pr!=NULL) || (zpt!=NULL)){
		if (&pr<&zpt)
			ucazend=pr;
		else ucazend=zpt;		
	}
	else ucazend=(strstr(n, "\0"));


	cout<<ucazend<<endl;
//	
//	if 
//	ucazend= strstr(ucaz, " ");
//	n=ucazend;
//	for (i=0;i<ucazend-ucaz;i++){
//	cout<<(ucaz+i)[0];	
//	}


	
//    while (*p != '\0') {
//        p = strstr(&stroka[number_of_end_word], pristavka);
//        if (p == NULL) {
//            std::cout << "Нет слов с приставкой -";
//            puts(pristavka);
//            break;
//        }
//        number_of_char = p - stroka; //Индекс символа начала слова с нужной приставкой
//        p = strchr(&stroka[number_of_char + 1], ' '); //Адрес символа пробела, который является окончанием слова.
//        if (p == NULL) {
//        p = strchr(&stroka[number_of_char + 1], '\0');// Иначе если не найдено пробела, то завершающий нуль.
//        }
//        number_of_end_word = p - stroka; //Индекс символа окончания строки
//        lenght = number_of_end_word - number_of_char - 1; // Длина слова
//        std::cout << lenght << std::endl; //Для отлыдки вывод длинны слова
// 
//        strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //Копирование слова в словарь
//        slovar[j][lenght] = '\0';//Добавление в словарь завершающего нуля
//        j++;
//    }
// 
// 
//    for (i = 0; i < j; i++) {//Вывод словаря
//        puts(slovar[i]);
//    }
 
}


void two(){ 
//2.	Во введенном тексте найти количество  повторений каждого слова. Одинаковые слова дважды не выводить.

}

void three(){ 
//3.	Список фамилий вводится через запятую в виде строки. Упорядочить   фамилии по алфавиту.

} 
 

main(){ 
    int choice; 
    cout<<"Input number of task (Number from 1 to 3): "; 
    (cin>>choice).get();
    
    if(choice == 1){ 
        one(); 
    } 
    else if(choice == 2){ 
        two(); 
    } 
    else if(choice == 3){ 
        three(); 
    } 

system("PAUSE");
return 0; 
}
