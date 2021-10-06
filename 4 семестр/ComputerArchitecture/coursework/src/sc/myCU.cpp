//
// Created by kchipson on 29.05.2020.
//

#include "myCU.hpp"

int cu_read(unsigned short int operand) ;
int cu_write(unsigned short int operand) ;

int cu_load(unsigned short int operand) ;
int cu_store(unsigned short int operand) ;

int cu_jump(unsigned short int operand) ;
int cu_jneg(unsigned short int operand) ;
int cu_jz(unsigned short int operand) ;


int CU (){
    unsigned short int command = 0;
    unsigned short int operand = 0;
    unsigned short int currCell;
    sc_memoryGet(sc_instructionCounter, &currCell) ;
    if (sc_commandDecode(currCell, &command, &operand)){
        return -1 ;
    }
    switch (command) {
        case READ:
            if (cu_read(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        case WRITE:
            if (cu_write(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;

        case LOAD :
            if (cu_load(operand))
                 return -1 ;
            else
                sc_instructionCounter++ ;
            break ;

        case STORE :
            if (cu_store(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;

        case JUMP :
            if (cu_jump(operand))
                return -1 ;
            break ;
        case JNEG :
            if (cu_jneg(operand))
                return -1 ;
            break ;
        case JZ   :
            if (cu_jz(operand))
                return -1 ;
            break ;
        case HALT :
            // sc_instructionCounter = operand ;
            return -1 ;
            break ;
        default:
            if (ALU(command, operand))
                return -1 ;
            break ;
    }
    return 0 ;
}

int cu_read(unsigned short int operand){
    
    rk_myTermRestore() ;
    printf("Enter value of cell[\033[38;5;%dm0x%02X\033[0m] in \033[38;5;%dmHEX\033[0m format > ", colors::SOFT_GREEN, operand, colors::PEACH) ;

    char buffer[10] ;
    fgets(buffer, 10, stdin) ;
    if (buffer[strlen(buffer) - 1] != '\n')
        clearBuffIn(); // очистка потока ввода
    else
        buffer[strlen(buffer) - 1] = '\0' ;
    rk_myTermRegime(false, 0, 0, false, false) ;
    unsigned short int res = 0 ;
    int i ;

    if (buffer[0] == '+' or buffer[0] == '-')
        i = 1 ;
    else{
        res |= (1 << 14) ;
        (buffer[0] == '-') ? (res |= (1 << 13)) :  i = 0 ;
    }
    if (!checkCorrectInputHEX(&buffer[i])){
        res |= (1 << 15) ;
    }
    else{
        long int number ;
        char * tmp ;
        number = strtol(&buffer[i], &tmp, 16) ;

        if (buffer[0] == '+') { // Проверка на команду
            if (number > 0x3FFF)
                res |= (1 << 15) ;
            else
            {
                number &= 0x3FFF ;

                unsigned short int value = 0;
                if (sc_commandEncode((unsigned short int)((number >> 8)), (unsigned short int)(number & 0xFF), &value)){
                    res |= (1 << 15) ;
                }
                else
                    res |= value ;
            }
        }
        else{
            if (number > 0x2000 or (number > 0x1FFF and buffer[0] != '-') ){
                res |= (1 << 15) ;
            }
            if (buffer[0] == '-'){
                number = ~number + 1 ;
                if (!((number >> 13) & 1))
                    res &= ~(1 << 13) ;
            }
            number &= 0x1FFF ;
            res |= number ;
        }
    }

    if (sc_memorySet(operand, (unsigned short int)res))
        return -1 ;
    return 0 ;
}

int cu_write(unsigned short int operand){
    unsigned short int value;
    if(sc_memoryGet(operand, &value)){
        return -1 ;
    }
    printf("Value in a cell [\033[38;5;%dm0x%02X\033[0m] <  ", colors::SOFT_GREEN, operand) ;
    if ((value >> 14) & 1)
        if ((value >> 13) & 1)
            printf("-%04X", (~(value - 1)) & 0x3FFF) ;
        else
            printf(" %04X", value & 0x1FFF) ;
    else
        printf("+%04X", value) ;
    getchar() ;
    return 0 ;
}

int cu_load(unsigned short int operand){
    // может ли в accumulator храниться команда ? (теперь нет)
    unsigned short int value;
    if (sc_memoryGet(operand, &value)){
        return -1 ;
    }
    if (!((value >> 14) & 1)){
        sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
        return - 1;
    }
    sc_accumulator = value ;
    return 0 ;
}

int cu_store(unsigned short int operand){
    if (sc_memorySet(operand, sc_accumulator))
        return -1 ;
    return 0 ;
}

int cu_jump(unsigned short int operand){
    if (operand > 0x63){
        sc_regSet(OUT_OF_MEMORY, true) ;
        return -1 ;
    }
    sc_instructionCounter = operand ;
    return 0 ;
}

int cu_jneg(unsigned short int operand){
    if (((sc_accumulator >> 14) & 1) and ((sc_accumulator >> 13) & 1)){
        if (operand > 0x63){
            sc_regSet(OUT_OF_MEMORY, true) ;
            return -1 ;
        }
        sc_instructionCounter = operand ;
    }
    else
        sc_instructionCounter++ ;
    return 0 ;
}

int cu_jz(unsigned short int operand){
    if (((sc_accumulator >> 14) & 1) and ((sc_accumulator & 0x3FFF) == 0)){
        if (operand > 0x63){
            sc_regSet(OUT_OF_MEMORY, true) ;
            return -1 ;
        }
        sc_instructionCounter = operand ;
    }
    else
        sc_instructionCounter++ ;
    return 0 ;
}
