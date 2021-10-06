#include <windows.h>

void settextcolor(unsigned short int color,unsigned short int bg)                                                 ////??? ??????
{                                                                                                                                             //// 
     SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE),((bg*16)+(color)));
}

int get_x(void)
{
    CONSOLE_SCREEN_BUFFER_INFO window;
    GetConsoleScreenBufferInfo(GetStdHandle(STD_OUTPUT_HANDLE),&window);
    return window.dwCursorPosition.X;
}

int get_y(void)
{
    CONSOLE_SCREEN_BUFFER_INFO window;
    GetConsoleScreenBufferInfo(GetStdHandle(STD_OUTPUT_HANDLE),&window);
    return window.dwCursorPosition.Y;
}


void set_x(int x)
{
     COORD pos;
     pos.X = x;
     pos.Y = get_y();
     SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE),pos);
}

void set_y(int y)
{
     COORD pos;
     pos.X = get_x();
     pos.Y = y;
     SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE),pos);
}
void gotoxy(int x,int y)
{
     set_x(x);
     set_y(y);
}
