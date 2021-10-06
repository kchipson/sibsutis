#include <cstdio>
#include <cstring>
#include <cstdlib>
#include <iostream>

using namespace std;

struct record
{
	char author[12];
	char title[32];
	char publisher[16];
	short int year;
	short int num_of_page;
};

struct record1
{
	char a[30];
	short int b;
	char c[22];
	char d[10];
};

struct record2
{
	char a[30];
	unsigned short int b;
	char c[10];
	char d[22];
};

struct record3
{
	char a[32];
	char b[18];
	short int c;
	short int d;
	char e[10];
};

int main()
{
	FILE *fp;
	fp = fopen("testBase3.dat", "rb");
	record tt[4000] = {0};
	record1 mas[4000] = {0};
	record2 mas2[4000] = {0};
	record3 mas3[4000] = {0};
	int i = 0;
	i = fread((record2 *)mas2, sizeof(record2), 4000, fp);
	cout << i << endl;
	/*for(int i=0;i<4000;++i)
		cout<<tt[i].author<<endl<<tt[i].title<<endl<<tt[i].publisher<<endl<<tt[i].year<<endl<<tt[i].num_of_page<<endl<<endl;*/
	i = 0;
	/*while((i++)<500)
	{
		getchar();
		cout<<mas3[i].a<<endl<<mas3[i].b<<endl<<mas3[i].c<<endl<<mas3[i].d<<endl<<mas3[i].e<<endl<<endl;
	}*/
	i = 0;
	/*while((i++)<500)
	{
		getchar();
		cout<<mas[i].a<<endl<<mas[i].b<<endl<<mas[i].c<<endl<<mas[i].d<<endl<<endl;
	}*/
	/*while((i++)<500)
	{
		getchar();
		cout<<mas2[i].a<<endl<<mas2[i].b<<endl<<mas2[i].c<<endl<<mas2[i].d<<endl<<endl;
	}*/
	cout << sizeof(record) << endl
		 << sizeof(record1) << endl
		 << sizeof(record2) << endl
		 << sizeof(record3) << endl
		 << endl;

	return 0;
}
