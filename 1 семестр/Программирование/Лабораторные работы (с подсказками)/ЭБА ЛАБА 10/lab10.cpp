#include <stdlib.h>
#include <math.h>
#include <iostream>
#include <stdio.h>
#include <string.h>


void one() {
	char stroka[1000],slovar[1000][1000], *p=stroka, pristavka[10];
	int number_of_char=0, number_of_end_word=0, lenght, i, j = 0;

	puts("������� ������: ");
	gets(&stroka[1]);
	stroka[0] = ' ';
	strlwr(stroka);
	puts("������� ���������: ");
	gets(&pristavka[1]);
	pristavka[0] = ' ';
	strlwr(pristavka);

	while (*p != '\0') {
		p = strstr(&stroka[number_of_end_word], pristavka);
		if (p == NULL) {
			break;
		}
		number_of_char = p - stroka; //������ ������� ������ ����� � ������ ����������
		p = strchr(&stroka[number_of_char + 1], ' '); //����� ������� �������, ������� �������� ���������� �����.
		if (p == NULL) {
		p = strchr(&stroka[number_of_char + 1], '\0');// ����� ���� �� ������� �������, �� ����� ������������ ����.
		}
		number_of_end_word = p - stroka; //������ ������� ��������� ������
		lenght = number_of_end_word - number_of_char - 1; // ����� �����
		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //����������� ����� � �������
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?' || slovar[j][lenght - 1] == ':') lenght--; // ���� � ����� ����� ���� ���� �� �������� ������ ����������, �� ��������� ���������� lenght, ��� ����, ����� ������ ���� ��������� ����������� �����.
		slovar[j][lenght] = '\0';//���������� � ������� ������������ ����
		j++; 
	}

	if (j == 0) {
		printf("��� ���� � ���������� -%s\n", pristavka);
		return;
	}
	

	printf("������ ���� � ���������� -%s:\n\n{ ", pristavka);
	for (i = 0; i < j; i++) {//����� �������
		printf("%s ", slovar[i]);
	}
	printf("}\n\n");
}

void two() {
	char stroka[1000], slovar[1000][1000], *p = stroka;
	int number_of_char = 0, number_of_end_word = 0, lenght, i, j = 0,k,count = 0;

	puts("������� ������: ");
	gets(&stroka[1]);
	stroka[0] = ' ';
	strlwr(stroka);

	while (*p != '\0') {
		number_of_char = p - stroka; //������ ������� ������ �����
		p = strchr(&stroka[number_of_char + 1], ' '); //����� ������� �������, ������� �������� ���������� �����.
		if (p == NULL) {
			p = strchr(&stroka[number_of_char + 1], '\0');// ����� ���� �� ������� �������, �� ����� ������������ ����.
		}
		number_of_end_word = p - stroka; //������ ������� ��������� ������
		lenght = number_of_end_word - number_of_char - 1; // ����� �����

		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //����������� ����� � �������
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?' || slovar[j][lenght - 1] == ':') lenght--; // ���� � ����� ����� ���� ���� �� �������� ������ ����������, �� ��������� ���������� lenght, ��� ����, ����� ������ ���� ��������� ����������� �����.
		slovar[j][lenght] = '\0';//���������� � ������� ������������ ����
		j++;
	}

	for (i = 0; i < j; i++) {//������� ���������� ����
		for (k = i+1; k < j; k++) {
			if (!strcmp(slovar[i], slovar[k])) {//���� ������� ��� ���������� �����, �� ����������� ������� � ������ ������ ������ � ������������� ������.
				count++;
				slovar[k][0] = '\0';
			}
			else if (slovar[i][0] == '\0') {
				continue;
			}
			
		}
		if (slovar[i][0] != '\0') {
			printf("���������� ���������� ����� '%s' � ������ ������: %d \n", slovar[i], count);
		}
		count = 0;

	}

}

void three() {
	
	char stroka[1000], slovar[1000][1000], *p = stroka, t[1000];
	int number_of_char = 0, number_of_end_word = 0, lenght, maxlenght = -1, i, j = 0, k, count = 0, bukva = 1;

	puts("������� ������� ����� �������: ");
	gets(&stroka[1]);
	stroka[0] = ' ';


	while (*p != '\0') {
		number_of_char = p - stroka; //������ ������� ������ �����
		p = strchr(&stroka[number_of_char + 1], ' '); //����� ������� �������, ������� �������� ���������� �����.
		if (p == NULL) {
			p = strchr(&stroka[number_of_char + 1], '\0');// ����� ���� �� ������� �������, �� ����� ������������ ����.
		}
		number_of_end_word = p - stroka; //������ ������� ��������� ������
		lenght = number_of_end_word - number_of_char - 1; // ����� �����
		if (lenght > maxlenght) {
			maxlenght = lenght;
		}
		strncpy(slovar[j], &stroka[number_of_char + 1], lenght); //����������� ����� � �������
		if (slovar[j][lenght - 1] == ',' || slovar[j][lenght - 1] == '.' || slovar[j][lenght - 1] == '!' || slovar[j][lenght - 1] == '?') lenght--; // ���� � ����� ����� ���� ���� �� �������� ������ ����������, �� ��������� ���������� lenght, ��� ����, ����� ������ ���� ��������� ����������� �����.
		slovar[j][lenght] = '\0';//���������� � ������� ������������ ����
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

	for (i = 0; i < j; i++) {//����� �������
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
