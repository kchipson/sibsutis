#include <stdlib.h>
#include <iostream>
#include <string.h>
using namespace std;

void one()
{
	//1. Создать текстовый файл из  N строк.
	//Все слова, начинающиеся с гласных, переписать в один новый файл, а с согласных - в другой новый файл.
	char ch = ' ';
	char str[1000];
	FILE *infile, *outvfile, *outcfile;																					  // Указатели на файлы  (outvfile-гласные, outcfile-согласные)
	infile = fopen("D:\\Универ\\Программирование\\Программирование\\Готовые лабы\\C2\\laboratory_10\\1\\input.txt", "w"); // Создание нового файла input.txt
	system("CLS");
	int count, i;
	cout << "Введите количество строк: ";
	cin >> count;
	cout << "\n";

	cin.get();
	cout << endl
		 << "Введите " << count << " строк(и/у): " << endl
		 << "";
	for (i = 0; i < count; i++)
	{
		gets(str);
		fprintf(infile, "%s\n", str); // Запись в файл строки str
	}

	fclose(infile);																												// Закрытие файла infile
	infile = fopen("D:\\Универ\\Программирование\\Программирование\\Готовые лабы\\C2\\laboratory_10\\1\\input.txt", "r");		// Открытие файла input.txt для чтения
	outvfile = fopen("D:\\Универ\\Программирование\\Программирование\\Готовые лабы\\C2\\laboratory_10\\1\\vowel.txt", "w");		// Создание нового файла vowel.txt (гласные)
	outcfile = fopen("D:\\Универ\\Программирование\\Программирование\\Готовые лабы\\C2\\laboratory_10\\1\\consonant.txt", "w"); // Создание нового файла consonant.txt (согласные)

	for (i = 0; i < count; i++)
	{
		ch = ' ';
		while (ch != '\n')
		{
			ch = getc(infile); // Чтение символа ch из файла infile
			if ((ch == 'a') || (ch == 'e') || (ch == 'i') || (ch == 'o') || (ch == 'u') || (ch == 'y') || (ch == 'A') || (ch == 'E') || (ch == 'I') || (ch == 'O') || (ch == 'U') || (ch == 'Y') || (ch == 'а') || (ch == 'у') || (ch == 'о') || (ch == 'ы') || (ch == 'и') || (ch == 'э') || (ch == 'я') || (ch == 'ю') || (ch == 'ё') || (ch == 'е') || (ch == 'А') || (ch == 'У') || (ch == 'О') || (ch == 'Ы') || (ch == 'И') || (ch == 'Э') || (ch == 'Я') || (ch == 'Ю') || (ch == 'Ё') || (ch == 'Е'))
			{
				//cout<<"В гласных";
				while (ch != ' ')
				{
					putc(ch, outvfile); // Запись в файл outvfile символа ch
					ch = getc(infile);
					if (ch == '\n')
						break;
				}
				putc('\n', outvfile); // Запись в файл outvfile символа \n
			}
			else
			{
				//cout<<"В согласных";
				while (ch != ' ')
				{
					putc(ch, outcfile); // Запись в файл outcfile символа ch
					ch = getc(infile);
					if (ch == '\n')
						break;
				}
				putc('\n', outcfile); // Запись в файл outcfile символа \n
			}
		}
	}
	fclose(infile);   // Закрытие файла infile
	fclose(outcfile); // Закрытие файла outcfile
	fclose(outvfile); // Закрытие файла outvfile
}

void two()
{
	//2.В новый файл переписать каждую строку наоборот.

	char str[1000];
	FILE *infile, *outfile;																																   // Указатели на файлы
	infile = fopen("C:\\Users\\kchipson\\Desktop\\Универ\\Программирование_Универ\\Программирование\\Готовые лабы\\C2\\laboratory_10\\2\\input.txt", "w"); // Создание нового файла input.txt
	system("CLS");
	int count, i, j;
	cout << "Введите количество строк: ";
	cin >> count;
	getchar();
	cout << endl
		 << "Введите " << count << " строк(и/у): " << endl
		 << "";
	outfile = fopen("C:\\Users\\kchipson\\Desktop\\Универ\\Программирование_Универ\\Программирование\\Готовые лабы\\C2\\laboratory_10\\2\\output.txt", "w"); // Создание нового файла output.txt

	for (i = 0; i < count; i++)
	{
		gets(str);
		fprintf(infile, "%s\n", str); // Запись в файл строки str
		for (j = strlen(str); j > 0; j--)
			putc(str[j - 1], outfile); // Запись в файл outcfile символа str[j]
		putc('\n', outfile);
	}
	fclose(infile);  // Закрытие файла infile
	fclose(outfile); // Закрытие файла outfile
}

main()
{
	setlocale(LC_ALL, "Russian");
	system("chcp 1251  > text");
	int choice;
	cout << "Input number of task (Number from 1 to 2):";
	cin >> choice;
	system("CLS");
	if (choice == 1)
	{
		one();
	}
	else if (choice == 2)
	{
		two();
	}

	system("PAUSE");
	return 0;
}
