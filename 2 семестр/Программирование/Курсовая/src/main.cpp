#include <iostream>
#include "structure.hpp"
#include "sort.hpp"
#include "functions.hpp"

using namespace std;

int main()
{
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
	system("CLS");

	FILE *outputFile = NULL;
	list *head;

	createList(head);
	cout << "Начальный список:" << endl;
	printList(head);
	sortWords(head);
	cout << endl
		 << "Список с отсортированными символами в словах:" << endl;
	printList(head);
	sortList(head);
	cout << endl
		 << "Отсортированный список:" << endl;
	printList(head);
	recordList(head);
	freeList(head);
	return 0;
}
