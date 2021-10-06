//
// Created by kchipson on 19.05.2020.
//

#include "myUI.hpp"

int instructionCounter;


/// Отрисовка "боксов"
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingBoxes(){
    if (bc_box(1, 1, 61, 12)) // Окно Memory
        return -1 ;
    if (bc_box(62, 1, 22, 3)) // Окно accumulator
        return -1 ;
    if (bc_box(62, 4, 22, 3)) // Окно instructionCounter
        return -1 ;
    if (bc_box(62, 7, 22, 3)) // Окно Operation
        return -1 ;
    if (bc_box(62, 10, 22, 3)) // Окно Flags
        return -1 ;
    if (bc_box(1, 13, 52, 10)) // Окно BigChars
        return -1 ;
    if (bc_box(53, 13, 31, 10)) // Окно Keys
        return -1 ;

    return 0 ;
}

/// Отрисовка заголовков и текста
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingTexts(){
    /* Заголовки */
    mt_gotoXY(30,1) ;
    printf(" Memory ") ;
    mt_gotoXY(66,1) ;
    printf(" accumulator ") ;
    mt_gotoXY(63,4) ;
    printf(" instructionCounter ") ;
    mt_gotoXY(68,7) ;
    printf(" Operation ") ;
    mt_gotoXY(68,10) ;
    printf(" Flags ") ;
    mt_gotoXY(54,13) ;
    printf(" Keys: ") ;

    /* HotKeys */
    char* hotK[] = {(char *)"l  - load",
                    (char *)"s  - save",
                    (char *)"r  - run",
                    (char *)"t  - step",
                    (char *)"i  - reset",
                    (char *)"F5 - accumulator",
                    (char *)"F6 - instructionCounter"};

    for (int i = 0 ; i < sizeof(hotK) / sizeof(*hotK) ; ++i) {
        mt_gotoXY(54,i + 14) ;
        printf("%s", hotK[i]) ;
    }
    mt_gotoXY(1, 23) ;
    printf("%s", "Input/Output:") ;
    return 0 ;
}

/// Отрисовка памяти
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingMemory(){
    for (int i = 0 ; i < 10 ; ++i)
        for (int j = 0 ; j < 10 ; ++j) {
            mt_gotoXY(2 + (5 * j + j), 2 + i) ;
            int tmp = sc_memory[i * 10 + j] ;
            if ((i * 10 + j) == instructionCounter)
                mt_setBGcolor(GREEN) ;
            if((tmp >> 14) & 1)
                printf(" %04X", tmp & (~(1 << 14))) ;
            else
                printf("+%04X", tmp) ;
            mt_setDefaultColorSettings() ;
        }



    return 0 ;
}

/// Отрисовка флагов
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingFlags(){
    char tmp[] = {'O', 'Z', 'M', 'P', 'C'};
    for (int i = 0 ; i < SC_REG_SIZE ; ++i) {
        int value ;
        if (sc_regGet(i, &value))
            return -1 ;
        if (value){
            mt_gotoXY(69 + (i * 2), 11) ;
            printf("%c", tmp[i]) ;
        }
    }

    return 0 ;
}

/// Отрисовка "BigChar'ов"
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingBigChars(){
    int tmp = sc_memory[instructionCounter] ;
    if(!((tmp >> 14) & 1))
        bc_printBigChar(bc[16], 2, 14, GREEN) ;


    for (int i = 0; i < 4; ++i) {
        int ch = (tmp & ( 0b1111 << (4 * (3 - i)) )) >> (4 * (3 - i)) ;

        bc_printBigChar(bc[ch], 2 + 8 * (i + 1) + 2 * (i + 1), 14, GREEN) ;
    }

    return 0 ;
}


/// Начальная отрисовка  интерфейса пользователя
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int ui_initial(){
    mt_clrScreen() ;
    instructionCounter = 0 ;
    if (drawingBoxes())
        return -1 ;
    if (drawingTexts())
        return -1 ;
    mt_gotoXY(1, 24) ;

    return 0 ;
}

/// Обновление интерфейса пользователя
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int ui_update(){
    if (drawingMemory())
        return -1 ;
    if (drawingFlags())
        return -1 ;
    if (drawingBigChars())
        return -1 ;
    mt_gotoXY(1, 24) ;
    return 0 ;
}