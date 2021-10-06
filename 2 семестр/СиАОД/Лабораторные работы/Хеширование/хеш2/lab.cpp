#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctime>
#include <locale.h>

const int SIZE_OF_HASH_TABLE = 11; // m
const int STR_LEN = 3;
const int NUM_OF_STRING = 13;

long long hash_func(char *string)
{
	long long hash = 0;
	for (int i = 0; i < strlen(string); i++)
	{
		hash = (hash * 256 + string[i]) % SIZE_OF_HASH_TABLE;
	}
	return hash;
}

/* Генерация слов  */
char *genStr(char *str)
{
	int i = 0;
	for (i = 0; i < STR_LEN; i++)
	{
		str[i] = rand() % 26 + 65;
	}

	str[i] = '\0';
	return str;
}

int writeHashTableQuadratic(char hash_table[][STR_LEN + 1], char *str, int size_table, int search)
{
	long long hash = hash_func(str);
	int d = 1;
	int collisions = 0;
	while (1)
	{
		if (strcmp(hash_table[hash], str) == 0 && search)
		{
			printf("\nЭлемент найден");
			printf("\nПозиция: %lld", hash);
			break;
		}
		if (hash_table[hash][0] == 0 && !search)
		{
			strcpy(hash_table[hash], str);
			break;
		}
		else if (!search)
		{
			collisions++;
		}
		if (d >= size_table && !search)
		{
			break;
		}
		else if (d >= size_table && search)
		{
			printf("\nЭлемент не найден");
			break;
		}
		hash = hash + d;
		if (hash >= size_table)
			hash = hash - size_table;
		d = d + 2;
	}

	return collisions;
}

int writeHashTableLinear(char hash_table[][STR_LEN + 1], char *str, int size_table, int search)
{

	long long hash = hash_func(str);
	int d = 1;
	int collisions = 0;
	while (1)
	{
		if (strcmp(hash_table[hash], str) == 0 && search)
		{
			printf("\nЭлемент найден");
			printf("\nПозиция: %lld", hash);
			break;
		}
		if (hash_table[hash][0] == 0 && !search)
		{
			strcpy(hash_table[hash], str);
			break;
		}
		else if (!search)
		{
			collisions++;
		}
		if (d >= size_table && !search)
		{
			break;
		}
		else if (d >= size_table && search)
		{
			printf("\nЭлемент не найден");
			break;
		}
		hash = hash + 1;
		if (hash >= size_table)
			hash = hash - size_table;
		d++;
	}
	return collisions;
}

void printHashTable(char hash_table[][STR_LEN + 1])
{
	printf("\n");
	for (int i = 0; i < SIZE_OF_HASH_TABLE; i++)
		printf("%-6d", i);

	printf("\n");
	for (int i = 0; i < SIZE_OF_HASH_TABLE; i++)
		printf("%-6s", hash_table[i]);
}

int main()
{
	setlocale(LC_ALL, "Russian");
	srand(time(NULL));
	char str[STR_LEN + 1];
	char hashTableLinear[SIZE_OF_HASH_TABLE][STR_LEN + 1] = {0};
	char hashTableQuadratic[SIZE_OF_HASH_TABLE][STR_LEN + 1] = {0};

	printf("\n\n~~~~~~~~~~~~~~ Линейная проба ~~~~~~~~~~~~~~");
	for (int i = 0; i < NUM_OF_STRING; i++)
		writeHashTableLinear(hashTableLinear, genStr(str), SIZE_OF_HASH_TABLE, 0);

	printHashTable(hashTableLinear);

	printf("\n\n~~~~~~~~~~~~~~ Квадратичная проба ~~~~~~~~~~~~~~");

	for (int i = 0; i < NUM_OF_STRING; i++)
		writeHashTableQuadratic(hashTableQuadratic, genStr(str), SIZE_OF_HASH_TABLE, 0);

	printHashTable(hashTableQuadratic);

	int simple_num[5] = {7, 11, 13, 17, 19};
	printf("\n\n%-20s%-20s%-20s%-20s", "Размер табл.", "Кол-во строк", "Линейная", "Квадратичная");

	for (int i = 0; i < 5; i++)
	{
		int line_colis = 0;
		int quadr_colis = 0;
		int count = NUM_OF_STRING;
		for (int j = 0; j < count; j++)
			line_colis += writeHashTableLinear(hashTableLinear, genStr(str), simple_num[i], 0);

		for (int j = 0; j < count; j++)
			quadr_colis += writeHashTableQuadratic(hashTableQuadratic, genStr(str), simple_num[i], 0);
		printf("\n\n%-20d%-20d%-20d%-20d", simple_num[i], NUM_OF_STRING, line_colis, quadr_colis);
	}

	int choose = 0;
	printf("\nВыберите метод разрешения[ 0/1 ]: ");
	scanf("%d", &choose);
	printf("Введите ключ: ");
	scanf("%s", &str);
	while (str[0] != '0')
	{
		if (choose == 0)
			writeHashTableLinear(hashTableLinear, str, SIZE_OF_HASH_TABLE, 1);
		else
			writeHashTableQuadratic(hashTableQuadratic, str, SIZE_OF_HASH_TABLE, 1);
		printf("\nВыберите метод разрешения[ 0/1 ]: ");
		scanf("%d", &choose);
		printf("Введите ключ: ");
		scanf("%s", &str);
	}
	return 0;
}
