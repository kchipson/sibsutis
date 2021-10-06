//
// Created by kchipson on 19.05.2020.
//

#include "myUI.hpp"
#include "myReadkey.hpp"

int8_t currMemCell = 0 ;

int drawingBoxes() ;
int drawingTexts() ;
int drawingMemory() ;
int drawingAccumulator() ;
int drawingInstructionCounter() ;
int drawingOperation() ;
int drawingFlags() ;
int drawingBigChar() ;
bool checkCorrectInputHEX(const char *buffer) ;
bool checkCorrectInputDEC(const char *buffer) ;
int ui_messageOutput(char *str, enum colors color) ;

/// "Инициализация" интерфейса пользователя
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int ui_initial(){
    currMemCell = 0 ;
    if (rk_myTermSave())
        return -1 ;
    sc_memoryInit() ;
    sc_accumulator &= (1 << 14) ;
    sc_regInit() ;
    sc_regSet(IGNORING_TACT_PULSES, true) ;
    return 0 ;
}

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
    if (drawingAccumulator())
        return -1 ;
    if (drawingInstructionCounter())
        return -1 ;
    if (drawingOperation())
        return -1 ;
    if (drawingFlags())
        return -1 ;
    if (drawingBigChar())
        return -1 ;
    mt_gotoXY(1, 23) ;
    printf("Input/Output:\n") ;
    return 0 ;
}
/// Перемещение выделенной ячейки на значение ICounter
/// \return 0
int setCurrMemPointer_to_ICounter(){
    currMemCell = sc_instructionCounter ;
    return 0 ;
}

/// Перемещение выделенной ячейки
/// \param key - Клавиша
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int ui_moveCurrMemPointer(keys key){
    switch (key) {
        case keys::KEY_UP:    (currMemCell <= 9) ? (currMemCell = 90 + currMemCell) : (currMemCell -= 10) ; return 0 ;
        case keys::KEY_RIGHT: (!((currMemCell + 1) % 10)) ? (currMemCell -= 9) : (currMemCell += 1) ; return 0 ;
        case keys::KEY_DOWN:  (currMemCell >= 90) ? (currMemCell = currMemCell - 90) : (currMemCell += 10) ; return 0 ;
        case keys::KEY_LEFT:  (!(currMemCell % 10)) ? (currMemCell += 9) : (currMemCell -= 1) ; return 0 ;
    }
    return -1 ;
}

int ui_setMCellValue(){
    printf("Set the value of the cell under the number \033[38;5;%dm0x%02X\033[0m\n", colors::SOFT_GREEN, currMemCell) ;
    printf("Enter value in \033[38;5;%dmHEX\033[0m format > ", colors::PEACH);
    char buffer[10] ;
    fgets(buffer, 10, stdin) ;
    if (buffer[strlen(buffer) - 1] != '\n')
        clearBuffIn(); // очистка потока ввода
    else
        buffer[strlen(buffer) - 1] = '\0' ;

    unsigned short int res = 0 ;
    int i ;

    if (buffer[0] == '+')
        i = 1 ;
    else{
        res |= (1 << 14) ;
        if (buffer[0] == '-') {
            i = 1 ;
            res |= (1 << 13) ;
        }
        else
            i = 0 ;
    }

    if (!checkCorrectInputHEX(&buffer[i])){
        ui_messageOutput((char *)"Invalid input", colors::RED) ;
        return -1 ;
    }

    long int number ;
    char * tmp ;
    number = strtol(&buffer[i], &tmp, 16) ;

    if (buffer[0] == '+') { // Проверка на команду
        if ((number >> 8) > 0x7F){
            ui_messageOutput((char *)"The command cannot be more than 7 bits (0x7F)", colors::RED) ;
            return -1 ;
        }
        if ((number & 0xFF) > 0x7F){
            ui_messageOutput((char *)"The operand cannot be more than 7 bits (0x7F)", colors::RED) ;
            return -1 ;
        }

        unsigned short int value = 0;
        if (sc_commandEncode((unsigned short int)((number >> 8)), (unsigned short int)(number & 0xFF), &value))
            return -1 ;
        res |= value ;
    }
    else{
        if(number > 0x2000 or (number > 0x1FFF and buffer[0] != '-')){
            ui_messageOutput((char *)"The valid range for the value of the number from -0x2000 to 0x1FFF inclusive", colors::RED) ;
            return -1 ;
        }
        if (buffer[0] == '-'){
            number = ~number + 1 ;
            if (!((number >> 13) & 1))
                res &= ~(1 << 13) ;
        }
        number &= 0x1FFF ;
        res |= number ;
    }
    if (sc_memorySet(currMemCell, res))
        return -1 ;
    return 0 ;
}

int ui_saveMemory(){
    char filename[102] ;
    printf("Saving file...\n") ;
    printf("Enter the file name to save > ");
    mt_setFGcolor(colors::SOFT_GREEN) ;
    fgets(filename, 102, stdin) ;
    mt_setDefaultColorSettings() ;
    if (filename[strlen(filename) - 1] != '\n'){
        printf("\033[38;5;%dmThe file name is too long. The length is trimmed to the first 100 characters.\033[0m\n", BLUE) ;
        clearBuffIn(); // очистка потока ввода
    }
    else
        filename[strlen(filename) - 1] = '\0' ;

    if (sc_memorySave(filename)){
        ui_messageOutput((char *)"Failed to save memory", colors::RED) ;
        return -1 ;
    }
    else
        ui_messageOutput((char *)"Successful save", colors::GREEN) ;
    return 0 ;
}

int ui_loadMemory(){
    char filename[102] ;
    printf("Loading file...\n") ;
    printf("Enter the file name to load > ");
    mt_setFGcolor(colors::SOFT_GREEN) ;
    fgets(filename, 102, stdin) ;
    mt_setDefaultColorSettings() ;
    if (filename[strlen(filename) - 1] != '\n'){
        ui_messageOutput((char *)"The name of the file to open is too long (up to 100 characters are allowed)", colors::BLUE) ;
        clearBuffIn(); // очистка потока ввода
        return -1 ;
    }
    filename[strlen(filename) - 1] = '\0' ;
    if (sc_memoryLoad(filename)){
        ui_messageOutput((char *)"Failed to load memory", colors::RED) ;
        return -1 ;
    }
    return 0 ;
}

int ui_setAccumulator(){
    // может ли в accumulator храниться команда ? (теперь нет)
    char buffer[10] ;
    printf("Set a value \033[38;5;%dm\"Accumulator\"\033[0m", colors::GREEN) ;
    printf("\nEnter value in \033[38;5;%dmHEX\033[0m format > ", colors::PEACH);
    fgets(buffer, 10, stdin) ;
    if (buffer[strlen(buffer) - 1] != '\n')
        clearBuffIn(); // очистка потока ввода
    else
        buffer[strlen(buffer) - 1] = '\0' ;

    unsigned short int res = 0 ;
    int i ;

    if (buffer[0] == '+'){
        ui_messageOutput((char *)"Invalid input", colors::RED) ;
        return -1 ;
    }
    else{
        res |= (1 << 14) ;
        if (buffer[0] == '-') {
            i = 1 ;
            res |= (1 << 13) ;
        }
        else
            i = 0 ;
    }

    if (!checkCorrectInputHEX(&buffer[i])){
        ui_messageOutput((char *)"Invalid input", colors::RED) ;
        return -1 ;
    }

    long int number ;
    char * tmp ;
    number = strtol(&buffer[i], &tmp, 16) ;

    if (buffer[0] == '+') { // Проверка на команду
        if(number > 0x3FFF){
            ui_messageOutput((char *)"The command value must not exceed 14 bits (0x3FFF)", colors::RED) ;
            return -1 ;
        }
        else
        {
            number &= 0x3FFF ;
            if ((number >> 8) > 0x7F){
                ui_messageOutput((char *)"The command cannot be more than 7 bits (0x7F)", colors::RED) ;
                return -1 ;
            }
            if ((number & 0xFF) > 0x7F){
                ui_messageOutput((char *)"The operand cannot be more than 7 bits (0x7F)", colors::RED) ;
                return -1 ;
            }
            else{
                unsigned short int value = 0;
                if (sc_commandEncode((unsigned short int)((number >> 8)), (unsigned short int)(number & 0xFF), &value))
                    return -1 ;
                res |= value ;
            }
        }
    }
    else{
        if(number > 0x2000 or (number > 0x1FFF and buffer[0] != '-') ){
            ui_messageOutput((char *)"The valid range for the value of the number from -0x2000 to 0x1FFF inclusive", colors::RED) ;
            return -1 ;
        }
        if (buffer[0] == '-'){
            number = ~number + 1 ;
            if (!((number >> 13) & 1))
                res &= ~(1 << 13) ;
        }
        number &= 0x1FFF ;
        res |= number ;
    }
    sc_accumulator = res ;
    return 0 ;
}

int ui_setICounter(){
    char buffer[10] ;
    printf("Set a value \033[38;5;%dm\"InstructionCounter\"\033[0m between \033[38;5;%dm00\033[0m and \033[38;5;%dm99\033[0m inclusive\n", colors::GREEN, colors::SOFT_GREEN, colors::SOFT_GREEN) ;
    printf("Enter value in \033[38;5;%dmDEC\033[0m format > ", colors::PEACH);
    fgets(buffer, 10, stdin) ;
    if (buffer[strlen(buffer) - 1] != '\n')
        clearBuffIn(); // очистка потока ввода
    else
        buffer[strlen(buffer) - 1] = '\0' ;
    if (!checkCorrectInputDEC(buffer)){
        ui_messageOutput((char *)"Invalid input", colors::RED) ;
        return -1 ;
    }
    long int number ;
    char * tmp ;
    number = strtol(buffer, &tmp, 10);

    if(number > 99){
        ui_messageOutput((char *)"The value must not exceed the amount of memory", colors::RED) ;
        return -1 ;
    }
    sc_instructionCounter = (uint8_t)number ;

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
    mt_gotoXY(67,7) ;
    printf(" Operation ") ;
    mt_gotoXY(69,10) ;
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
            unsigned short int tmp ;
            sc_memoryGet(i * 10 + j, &tmp) ;
            if ((i * 10 + j) == currMemCell)
                mt_setBGcolor(colors::GREEN) ;
            if((tmp >> 14) & 1)
                if((tmp >> 13) & 1)
                    printf("-%04X", (~(tmp - 1)) & 0x3FFF) ;
                else
                    printf(" %04X", tmp & 0x1FFF) ;
            else
                printf("+%04X", tmp) ;
            mt_setDefaultColorSettings() ;
        }
    return 0 ;
}

/// Отрисовка accumulator
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingAccumulator(){
    mt_gotoXY(70,2) ;
//    bool over ;
//    sc_regGet(OVERFLOW, &over) ;
//    if (over){
//        mt_setFGcolor(colors::PEACH) ;
//        printf(" over") ;
//        mt_setDefaultColorSettings() ;
//    }
//    else{
    if((sc_accumulator >> 14) & 1)
        if((sc_accumulator >> 13) & 1)
            printf("-%04X", (~(sc_accumulator - 1)) & 0x3FFF) ;
        else
            printf(" %04X", sc_accumulator & 0x1FFF) ;
    else
        printf("+%04X", sc_accumulator) ;
//    }
    return 0 ;
}

/// Отрисовка Operation
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingOperation(){
    // TODO : Сломается при чтении из файла (Сломается при считывании из файла если  Op || Co > 0x7F), что делать ? (запустать лишь при работе компьютера?)
    //  А может и не сломается :/ (подумат)
    mt_gotoXY(69,8) ;

    unsigned short int tmp ;
    sc_memoryGet(currMemCell, &tmp) ;
    if(!((tmp >> 14) & 1)){
        unsigned short int operand, command ;
        sc_commandDecode(tmp, &command, &operand) ;
        printf("+%02X:%02X", command, operand) ;
    }
    else{
        unsigned short int left, right ;

        bool negative = (tmp >> 13) & 1 ;
        if(negative)
            tmp = (~(tmp - 1)) & 0x3FFF ;
        else
            tmp &= 0x1FFF ;

        left = tmp >> 8 ;
        right = tmp & 0xFF ;

        negative ? printf("-%02X:%02X", left, right) : printf(" %02X:%02X", left, right) ;

    }
    return 0 ;
}

/// Отрисовка instructionCounter
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int drawingInstructionCounter(){
    mt_gotoXY(71,5) ;
//    bool over, zero, out, comm ;
//    sc_regGet(OVERFLOW, &over) ;
//    sc_regGet(DIVISION_ERR_BY_ZERO, &zero) ;
//    sc_regGet(OUT_OF_MEMORY, &out) ;
//    sc_regGet(INCORRECT_COMMAND, &comm) ;
//    mt_gotoXY(71,5) ;
//    if (over || zero || out || comm){
//        mt_setFGcolor(colors::SOFT_GREEN) ;
//        printf("null") ;
//        mt_setDefaultColorSettings() ;
//    }
//    else
    printf("%04X", sc_instructionCounter) ;

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
            mt_setFGcolor(colors::PEACH) ;
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
    unsigned short int tmp ;
    sc_memoryGet(currMemCell, &tmp) ;
    if(!((tmp >> 14) & 1))
        bc_printBigChar(bc[16], 2, 14, GREEN) ; // +
    else if((tmp >> 13) & 1){
        bc_printBigChar(bc[17], 2, 14, GREEN) ; // -
        tmp = (~(tmp - 1)) & 0x3FFF;
    }
    else
        tmp &= 0x3FFF ;
    for (int i = 0; i < 4; ++i) {
        int ch = (tmp & ( 0xF << (4 * (3 - i)) )) >> (4 * (3 - i)) ;
        bc_printBigChar(bc[ch], 2 + 8 * (i + 1) + 2 * (i + 1), 14, GREEN) ;
    }

    return 0 ;
}

bool checkCorrectInputHEX(const char *buffer){
    if (strlen(buffer) == 0 or strlen(buffer) > 4)
        return false ;
    for (int i = 0 ; i < strlen(buffer) ; ++i)
        if (!(isxdigit(buffer[i])))
            return false ;
    return true ;
}

bool checkCorrectInputDEC(const char *buffer){
    if (strlen(buffer) == 0 or strlen(buffer) > 5)
        return false ;
    for (int i = 0 ; i < strlen(buffer) ; ++i)
        if (!(isdigit(buffer[i])))
            return false ;

    return true ;
}

int ui_messageOutput(char *str, enum colors color){
    printf("\033[38;5;%dm%s\033[0m", color, str) ;
    fflush(stdout) ; // очистка потока вывода
    char buffer[5] = "\0" ;
    rk_myTermRegime(false, 0, 0, false, false) ;
    read(fileno(stdin), buffer, 5) ;
    return 0 ;
}

int clearBuffIn(){
    int c;
    do {
        c = getchar();
    } while (c != '\n' && c != '\0');
    return 0 ;
}