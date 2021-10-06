//
// Created by kchipson on 18.05.2020.
//

#include "myTerm.hpp"

/// Производит очистку и перемещение курсора в левый верхний угол экрана
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_clrScreen (){
    printf("\033[H\033[2J") ;
    return 0 ;
}

/// Перемещает курсор в указанную позицию
/// \param col - столбец
/// \param row - строка
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_gotoXY(int col, int row)
{
    int rows, cols ;
    if (mt_getScreenSize(&rows, &cols) == -1)
        return -1 ;
    if ((row > rows) || (row <= 0)||(col > cols) || (col <= 0))
        return -1 ;

    printf("\033[%d;%dH", row, col) ;
    return 0 ;
}

/// Определяет размер экрана терминала
/// \param rows - кол-во строк
/// \param cols - кол-во столбцов
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_getScreenSize(int* rows, int* cols){
    struct winsize ws ;
    if (ioctl(1, TIOCGWINSZ, &ws))
        return -1 ;
    * rows = ws.ws_row ;
    * cols = ws.ws_col ;
    return 0 ;

}

/// Устанавливает цвет последующих выводимых символов
/// \param color - цвет из перечисления colors
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_setFGcolor(enum colors color){
    printf("\033[38;5;%dm",color) ;
    return 0 ;
}

/// Устанавливает цвет фона последующих выводимых символов
/// \param color - цвет из перечисления colors
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_setBGcolor(enum colors color){
    printf("\033[48;5;%dm",color) ;
    return 0 ;
}

/// Возвращает цвета в стандартное состояние
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int mt_setDefaultColorSettings(){
    printf("\033[0m") ;
    return 0 ;
}