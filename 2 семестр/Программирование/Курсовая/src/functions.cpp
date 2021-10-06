#include <iostream>
#include "structure.hpp"

using namespace std;

enum ErrorCode
{
	UNABLE_TO_OPEN_INFILE = 1,
	UNABLE_TO_OPEN_OUTFILE
};

void error(int error)
{
	switch (error)
	{
	case UNABLE_TO_OPEN_INFILE:
		cout << "Не удалось открыть файл, возможно файл не существует!\nПроверьте наличие файла \"input.txt\" в каталоге с проектом!";
		break;
	case UNABLE_TO_OPEN_OUTFILE:
		cout << "Не удалось открыть файл \"output.txt\"!";
		break;
	}

	cout << "\n";
	exit(0);
}

int strlen(char *str)
{
	int i = 0;
	while (str[i] != '\0')
		i++;
	return i;
}

void createList(list *(&head))
{
	FILE *inputFile = NULL;
	inputFile = fopen("input.txt", "r");
	if (inputFile == NULL)
		error(UNABLE_TO_OPEN_INFILE);
	list *prev, *p;
	head = prev = new list;

	int ch = 0;
	int temp;

	while (!feof(inputFile))
	{
		temp = 0;
		ch = getc(inputFile);
		while ((ch == ' ') || (ch == '\n') || (ch == '.') || (ch == ';') || (ch == ':') || (ch == ',') || (ch == '!') || (ch == '?'))
			ch = getc(inputFile);

		p = new list;
		while ((ch != ' ') && (ch != '.') && (ch != ';') && (ch != ':') && (ch != ',') && (ch != '!') && (ch != '?') && (ch != '\n') && (ch != EOF))
		{

			(p->data)[temp] = (char)ch;
			temp++;
			ch = getc(inputFile);
		}
		(p->data)[temp] = '\0';

		if (strlen(p->data))
		{
			p->previous = prev;
			prev->next = p;
			prev = p;
		}
	}
	p->next = 0;
	prev = head;
	head = head->next;
	head->previous = 0;
	delete prev;
	fclose(inputFile);
}

void recordList(list *head)
{
	FILE *outputFile = NULL;
	outputFile = fopen("output.txt", "w");
	if (outputFile == NULL)
		error(UNABLE_TO_OPEN_OUTFILE);

	list *p;
	for (p = head; p; p = p->next)
	{
		fprintf(outputFile, "%s ", p->data);
	}

	fclose(outputFile);
}

int lenList(list *head)
{
	list *p;
	int i = 0;
	p = head;
	while (p != NULL)
	{
		p = p->next;
		i++;
	}
	return i;
}

void printList(list *head)
{
	list *p;

	cout << endl
		 << "~~~~~~~~~~~В прямом порядке~~~~~~~~~~~" << endl;
	for (p = head; p->next; p = p->next)
	{
		cout << p->data << " ";
	}
	cout << p->data
		 << endl
		 << endl;

	cout << "~~~~~~~~~~~В ообратном порядке~~~~~~~~~~~" << endl;
	for (; p; p = p->previous)
	{
		cout << p->data << " ";
	}
	cout << endl;
}

void freeList(list *head)
{
	list *p, *temp;
	p = temp = head;
	while (p != NULL)
	{
		p = p->next;
		delete p;
		temp = p;
	}
	head = NULL;
}
