#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include <windows.h> // Для sleep
using namespace std;

//Запись имеет вид: ФИО пассажира, количество занимаемых багажом мест, общий вес вещей. Используя функции и режим меню:
//а) создать файл из N записей;
//б) просмотреть файл;
//в) добавить в конец файла новую запись;
//г) найти и удалить из файла записи о пассажирах, общий вес вещей  которых меньше, чем 10 кг.

struct passenger {
    char name[50];
    int place;
    float weight;
} pas;

void input(FILE*); // создание нового файла
void print(FILE*); // просмотр файла
void add(FILE*); // добавление в файл
void findDel(FILE*); // поиск и изменение
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
        puts("  1 - создать файл");
        puts("  2 - просмотреть файл");
        puts("  3 - добавить в конец файла новую запись");
        puts("  4 - найти и удалить из файла записи о пассажирах, общий вес вещей  которых   меньше, чем 10 кг");
        puts("  0 - выход");
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
            cout << "\nНеверный режим!";
            Sleep(500);
            break;
        }
    }

    return 0;
}

void input(FILE* file)
{
    char symbol;
    file = fopen("file.dat", "wb"); // открытие бинарного файла для записи
    system("CLS");
    printf("\n Ввод товаров\n");
    do {
        cout << "\n ФИО: ";
        cin >> pas.name;
        cin.get();
        cout << " Место занимаемое багажом: ";
        cin >> pas.place;
        cin.get();
        cout << " Общий вес багажа: ";
        cin >> pas.weight;
        cin.get();
        fwrite(&pas, sizeof(pas), 1, file); // запись в файл одной структуры pas
        cout << "\n Закончить?  [0] ";
        symbol = getch();
    } while ((symbol != '0'));
    fclose(file);
}

void print(FILE* file)
{
    int i;
    system("CLS");
    file = fopen("file.dat", "rb"); // открытие бинарного файла для чтения
    i = 1;
    fread(&pas, sizeof(pas), 1, file); // чтение из файла одной структуры pas
    if (feof(file))
        cout << " ФАЙЛ ПУСТ! ";
    else
        while (!feof(file)) {
            cout << i << ".  " << pas.name << "   Кол-во мест: " << pas.place << "   Вес вещей: " << pas.weight << endl;

            fread(&pas, sizeof(pas), 1, file);
            i++;
        }
    getch();
    fclose(file);
}
void add(FILE* file)
{
    char symbol;
    file = fopen("file.dat", "ab"); // открытие бинарного файла для добавления
    system("CLS");
    printf("\n  Добавление в конец \n");
    do {
        cout << "\n ФИО: ";
        cin >> pas.name;
        cin.get();
        cout << " Место занимаемое багажом: ";
        cin >> pas.place;
        cin.get();
        cout << " Общий вес багажа: ";
        cin >> pas.weight;
        cin.get();
        fwrite(&pas, sizeof(pas), 1, file); // запись в файл одной структуры pas
        cout << "\n Закончить?  [0] ";
        symbol = getch();
    } while ((symbol != '0'));
    fclose(file);
}
void findDel(FILE* file)
{

    //г) найти и удалить из файла записи о пассажирах, общий вес вещей  которых меньше, чем 10 кг.
    file = fopen("file.dat", "rb+"); // открытие бинарного файла для чтения и записи
    FILE* filenew = fopen("filenew.dat", "wb"); // открытие бинарного файла для записи
    system("CLS");
    fread(&pas, sizeof(pas), 1, file);
    while (!feof(file)) {
        if (pas.weight > 9) {
            fwrite(&pas, sizeof(pas), 1, filenew); // запись в файл одной структуры pas
        }
        fread(&pas, sizeof(pas), 1, file);
    }
    fclose(file);
    fclose(filenew);

    file = fopen("file.dat", "wb"); // открытие бинарного файла для записи
    filenew = fopen("filenew.dat", "rb"); // открытие бинарного файла для чтения
    fread(&pas, sizeof(pas), 1, filenew);
    while (!feof(filenew)) {
        if (pas.weight > 9) {
            fwrite(&pas, sizeof(pas), 1, file); // запись в файл одной структуры pas
        }

        fread(&pas, sizeof(pas), 1, filenew);
    }
    fclose(filenew);
    fclose(file);
    remove("filenew.dat");
    // ЛУЧШЕ ИСПОЛЬЗОВАТЬ RENAME
}

/*   ПРИМЕР
#include <stdio.h>
#include <conio.h>
#include <stdlib.h>
#include <string.h>
#include <iostream>
#include <windows.h> // Для sleep
using namespace std;

struct tov {
    char name[10];
    float c;
    int kol;
} t1;
void input(FILE*); // создание нового файла
void print(FILE*); // просмотр файла
void app(FILE*); // добавление в файл
void find(FILE*); // поиск и изменение
int main()
{
setlocale(LC_ALL, "Russian");
 system("chcp 1251  > text");
    char c;
    FILE* tf;
    while (1) {
        system("CLS");
        puts("  1 – новый файл");
        puts("  2 – просмотр файла");
        puts("  3 – добавление в файл");
        puts("  4 – поиск ");
        puts("  0 - выход");
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
            puts(" неверный режим");
        }
    }
}
void input(FILE* tf)
{
    char ch;
    tf = fopen("file1.dat", "wb"); // открытие бинарного файла для записи
 system("CLS");
    printf("\n Ввод товаров\n");
    do {
        printf("\n название: ");
        scanf("%s", &t1.name);
        printf(" цена: ");
        scanf("%f", &t1.c);
        printf(" количество: ");
        scanf("%d", &t1.kol);
        fwrite(&t1, sizeof(t1), 1, tf); // запись в файл одной структуры t1
        printf("\n Закончить?  y/n  ");
        ch = getch();
    } while (ch != 'y');
    fclose(tf);
}
void print(FILE* tf)
{
    int i;
 system("CLS");
    tf = fopen("file1.dat", "rb"); // открытие бинарного файла для чтения
    i = 1;
    fread(&t1, sizeof(t1), 1, tf); // чтение из файла одной структуры t1
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
    tf = fopen("file1.dat", "ab"); // открытие бинарного файла для добавления
 system("CLS");
    printf("\n  Ввод товаров \n");
    do {
        printf("\n название: ");
        scanf("%s", &t1.name);
        printf(" цена: ");
        scanf("%f", &t1.c);
        printf(" количество: ");
        scanf("%d", &t1.kol);
        fwrite(&t1, sizeof(t1), 1, tf);
        printf(" Закончить?  y/n ");
        ch = getch();
    } while (ch != 'y');
    fclose(tf);
}
void find(FILE* tf)
{
    char c, tov[10];
    tf = fopen("file1.dat", "rb+"); // открытие бинарного файла для чтения и записи
 system("CLS");
    puts(" Название искомого товара: ");
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
