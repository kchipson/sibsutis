//
// Created by kchipson on 19.05.2020.
//

#include "myBigChars.hpp"

unsigned int bc[][2]  = {{0xE7E7FFFF, 0xFFFFE7E7}, // 0  | 11100111111001111111111111111111 11111111111111111110011111100111
                         {0x1CDC7C3C, 0xFFFF1C1C}, // 1  | 00011100110111000111110000111100 11111111111111110001110000011100
                         {0xFF07FFFF, 0xFFFFE0FF}, // 2  | 11111111000001111111111111111111 11111111111111111110000011111111
                         {0xFF07FFFF, 0xFFFF07FF}, // 3  | 11111111000001111111111111111111 11111111111111110000011111111111
                         {0xFFE7E7E7, 0x070707FF}, // 4  | 11111111111001111110011111100111 00000111000001110000011111111111
                         {0xFFE0FFFF, 0xFFFF07FF}, // 5  | 11111111111000001111111111111111 11111111111111110000011111111111
                         {0xFFE0FFFF, 0xFFFFE7FF}, // 6  | 11111111111000001111111111111111 11111111111111111110011111111111
                         {0x1C0EFFFE, 0x3838FE38}, // 7  | 00011100000011101111111111111110 00111000001110001111111000111000
                         {0x7EE7FF7E, 0x7EFFE77E}, // 8  | 01111110111001111111111101111110 01111110111111111110011101111110
                         {0xFFE7FFFF, 0xFFFF07FF}, // 9  | 11111111111001111111111111111111 11111111111111110000011111111111
                         {0xFFE7FF7E, 0xE7E7E7FF}, // A  | 11111111111001111111111101111110 11100111111001111110011111111111
                         {0xFEE7FFFE, 0xFEFFE7FE}, // B  | 11111110111001111111111111111110 11111110111111111110011111111110
                         {0xE0E7FF7E, 0x7EFFE7E0}, // C  | 11100000111001111111111101111110 01111110111111111110011111100000
                         {0xE7E7FFF8, 0xF8FFE7E7}, // D  | 11100111111001111111111111111000 11111000111111111110011111100111
                         {0xFFE0FFFF, 0xFFFFE0FF}, // E  | 11111111111000001111111111111111 11111111111111111110000011111111
                         {0xFFE0FFFF, 0xE0E0E0FF}, // F  | 11111111111000001111111111111111 11100000111000001110000011111111
                         {0x7E180000, 0x00000018}, // +  | 01111110000110000000000000000000 00000000000000000001100001111110
                         {0x7E000000, 0x00000000}, // -  | 01111110000000000000000000000000 00000000000000000000000000000000
} ;

/// Выводит строку символов с использованием дополнительной кодировочной таблицы
/// \param str - символ
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_printA (char ch){
    printf("\033(0%c\033(B", ch) ;
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
    bc_printA((char)ACS_ULCORNER) ;
    mt_gotoXY(x + width - 1, y);
    bc_printA((char)ACS_URCORNER);
    mt_gotoXY(x + width  - 1, y + height - 1) ;
    bc_printA((char)ACS_LRCORNER) ;
    mt_gotoXY(x, y + height - 1) ;
    bc_printA((char)ACS_LLCORNER) ;

    /* Горизонтальные линии */
    for (int i = 1; i < width - 1; ++i) {
        // верхняя
        mt_gotoXY(x + i, y) ;
        bc_printA((char)ACS_HLINE) ;
        // нижняя
        mt_gotoXY(x + i, y + height - 1) ;
        bc_printA((char)ACS_HLINE) ;
    }

    /* Вертикальные линии */
    for (int i = 1; i < height - 1; ++i) {
        // верхняя
        mt_gotoXY(x, y + i) ;
        bc_printA((char)ACS_VLINE) ;
        // нижняя
        mt_gotoXY(x + width - 1, y + i) ;
        bc_printA((char)ACS_VLINE) ;
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
int bc_printBigChar(unsigned int *big, int x, int y, enum colors colorFG, enum colors colorBG){
    if (colorFG != DEFAULT)
        mt_setFGcolor(colorFG) ;
    if (colorBG != DEFAULT)
        mt_setBGcolor(colorBG) ;

    for (int i = 0; i < 8; ++i)
        for (int j = 0; j < 8; ++j)
        {
            mt_gotoXY(x + i, y + j) ;
            bool value ;
            if (bc_getbigCharPos(big, i, j, &value))
                return -1 ;
            if (value)
                bc_printA(ACS_CKBOARD) ;
            else
                printf("%c", ' ');

        }

    mt_setDefaultColorSettings() ;
    return 0 ;
}

/// Устанавливает значение знакоместа "большого символа"
/// \param big
/// \param x - столбец
/// \param y - строка
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_setBigCharPos (unsigned int * big, int x, int y, bool value){
    if ((x < 0) || (x > 7) || (y < 0) || (y > 7))
        return -1 ;
    if (value)
        big[int(y / 4)] |= (1 << (8 *(y % 4) + (7 - x))) ;
    else
        big[int(y / 4)] &= ~(1 << (8 *(y % 4) + (7 - x))) ;


    return 0 ;
}

/// Возвращает значение позиции в "большом символе"
/// \param big
/// \param x - столбец
/// \param y - строка
/// \param value
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_getbigCharPos(unsigned int* big, int x, int y, bool *value){
    if ((x < 0) || (x > 7) || (y < 0) || (y > 7))
        return -1 ;
    if (big[int(y / 4)] & (1 << (8 *(y % 4) + (7 - x))))
        *value = true ;
    else
        *value = false ;
    return 0 ;
}

/// Записывает заданное число "больших символов" в файл. Формат записи определяется пользователем;
/// \param fd
/// \param big
/// \param count
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_bigCharWrite(int fd, unsigned int * big, int count){
    if (write(fd, big,count * 2 * sizeof(unsigned int)))
        return -1 ;
    return 0 ;
}

/// Cчитывает из файла заданное количество "больших символов"
/// Третий параметр указывает адрес переменной, в которую помещается количество считанных символов или 0, в случае ошибки.
/// \param fd
/// \param big
/// \param need_count
/// \param count
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int bc_bigCharRead(int fd, unsigned int * big, int need_count, int * count){
    *count = 0 ;
    for (int i = 0; i < need_count * 2; ++i){
        if (read(fd, &big[i], sizeof(unsigned int)) == -1)
            return -1 ;
        if (!((i + 1) % 2))
            (*count)++ ;
    }

    return 0 ;
}
