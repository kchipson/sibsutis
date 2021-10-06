//
// Created by kchipson on 19.05.2020.
//

#include "myBigChars.hpp"

/// Выводит строку символов с использованием дополнительной кодировочной таблицы
/// \param str - символ
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_printA (char * str){
    printf("\033(0%s\033(B", str) ;
    return 0 ;
}

/// Выводит на экран псевдографическую рамку
/// \param x - строка левого вернего угла рамки
/// \param y - столбец левого вернего угла рамки
/// \param width - ширина рамки
/// \param height - высота рамки
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_box(int x, int y, int width, int height){
    int rows, cols ;
    mt_getScreenSize(&rows, &cols) ;
    if ((x <= 0)  || (y <= 0) || (x + width - 1 > cols) || (y + height - 1 > rows) || (width <= 1) || (height <= 1))
        return -1 ;

    mt_gotoXY(x, y) ;
    bc_printA((char*)ACS_ULCORNER) ;
    mt_gotoXY(x + width - 1, y);
    bc_printA((char*)ACS_URCORNER);
    mt_gotoXY(x + width  - 1, y + height - 1) ;
    bc_printA((char*)ACS_LRCORNER) ;
    mt_gotoXY(x, y + height - 1) ;
    bc_printA((char*)ACS_LLCORNER) ;

    /* Горизонтальные линии */
    for (int i = 1; i < width - 1; ++i) {
        // верхняя
        mt_gotoXY(x + i, y) ;
        bc_printA((char*)ACS_HLINE) ;
        // нижняя
        mt_gotoXY(x + i, y + height - 1) ;
        bc_printA((char*)ACS_HLINE) ;
    }

    /* Вертикальные линии */
    for (int i = 1; i < height - 1; ++i) {
        // верхняя
        mt_gotoXY(x, y + i) ;
        bc_printA((char*)ACS_VLINE) ;
        // нижняя
        mt_gotoXY(x + width - 1, y + i) ;
        bc_printA((char*)ACS_VLINE) ;
    }
    return 0 ;
}

/// Выводит на экран "большой символ" размером восемь строк на восемь столбцов
/// \param big
/// \param x - строка левого вернего угла символа
/// \param y - столбец левого вернего угла символа
/// \param colorFG - цвет текста
/// \param colorBG - цвет фона
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_printBigChar(int *big, int x, int y, enum colors colorFG, enum colors colorBG){
    return 0 ;
}

/// Устанавливает значение знакоместа "большого символа"
/// \param big
/// \param x - строка
/// \param y - столбец
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_setBigCharPos (int * big, int x, int y, int value){
    return 0 ;
}

/// Возвращает значение позиции в "большом символе"
/// \param big
/// \param x - строка
/// \param y - столбец
/// \param value
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_getbigcharpos(int * big, int x, int y, int *value){
    return 0 ;
}

/// Записывает заданное число "больших символов" в файл. Формат записи определяется пользователем;
/// \param fd
/// \param big
/// \param count
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_bigCharWrite(int fd, int * big, int count){
    return 0 ;
}

/// Cчитывает из файла заданное количество "больших символов"
/// Третий параметр указывает адрес переменной, в которую помещается количество считанных символов или 0, в случае ошибки.
/// \param fd
/// \param big
/// \param need_count
/// \param count
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_bigCharRead(int fd, int * big, int need_count, int * count){
    return 0 ;
}
