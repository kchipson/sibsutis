#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include <windows.h> // ��� sleep
using namespace std;

//������ ����� ���: ��� ���������, ���������� ���������� ������� ����, ����� ��� �����. ��������� ������� � ����� ����:
//�) ������� ���� �� N �������;
//�) ����������� ����;
//�) �������� � ����� ����� ����� ������;
//�) ����� � ������� �� ����� ������ � ����������, ����� ��� �����  ������� ������, ��� 10 ��.

struct passenger {
    char name[50];
    int place;
    float weight;
} pas;

void input(FILE*); // �������� ������ �����
void print(FILE*); // �������� �����
void add(FILE*); // ���������� � ����
void findDel(FILE*); // ����� � ���������
int main()
{
    setlocale(LC_ALL, "Russian");
    system("chcp 1251  > text");
    char symbol;
    FILE* file;
    file = fopen("file.dat", "wb");
    fclose(file);

    while (1) {
        system("CLS");
        puts("  1 - ������� ����");
        puts("  2 - ����������� ����");
        puts("  3 - �������� � ����� ����� ����� ������");
        puts("  4 - ����� � ������� �� ����� ������ � ����������, ����� ��� �����  �������   ������, ��� 10 ��");
        puts("  0 - �����");
        symbol = getch();
        switch (symbol) {
        case '1':
            input(file);
            break;
        case '2':
            print(file);
            break;
        case '3':
            add(file);
            break;
        case '4':
            findDel(file);
            break;
        case '0':
            return 0;
        default:
            system("CLS");
            cout << "\n�������� �����!";
            Sleep(500);
            break;
        }
    }

    return 0;
}

void input(FILE* file)
{
    char symbol;
    file = fopen("file.dat", "wb"); // �������� ��������� ����� ��� ������
    system("CLS");
    printf("\n ���� �������\n");
    do {
        cout << "\n ���: ";
        cin >> pas.name;
        cin.get();
        cout << " ����� ���������� �������: ";
        cin >> pas.place;
        cin.get();
        cout << " ����� ��� ������: ";
        cin >> pas.weight;
        cin.get();
        fwrite(&pas, sizeof(pas), 1, file); // ������ � ���� ����� ��������� pas
        cout << "\n ���������?  [0] ";
        symbol = getch();
    } while ((symbol != '0'));
    fclose(file);
}

void print(FILE* file)
{
    int i;
    system("CLS");
    file = fopen("file.dat", "rb"); // �������� ��������� ����� ��� ������
    i = 1;
    fread(&pas, sizeof(pas), 1, file); // ������ �� ����� ����� ��������� pas
    if (feof(file))
        cout << " ���� ����! ";
    else
        while (!feof(file)) {
            cout << i << ".  " << pas.name << "   ���-�� ����: " << pas.place << "   ��� �����: " << pas.weight << endl;

            fread(&pas, sizeof(pas), 1, file);
            i++;
        }
    getch();
    fclose(file);
}
void add(FILE* file)
{
    char symbol;
    file = fopen("file.dat", "ab"); // �������� ��������� ����� ��� ����������
    system("CLS");
    printf("\n  ���������� � ����� \n");
    do {
        cout << "\n ���: ";
        cin >> pas.name;
        cin.get();
        cout << " ����� ���������� �������: ";
        cin >> pas.place;
        cin.get();
        cout << " ����� ��� ������: ";
        cin >> pas.weight;
        cin.get();
        fwrite(&pas, sizeof(pas), 1, file); // ������ � ���� ����� ��������� pas
        cout << "\n ���������?  [0] ";
        symbol = getch();
    } while ((symbol != '0'));
    fclose(file);
}
void findDel(FILE* file)
{

    //�) ����� � ������� �� ����� ������ � ����������, ����� ��� �����  ������� ������, ��� 10 ��.
    file = fopen("file.dat", "rb+"); // �������� ��������� ����� ��� ������ � ������
    FILE* filenew = fopen("filenew.dat", "wb"); // �������� ��������� ����� ��� ������
    system("CLS");
    fread(&pas, sizeof(pas), 1, file);
    while (!feof(file)) {
        if (pas.weight > 9) {
            fwrite(&pas, sizeof(pas), 1, filenew); // ������ � ���� ����� ��������� pas
        }
        fread(&pas, sizeof(pas), 1, file);
    }
    fclose(file);
    fclose(filenew);

    file = fopen("file.dat", "wb"); // �������� ��������� ����� ��� ������
    filenew = fopen("filenew.dat", "rb"); // �������� ��������� ����� ��� ������
    fread(&pas, sizeof(pas), 1, filenew);
    while (!feof(filenew)) {
        if (pas.weight > 9) {
            fwrite(&pas, sizeof(pas), 1, file); // ������ � ���� ����� ��������� pas
        }

        fread(&pas, sizeof(pas), 1, filenew);
    }
    fclose(filenew);
    fclose(file);
    remove("filenew.dat");
    // ����� ������������ RENAME
}

/*   ������
#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include <windows.h> // ��� sleep
using namespace std;

struct tov {
    char name[10];
    float c;
    int kol;
} t1;
void input(FILE*); // �������� ������ �����
void print(FILE*); // �������� �����
void app(FILE*); // ���������� � ����
void find(FILE*); // ����� � ���������
int main()
{
setlocale(LC_ALL, "Russian");
 system("chcp 1251  > text");
    char c;
    FILE* tf;
    while (1) {
        system("CLS");
        puts("  1 � ����� ����");
        puts("  2 � �������� �����");
        puts("  3 � ���������� � ����");
        puts("  4 � ����� ");
        puts("  0 - �����");
        c = getch();
        switch (c) {
        case '1':
            input(tf);
            break;
        case '2':
            print(tf);
            break;
        case '3':
            app(tf);
            break;
        case '4':
            find(tf);
            break;
        case '0':
            return 0;
        default:
            puts(" �������� �����");
        }
    }
}
void input(FILE* tf)
{
    char ch;
    tf = fopen("file1.dat", "wb"); // �������� ��������� ����� ��� ������
 system("CLS");
    printf("\n ���� �������\n");
    do {
        printf("\n ��������: ");
        scanf("%s", &t1.name);
        printf(" ����: ");
        scanf("%f", &t1.c);
        printf(" ����������: ");
        scanf("%d", &t1.kol);
        fwrite(&t1, sizeof(t1), 1, tf); // ������ � ���� ����� ��������� t1
        printf("\n ���������?  y/n  ");
        ch = getch();
    } while (ch != 'y');
    fclose(tf);
}
void print(FILE* tf)
{
    int i;
 system("CLS");
    tf = fopen("file1.dat", "rb"); // �������� ��������� ����� ��� ������
    i = 1;
    fread(&t1, sizeof(t1), 1, tf); // ������ �� ����� ����� ��������� t1
    while (!feof(tf)) {
        printf("\n  %3d tovar %10s cena %6.2f kolic %4d", i, t1.name, t1.c, t1.kol);
        fread(&t1, sizeof(t1), 1, tf);
        i++;
    }
    getch();
}
void app(FILE* tf)
{
    char ch;
    tf = fopen("file1.dat", "ab"); // �������� ��������� ����� ��� ����������
 system("CLS");
    printf("\n  ���� ������� \n");
    do {
        printf("\n ��������: ");
        scanf("%s", &t1.name);
        printf(" ����: ");
        scanf("%f", &t1.c);
        printf(" ����������: ");
        scanf("%d", &t1.kol);
        fwrite(&t1, sizeof(t1), 1, tf);
        printf(" ���������?  y/n ");
        ch = getch();
    } while (ch != 'y');
    fclose(tf);
}
void find(FILE* tf)
{
    char c, tov[10];
    tf = fopen("file1.dat", "rb+"); // �������� ��������� ����� ��� ������ � ������
 system("CLS");
    puts(" �������� �������� ������: ");
    gets(tov);
    fread(&t1, sizeof(t1), 1, tf);
    while (!feof(tf)) {
        if (strcmp(t1.name, tov) == 0) {
            printf(" tovar %10s cena %6.2f kolic %d", t1.name, t1.c, t1.kol);
            getch();
        }
        fread(&t1, sizeof(t1), 1, tf);
    }
    fclose(tf);
}
*/
