#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <locale.h>
#include <ctime>

const int SIZE_OF_HASH_TABLE = 11; // m
const int STR_LEN = 10;
const int NUM_OF_STRING = 30;

struct list
{
	list *next;
	char data[STR_LEN];
};

struct hash_table
{
	hash_table *next;
	long long hash;
	list *data;
};

long long hash_func(char *string)
{
	long long hash = 0;
	for (int i = 0; i < strlen(string); i++)
	{
		hash = (hash * 256 + string[i]) % SIZE_OF_HASH_TABLE;
	}
	return hash;
}

void printList(hash_table *head)
{
	printf("~~~~~~~~~~~~ Метод прямого связывания ~~~~~~~~~~~~\n\n");
	while (head != NULL)
	{
		printf("%lld\t", head->hash);
		list *temp = head->data;
		while (temp != NULL)
		{
			printf(" -> %s", temp->data);
			temp = temp->next;
		}
		head = head->next;
		printf("\n");
	}
}

void addToTheTable(hash_table *head, char *string)
{
	long long hash = hash_func(string);
	hash_table *find = head;

	unsigned char flag = 0;
	while (find != NULL)
	{
		if (find->hash == hash)
		{
			flag = 1;
			break;
		}
		find = find->next;
	}

	if (!flag)
	{
		hash_table *p = new hash_table;
		p->hash = hash;
		p->data = new list;
		p->data->next = NULL;
		strcpy(p->data->data, string);
		find->next = p;
		p->next = NULL;
	}
	else
	{
		list *ps = new list;
		strcpy(ps->data, string);
		ps->next = find->data;
		find->data = ps;
	}
	return;
}

/* Генерация слов  */
char *genStr(char *str)
{
	int len = STR_LEN;
	int i = 0;
	for (i = 0; i < len + 1; i++)
	{
		switch (rand() % 3)
		{
		case 0:
			str[i] = rand() % 26 + 65;
			break;
		case 1:
			str[i] = rand() % 10 + 48;
			break;
		case 2:
			str[i] = rand() % 26 + 97;
			break;
		}
	}
	return str;
}

int hashSearch(hash_table *head, char *string)
{

	long long input = hash_func(string);
	int i;
	list *answer = NULL;
	while (head != NULL)
	{
		i = 1;
		if (head->hash == input)
		{
			answer = head->data;
			while (answer != NULL)
			{
				if (strcmp(answer->data, string) == 0)
				{
					return i;
				}
				i++;
				answer = answer->next;
			}
			return 0;
		}
		head = head->next;
	}
	return 0;
}

int main()
{
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
	srand(time(NULL));

	hash_table *head = NULL;
	char str[STR_LEN];
	/* Инициализация таблицы */
	hash_table *p, *temp;
	temp = (hash_table *)(&head);
	for (int i = 0; i < SIZE_OF_HASH_TABLE; i++)
	{
		p = new hash_table;
		temp->next = p;
		temp = p;
		p->hash = i;
		p->data = NULL;
		p->next = NULL;
	}

	/* Запись в хеш-таблицу */
	for (int i = 0; i < NUM_OF_STRING; i++)
	{
		addToTheTable(head, genStr(str));
	}

	/* Вывод хеш-таблицы */
	printList(head);

	printf("\nИскомый элемент[ 0 для выхода]: ");
	scanf("%s", &str);
	while (strcmp(str, "0") != 0)
	{
		int value = hashSearch(head, str);
		if (value)
		{
			printf("Элемент найден! Хеш = %lld, номер= %d", hash_func(str), value);
		}
		else
		{
			printf("Элемент не найден! Хеш = %lld", hash_func(str));
		};
		printf("\nИскомый элемент[ 0 для выхода]: ");
		scanf("%s", &str);
	}

	return 0;
}