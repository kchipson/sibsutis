#include <stdlib.h>
#include <iostream>
#include <string.h>
using namespace std;

void one()
{
	//1. ������� ��������� ���� ��  N �����.
	//��� �����, ������������ � �������, ���������� � ���� ����� ����, � � ��������� - � ������ ����� ����.
	char ch = ' ';
	char str[1000];
	FILE *infile, *outvfile, *outcfile;																					  // ��������� �� �����  (outvfile-�������, outcfile-���������)
	infile = fopen("D:\\������\\����������������\\����������������\\������� ����\\C2\\laboratory_10\\1\\input.txt", "w"); // �������� ������ ����� input.txt
	system("CLS");
	int count, i;
	cout << "������� ���������� �����: ";
	cin >> count;
	cout << "\n";

	cin.get();
	cout << endl
		 << "������� " << count << " �����(�/�): " << endl
		 << "";
	for (i = 0; i < count; i++)
	{
		gets(str);
		fprintf(infile, "%s\n", str); // ������ � ���� ������ str
	}

	fclose(infile);																												// �������� ����� infile
	infile = fopen("D:\\������\\����������������\\����������������\\������� ����\\C2\\laboratory_10\\1\\input.txt", "r");		// �������� ����� input.txt ��� ������
	outvfile = fopen("D:\\������\\����������������\\����������������\\������� ����\\C2\\laboratory_10\\1\\vowel.txt", "w");		// �������� ������ ����� vowel.txt (�������)
	outcfile = fopen("D:\\������\\����������������\\����������������\\������� ����\\C2\\laboratory_10\\1\\consonant.txt", "w"); // �������� ������ ����� consonant.txt (���������)

	for (i = 0; i < count; i++)
	{
		ch = ' ';
		while (ch != '\n')
		{
			ch = getc(infile); // ������ ������� ch �� ����� infile
			if ((ch == 'a') || (ch == 'e') || (ch == 'i') || (ch == 'o') || (ch == 'u') || (ch == 'y') || (ch == 'A') || (ch == 'E') || (ch == 'I') || (ch == 'O') || (ch == 'U') || (ch == 'Y') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�') || (ch == '�'))
			{
				//cout<<"� �������";
				while (ch != ' ')
				{
					putc(ch, outvfile); // ������ � ���� outvfile ������� ch
					ch = getc(infile);
					if (ch == '\n')
						break;
				}
				putc('\n', outvfile); // ������ � ���� outvfile ������� \n
			}
			else
			{
				//cout<<"� ���������";
				while (ch != ' ')
				{
					putc(ch, outcfile); // ������ � ���� outcfile ������� ch
					ch = getc(infile);
					if (ch == '\n')
						break;
				}
				putc('\n', outcfile); // ������ � ���� outcfile ������� \n
			}
		}
	}
	fclose(infile);   // �������� ����� infile
	fclose(outcfile); // �������� ����� outcfile
	fclose(outvfile); // �������� ����� outvfile
}

void two()
{
	//2.� ����� ���� ���������� ������ ������ ��������.

	char str[1000];
	FILE *infile, *outfile;																																   // ��������� �� �����
	infile = fopen("C:\\Users\\kchipson\\Desktop\\������\\����������������_������\\����������������\\������� ����\\C2\\laboratory_10\\2\\input.txt", "w"); // �������� ������ ����� input.txt
	system("CLS");
	int count, i, j;
	cout << "������� ���������� �����: ";
	cin >> count;
	getchar();
	cout << endl
		 << "������� " << count << " �����(�/�): " << endl
		 << "";
	outfile = fopen("C:\\Users\\kchipson\\Desktop\\������\\����������������_������\\����������������\\������� ����\\C2\\laboratory_10\\2\\output.txt", "w"); // �������� ������ ����� output.txt

	for (i = 0; i < count; i++)
	{
		gets(str);
		fprintf(infile, "%s\n", str); // ������ � ���� ������ str
		for (j = strlen(str); j > 0; j--)
			putc(str[j - 1], outfile); // ������ � ���� outcfile ������� str[j]
		putc('\n', outfile);
	}
	fclose(infile);  // �������� ����� infile
	fclose(outfile); // �������� ����� outfile
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
