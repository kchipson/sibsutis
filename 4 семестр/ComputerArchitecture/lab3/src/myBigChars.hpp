//
// Created by kchipson on 19.05.2020.
//

#ifndef MYBIGCHARS_HPP
#define MYBIGCHARS_HPP

#include "myTerm.hpp"

/* Псевдографика */
#define ACS_CKBOARD  "a" // Штриховка
#define ACS_ULCORNER "l" // Левый верхний угол
#define ACS_URCORNER "k" // Правый верхний угол
#define ACS_LRCORNER "j" // Правый нижний угол
#define ACS_LLCORNER "m" // Левый нижний угол
#define ACS_HLINE    "q" // Горизонтальная линия
#define ACS_VLINE    "x" // Вертикальная линия


int bc_printA (char * str) ;

int bc_box(int x, int y, int width, int height) ;

int bc_printBigChar(int *big, int x, int y, enum colors colorFG, enum colors colorBG) ;

int bc_setBigCharPos (int * big, int x, int y, int value) ;
int bc_getbigcharpos(int * big, int x, int y, int *value) ;


int bc_bigCharWrite(int fd, int * big, int count) ;
int bc_bigCharRead(int fd, int * big, int need_count, int * count) ;

#endif //MYBIGCHARS_HPP
