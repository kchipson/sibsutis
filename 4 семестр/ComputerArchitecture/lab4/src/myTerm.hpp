//
// Created by kchipson on 18.05.2020.
//

#ifndef MYTERM_HPP
#define MYTERM_HPP

#include <iostream>

#include <sys/ioctl.h>

enum colors {RED = 196, GREEN = 10, BLUE = 20, BLACK = 16, WHITE = 15, DEFAULT = 0};


int mt_clrScreen () ;

int mt_gotoXY(int col, int row) ;

int mt_getScreenSize(int* rows, int* cols) ;
int mt_setFGcolor(enum colors color) ;
int mt_setBGcolor(enum colors color) ;
int mt_setDefaultColorSettings() ;

#endif //MYTERM_HPP
