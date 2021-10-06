//
// Created by kchipson on 19.05.2020.
//

#include "myUI.hpp"
#include "myReadkey.hpp"

int drawingBoxes() ;
int drawingTexts() ;
int drawingMemory() ;
int drawingFlags() ;
int drawingBigChar() ;
bool checkCorrectInput(const char buffer[10]) ;
int ui_messageOutput(char *str, enum colors color) ;

/// Обновление интерфейса пользователя
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int ui_update(){
    mt_clrScreen() ;
    if (drawingBoxes())
        return -1 ;
    if (drawingTexts())
        return -1 ;
    if (drawingMemory())
        return -1 ;
    if (drawingFlags())
        return -1 ;
    if (drawingBigChar())
        return -1 ;
    mt_gotoXY(1, 23) ;
    printf("Input/Output:\n") ;
    return 0 ;
}


int ui_setMCellValue(){
    char buffer[10] ;
    printf("Set the value of the cell under the number \033[38;5;%dm0x%X\033[0m\n", colors::SOFT_GREEN, currMemCell) ;
    printf("Enter value in \033[38;5;%dmhex\033[0m format > ", colors::PEACH);
    fgets(buffer, 10, stdin) ;
    fflush(stdin) ; // очистка потока ввода
//    printf("%d",strlen(buffer)) ;
    if (!checkCorrectInput(buffer)){
        ui_messageOutput((char *)"Invalid input", colors::RED) ;
        return -1 ;
    }
    long int number ;
    char * tmp ;
    // TODO:  добавить проверки на допустимые значения
    if (buffer[0] == '+') {
        number = strtol(&buffer[1], &tmp, 16) ;
        if(number > 0x3FFF){
            ui_messageOutput((char *)"The command value must not exceed 14 bits (0x3FFF)", colors::RED) ;
            return -1 ;
        }
        sc_memorySet(currMemCell, (short int)number) ;
    }
    else{
        number = strtol(buffer, &tmp, 16);
        if(number > 0x3FFF){
            ui_messageOutput((char *)"The value must not exceed 14 bits (0x3FFF)", colors::RED) ;
            return -1 ;
        }
        number = (1 << 14) | number ;
        sc_memorySet(currMemCell, (short int)number) ;
    }
    return 0 ;
}

int ui_saveMemory(){
    char filename[101] ;
    printf("Saving file...\n") ;
    printf("Enter the file name to save > ");
    mt_setFGcolor(colors::SOFT_GREEN) ;
    fgets(filename, 101, stdin) ;
    mt_setDefaultColorSettings() ;
//    printf("%d %d",strlen(filename), filename[strlen(filename) - 1] == '\0') ;
    if (strlen(filename) == 100 and filename[99] != '\n')
        printf("\033[38;5;%dmThe file name is too long. The length is trimmed to the first 100 characters.\033[0m\n", BLUE) ;
    else
        filename[strlen(filename) - 1] = '\0' ;
    if (sc_memorySave(filename)){
        ui_messageOutput((char *)"Failed to save memory", colors::RED) ;
        return -1 ;
    }
    else
        ui_messageOutput((char *)"Successful saving", colors::GREEN) ;
    return 0 ;
}

int ui_loadMemory(){
    char filename[101] ;
    printf("Loading file...\n") ;
    printf("Enter the file name to load > ");
    mt_setFGcolor(colors::SOFT_GREEN) ;
    fgets(filename, 101, stdin) ;
    mt_setDefaultColorSettings() ;
    if (strlen(filename) == 100 and filename[99] != '\n'){
        ui_messageOutput((char *)"The name of the file to open is too long (up to 100 characters are allowed)", colors::BLUE) ;
        return -1 ;
    }
    filename[strlen(filename) - 1] = '\0' ;
    if (sc_memoryLoad(filename)){
        ui_messageOutput((char *)"Failed to load memory", colors::RED) ;
        return -1 ;
    }
    else
        ui_messageOutput((char *)"Successful loading", colors::GREEN) ;
    return 0 ;
}

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
    return 0 ;
}

/// Отрисовка памяти
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingMemory(){
    for (int i = 0 ; i < 10 ; ++i)
        for (int j = 0 ; j < 10 ; ++j) {
            mt_gotoXY(2 + (5 * j + j), 2 + i) ;
            short int tmp ;
            sc_memoryGet(i * 10 + j, &tmp) ;
            if ((i * 10 + j) == currMemCell)
                mt_setBGcolor(colors::GREEN) ;
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
    char tmp[] = {'O', 'Z', 'M', 'I', 'C'};
    for (int i = 0 ; i < SC_REG_SIZE ; ++i) {
        bool value ;
        if (sc_regGet(i, &value))
            return -1 ;
        mt_gotoXY(68 + (i * 2), 11) ;
        if (value){
            mt_setFGcolor(colors::BLUE) ;
            printf("%c", tmp[i]) ;
        }
        else{
            mt_setFGcolor(colors::GRAY) ;
            printf("%c", tmp[i]) ;
        }
        mt_setDefaultColorSettings() ;
    }

    return 0 ;
}

/// Отрисовка "BigChar'ов"
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingBigChar(){
    short int tmp ;
    sc_memoryGet(currMemCell, &tmp) ;
    if(!((tmp >> 14) & 1))
        bc_printBigChar(bc[16], 2, 14, GREEN) ; // +

    tmp = tmp & 0x3FFF ;
    for (int i = 0; i < 4; ++i) {
        int ch = (tmp & ( 0xF << (4 * (3 - i)) )) >> (4 * (3 - i)) ;

        bc_printBigChar(bc[ch], 2 + 8 * (i + 1) + 2 * (i + 1), 14, GREEN) ;
    }

    return 0 ;
}

bool checkCorrectInput(const char buffer[10]){
//    printf("\n%d",strlen(buffer));
    int i = 0 ;
    if (buffer[0] == '+'){
        if (strlen(buffer) == 2 or strlen(buffer) > 6)
            return false ;
        ++i ;
    }
    else
    if (strlen(buffer) == 1 or strlen(buffer) > 5)
        return false ;

    for (i; i < strlen(buffer) - 1; ++i)
//        printf("\n%d", isxdigit(buffer[i])) ;
        if (!(isxdigit(buffer[i])))
            return false ;

    return true ;
}

int ui_messageOutput(char *str, enum colors color){
    printf("\033[38;5;%dm%s\033[0m", color, str) ;
    rk_readKey() ;
    return 0 ;
}