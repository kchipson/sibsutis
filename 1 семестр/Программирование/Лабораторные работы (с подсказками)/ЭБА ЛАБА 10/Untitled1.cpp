#include <stdlib.h>
#include <math.h>
#include <iostream>
#include <stdio.h>
#include <string.h>


void one() {
	char stroka[1000],slovar[100][100], *p=stroka, pristavka[10];
	int number_of_char=0, number_of_end_word=0, lenght, i, j = 0;

	puts("Введите строку: ");
	gets_s(&stroka[1],999);
	stroka[0] = ' ';
	strlwr(stroka);
	puts("Введите Приставку: ");
	gets_s(&pristavka[1], 9);
	pristavka[0] = ' ';

	while (*p != '\0') {
		p = strstr(&stroka[number_of_end_word], pristavka);
		if (p == NULL) {
			break;
		}
		number_of_char = p - stroka; //Индекс символа начала слова с нужной приставкой
		p = strchr(&stroka[number_of_char + 1], ' '); //Адрес символа пробела, который является окончанием слова.
		if (p == NULL) {
		p = strchr(&stroka[number_of_char + 1], '\0');// Иначе если не найдено пробела, то адрес завершающего нуля.
		}
		number_of_end_word = p - stroka; //Индекс символа окончания строки
		lenght = number_of_end_word - number_of_char - 1; // Длина слова
		std::cout << lenght << std::endl; //Для отладки вывод длинны слова

		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //Копирование слова в словарь
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?') lenght--; // Если в конце слова есть один из заданных знаков препинания, то уменьшаем переменную lenght, для того, чтобы данный знак заменился завершающим нулем.
		slovar[j][lenght] = '\0';//Добавление в словарь завершающего нуля
		j++; 
	}

	if (j == 0) {
		std::cout << "Нет слов с приставкой -";
		puts(pristavka);
	}

	std::cout << std::endl<< "Список слов с приставкой -";
	puts(pristavka);
	std::cout << "~{" << std::endl;
	for (i = 0; i < j; i++) {//Вывод словаря
		puts(slovar[i]);
	}
	std::cout << "}~" << std::endl;
}

void two() {
}

void three() {
	
}


void four() {

}

int main() {
	setlocale(LC_ALL, "Russian");
	system("chcp 1251 > text");
	int choice;
	std::cout << "Input number of task (Number from 1 to 4):";
	(std::cin >> choice).get();
	if (choice == 1) {
		one();
	}
	else if (choice == 2) {
		two();
	}
	else if (choice == 3) {
		three();
	}
	else if (choice == 4) {
		four();
	}
	system("PAUSE");
	return 0;
}
