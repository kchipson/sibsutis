#include <stdlib.h>
#include <math.h>
#include <iostream>
#include <stdio.h>
#include <string.h>


void one() {
	char stroka[1000],slovar[1000][1000], *p=stroka, pristavka[10];
	int number_of_char=0, number_of_end_word=0, lenght, i, j = 0;

	puts("Введите строку: ");
	gets(&stroka[1]);
	stroka[0] = ' ';
	strlwr(stroka);
	puts("Введите Приставку: ");
	gets(&pristavka[1]);
	pristavka[0] = ' ';
	strlwr(pristavka);

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
		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //Копирование слова в словарь
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?' || slovar[j][lenght - 1] == ':') lenght--; // Если в конце слова есть один из заданных знаков препинания, то уменьшаем переменную lenght, для того, чтобы данный знак заменился завершающим нулем.
		slovar[j][lenght] = '\0';//Добавление в словарь завершающего нуля
		j++; 
	}

	if (j == 0) {
		printf("Нет слов с приставкой -%s\n", pristavka);
		return;
	}
	

	printf("Список слов с приставкой -%s:\n\n{ ", pristavka);
	for (i = 0; i < j; i++) {//Вывод словаря
		printf("%s ", slovar[i]);
	}
	printf("}\n\n");
}

void two() {
	char stroka[1000], slovar[1000][1000], *p = stroka;
	int number_of_char = 0, number_of_end_word = 0, lenght, i, j = 0,k,count = 0;

	puts("Введите строку: ");
	gets(&stroka[1]);
	stroka[0] = ' ';
	strlwr(stroka);

	while (*p != '\0') {
		number_of_char = p - stroka; //Индекс символа начала слова
		p = strchr(&stroka[number_of_char + 1], ' '); //Адрес символа пробела, который является окончанием слова.
		if (p == NULL) {
			p = strchr(&stroka[number_of_char + 1], '\0');// Иначе если не найдено пробела, то адрес завершающего нуля.
		}
		number_of_end_word = p - stroka; //Индекс символа окончания строки
		lenght = number_of_end_word - number_of_char - 1; // Длина слова

		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //Копирование слова в словарь
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?' || slovar[j][lenght - 1] == ':') lenght--; // Если в конце слова есть один из заданных знаков препинания, то уменьшаем переменную lenght, для того, чтобы данный знак заменился завершающим нулем.
		slovar[j][lenght] = '\0';//Добавление в словарь завершающего нуля
		j++;
	}

	for (i = 0; i < j; i++) {//Подсчет количества слов
		for (k = i+1; k < j; k++) {
			if (!strcmp(slovar[i], slovar[k])) {//Если нашлось два одинаковых слова, то увеличиваем счетчик и делаем пустым ячейку с повторяющимся словом.
				count++;
				slovar[k][0] = '\0';
			}
			else if (slovar[i][0] == '\0') {
				continue;
			}
			
		}
		if (slovar[i][0] != '\0') {
			printf("Количество повторений слова '%s' в данном тексте: %d \n", slovar[i], count);
		}
		count = 0;

	}

}

void three() {
	
	char stroka[1000], slovar[1000][1000], *p = stroka, t[1000];
	int number_of_char = 0, number_of_end_word = 0, lenght, maxlenght = -1, i, j = 0, k, count = 0, bukva = 1;

	puts("Введите фамилии через запятую: ");
	gets(&stroka[1]);
	stroka[0] = ' ';


	while (*p != '\0') {
		number_of_char = p - stroka; //Индекс символа начала слова
		p = strchr(&stroka[number_of_char + 1], ' '); //Адрес символа запятой, который является окончанием слова.
		if (p == NULL) {
			p = strchr(&stroka[number_of_char + 1], '\0');// Иначе если не найдено пробела, то адрес завершающего нуля.
		}
		number_of_end_word = p - stroka; //Индекс символа окончания строки
		lenght = number_of_end_word - number_of_char - 1; // Длина слова
		if (lenght > maxlenght) {
			maxlenght = lenght;
		}
		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //Копирование слова в словарь
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?') lenght--; // Если в конце слова есть один из заданных знаков препинания, то уменьшаем переменную lenght, для того, чтобы данный знак заменился завершающим нулем.
		slovar[j][lenght] = '\0';//Добавление в словарь завершающего нуля
		j++;
	}

	for (i = 0; i < j; i++) {
		for (k = i+1; k < j; k++) {
			if (slovar[i][0] > slovar[k][0]) {
				strcpy(t, slovar[i]);
				strcpy(slovar[i], slovar[k]);
				strcpy(slovar[k], t);

			}
		}

	}

while (bukva != maxlenght) {
	for (i = 0; i < j; i++) {
		for (k = i+1; k < j; k++) {
			if (!strncmp(slovar[i],slovar[k],bukva) && (slovar[k][bukva] == '\0' || (slovar[i][bukva] != '\0' && slovar[i][bukva] > slovar[k][bukva]))) {
				strcpy(t, slovar[i]);
				strcpy(slovar[i], slovar[k]);
				strcpy(slovar[k], t);

			}
		}

	}
	bukva++;
}

	for (i = 0; i < j; i++) {//Вывод словаря
		printf("%s \n", slovar[i]);
	}
}


int main() {
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
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
	system("PAUSE");
	return 0;
}
