//
// Created by kchipson on 30.05.2020.
//

#include "myALU.hpp"
int alu_add(unsigned short int value) ;
int alu_divide(unsigned short int operand) ;
int alu_mul(unsigned short int operand) ;
int alu_rcr(unsigned short int operand) ;

int ALU(unsigned short int command,  unsigned short int operand){
    unsigned short int value ;
    switch (command) {
        case ADD:
            if (sc_memoryGet(operand, &value))
                return -1 ;
            if (!((value >> 14) & 1)){
                sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
                return -1 ;
            }
            if (alu_add(value))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        case SUB:
            if (sc_memoryGet(operand, &value))
                return -1 ;
            if (!((value >> 14) & 1)){
                sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
                return -1 ;
            }
            if ((value >> 13) & 1) //  Отрицательное
                value = ~((value & 0x3FFF) - 1) ;
            else
                value = (~(value & 0x3FFF)) + 1 ;

            value &= 0x3FFF ;
            value |=  (1 << 14) ; // 15бит

            if (alu_add(value))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        case DIVIDE:
            if (alu_divide(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        case MUL:
            if (alu_mul(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        case RCR:
            if (alu_rcr(operand))
                return -1 ;
            else
                sc_instructionCounter++ ;
            break ;
        default:
            sc_regSet(INCORRECT_COMMAND, true) ;
            return -1 ;
    }

    return 0 ;
}

// http://book.kbsu.ru/theory/chapter4/1_4_12.html
int alu_add(unsigned short int value){
    unsigned short int accumulator, res;

    accumulator = sc_accumulator & 0x3FFF ;
    value &=  0x3FFF;

    if (((accumulator >> 13) & 1) and ((value >> 13) & 1)){ // Если оба отрицательны
        value = ~(value - 1) & 0x3FFF ;
        accumulator = ~(accumulator - 1) & 0x3FFF ;

        res = accumulator + value;
        if (res > 0x2000){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
        res = ~res + 1 ;
    }
    else if (((accumulator >> 13) & 1) or ((value >> 13) & 1)) { // Если одно из чисел отрицательно
        res = accumulator + value ;
    }
    else{
        res = accumulator + value ;
        if (res > 0x1FFF){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
    }

    res |=  (1 << 14) ;
    sc_accumulator = res ;
    return 0  ;
}

int alu_divide(unsigned short int operand){
    unsigned short int value,accumulator, res ;
    if (sc_memoryGet(operand, &value))
        return -1 ;
    if (!((value >> 14) & 1)){
        sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
        return -1 ;
    }

    bool negative = 0 ;
    accumulator = sc_accumulator & 0x3FFF ;
    value &=  0x3FFF;
    if ((accumulator >> 13) & 1){
        negative = !negative ;
        accumulator = ~(accumulator - 1);
    }
    accumulator &= 0x3FFF ;

    if ((value >> 13) & 1){
        negative = !negative ;
        value = ~(value - 1);
    }
    value &= 0x3FFF ;

    if (value == 0){
        sc_regSet(DIVISION_ERR_BY_ZERO, true) ;
        return -1 ;
    }

    res = accumulator / value ;
    if (negative){
        if (res > 0x2000){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
        res = (~res + 1) & 0x3FFF ;
        res |=  (1 << 14) ;
        sc_accumulator = res ;
    }
    else {
        if (res > 0x1FFF){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
        res |=  (1 << 14) ;
        sc_accumulator = res ;
    }

    return 0 ;
}

int alu_mul(unsigned short int operand){
    unsigned short int value,accumulator, res ;
    if (sc_memoryGet(operand, &value))
        return -1 ;
    if (!((value >> 14) & 1)){
        sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
        return -1 ;
    }

    bool negative = 0 ;
    accumulator = sc_accumulator & 0x3FFF ;
    value &=  0x3FFF;
    if ((accumulator >> 13) & 1){
        negative = !negative ;
        accumulator = ~(accumulator - 1);
    }
    accumulator &= 0x1FFF ;

    if ((value >> 13) & 1){
        negative = !negative ;
        value = ~(value - 1);
    }
    value &= 0x1FFF ;

    res = accumulator * value ;
    if (negative){
        if (res > 0x2000){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
        res = (~res + 1) & 0x3FFF ;
        res |=  (1 << 14) ;
        sc_accumulator = res ;
    }
    else {
        if (res > 0x1FFF){
            sc_regSet(OVERFLOW, true) ;
//            return -1 ;
        }
        res |=  (1 << 14) ;
        sc_accumulator = res ;
    }

    return 0 ;
}

int alu_rcr(unsigned short int operand){
    unsigned short int res, value ;
    if (sc_memoryGet(operand, &value))
        return -1 ;
    if (!((value >> 14) & 1)){
        sc_regSet(INCORRECT_COMMAND, true) ; // TODO : такой ли флаг ?
        return -1 ;
    }


    bool negative = (value >> 13) & 1;

    if (negative) //  Отрицательное
        value = ~(value - 1) & 0x3FFF ;
    else
        value &= 0x1FFF ;

    res = (value>> 1) | ((value & 1) << 12) ;
    if (negative){
        if (res > 0x2000)
            sc_regSet(OVERFLOW, true) ;
        res = (~res + 1) & 0x3FFF ;
    }
    else{
        if (res > 0x1FFF)
            sc_regSet(OVERFLOW, true) ;
    }
    res |=  (1 << 14) ;
    sc_accumulator = res ;
    return 0 ;
}