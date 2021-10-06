//
// Created by kchipson on 25.05.2020.
//

#include "myReadkey.hpp"

termios save;

/// Возвращающую первую клавишу, которую нажал пользователь
/// \param key - Адрес переменной, в которую возвращается номер нажатой клавиши
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int rk_readKey (enum keys * key){
    fflush(stdout) ; // очистка потока вывода
    char buffer[5] = "\0";
    rk_myTermRegime(0, 30, 0, 0, 0);
    read(fileno(stdin), buffer, 5);
    rk_myTermRestore();
    if (key == NULL)
        return 0 ;

//    int i = 0 ;
//    while  (buffer[i] != '\0'){
//        printf("\n%d",(int)buffer[i]) ;
//        i++ ;
//    }

    if (buffer[0] == '\033')
        if (buffer[1] == '\0')
            *key = KEY_ESC ;
        else if (buffer[1] == '[')
            if (buffer[2] == 'A' and buffer[3] == '\0')
                *key = KEY_UP ;
            else if (buffer[2] == 'B' and buffer[3] == '\0')
                *key = KEY_DOWN ;
            else if (buffer[2] == 'C' and buffer[3] == '\0')
                *key = KEY_RIGHT ;
            else if (buffer[2] == 'D' and buffer[3] == '\0')
                *key = KEY_LEFT ;
            else if (buffer[2] == '1' and buffer[3] == '5')
                *key = KEY_F5 ;
            else if (buffer[2] == '1' and buffer[3] == '7')
                *key = KEY_F6 ;
            else
                *key = KEY_OTHER ;
        else
            *key = KEY_OTHER ;
    else if (buffer[0] == '\n' and buffer[1] == '\0')
        *key = KEY_ENTER ;
    else
        if ((buffer[0] == 'l' or buffer[0] == 'L') and buffer[1] == '\0')
            *key = KEY_L ;
        else if ((buffer[0] == 's' or buffer[0] == 'S') and buffer[1] == '\0')
            *key = KEY_S ;
        else if ((buffer[0] == 'r' or buffer[0] == 'R') and buffer[1] == '\0')
            *key = KEY_R ;
        else if ((buffer[0] == 't' or buffer[0] == 'T') and buffer[1] == '\0')
            *key = KEY_T ;
        else if ((buffer[0] == 'i' or buffer[0] == 'I') and buffer[1] == '\0')
            *key = KEY_I ;

        else
            *key = KEY_OTHER ;
    return 0 ;
}

/// Функция, сохраняющая текущие параметры терминала
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int rk_myTermSave(){
    if (tcgetattr(fileno(stdin), &save))
        return -1 ;
    return 0 ;
}

/// Функция, восстанавливающая сохраненные параметры терминала
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int rk_myTermRestore(){
    tcsetattr(fileno(stdin), TCSAFLUSH, &save) ;
    return 0 ;
}

/// Функция, переключающая режим работы терминала (канонический / неканонический)
/// \param regime
/// \param vtime
/// \param vmin
/// \param echo
/// \param sigint
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int rk_myTermRegime(bool regime, unsigned int vtime, unsigned int vmin, bool echo, bool sigint){
    struct termios curr ;
    tcgetattr(fileno(stdin), &curr) ;

    if(regime)
        curr.c_lflag |= ICANON ;
    else{
        curr.c_lflag &= ~ICANON ;
        sigint ? (curr.c_lflag |= ISIG) : (curr.c_lflag &= ~ISIG) ;
        echo ? (curr.c_lflag |= ECHO) : (curr.c_lflag &= ~ECHO) ;
        curr.c_cc[VMIN] = vmin ;
        curr.c_cc[VTIME] = vtime ;

    }

    tcsetattr(0,TCSAFLUSH,&curr);

    return 0;
}

