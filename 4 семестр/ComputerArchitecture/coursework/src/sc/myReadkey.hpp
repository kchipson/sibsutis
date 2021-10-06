//
// Created by kchipson on 25.05.2020.
//

#ifndef MYREADKEY_HPP
#define MYREADKEY_HPP

#include <termio.h>
#include <stdio.h>
#include <unistd.h>


extern termios save;

enum keys
{
    KEY_L,
    KEY_S,
    KEY_R,
    KEY_T,
    KEY_I,
    KEY_F5,
    KEY_F6 ,
    KEY_UP,
    KEY_DOWN,
    KEY_RIGHT,
    KEY_LEFT,
    KEY_ESC,
    KEY_ENTER,
    KEY_OTHER,
};

int rk_readKey(enum keys *key) ;
int rk_myTermSave() ;
int rk_myTermRestore() ;
int rk_myTermRegime (bool regime, unsigned int vtime, unsigned int vmin, bool echo, bool sigint) ;


#endif //MYREADKEY_HPP
