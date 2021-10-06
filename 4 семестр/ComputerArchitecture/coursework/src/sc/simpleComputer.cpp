//
// Created by kchipson on 23.04.2020.
//

#include "simpleComputer.hpp"

unsigned short int sc_memory[SC_MEM_SIZE] ;
uint8_t sc_regFLAGS ;

unsigned short int sc_accumulator ;
uint8_t sc_instructionCounter ;


/// Инициализирует оперативную память SC, задавая всем её ячейкам нулевые значения
/// \return 0
int sc_memoryInit()
{
    sc_instructionCounter = 0 ;
    for (unsigned short & mem : sc_memory)
        mem = 0 ;
    return 0 ;
}

/// Задает значение указанной ячейки памяти
/// \param address - ячейка памяти
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memorySet(unsigned short int address, unsigned short int value){

    if (address >= SC_MEM_SIZE){
        sc_regSet(OUT_OF_MEMORY, true) ;
        return -1 ;
    }

    sc_memory[address] = value ;
    return 0 ;

}

/// Возвращает значение указанной ячейки памяти
/// \param address - ячейка памяти
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memoryGet(unsigned short int address, unsigned short int * value){
    if (address >= SC_MEM_SIZE){
        sc_regSet(OUT_OF_MEMORY, true) ;
        return -1 ;
    }
    *value = sc_memory[address] ;
    return 0 ;
}

/// Сохраняет содержимое памяти в файл в бинарном виде
/// \param filename - имя файла
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memorySave(char* filename){
    FILE * fb ;
    if (!(fb = fopen(filename, "wb"))){
        return -1 ;
    }
    fwrite(sc_memory, sizeof(sc_memory), 1, fb) ;
    fclose(fb) ;
    return 0 ;
}

///  Загружает из указанного файла содержимое оперативной памяти
/// \param filename - имя файла
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memoryLoad(char* filename){
    FILE * fb ;
    if (!(fb = fopen(filename, "rb"))){
        return -1 ;
    }
    fread(sc_memory, sizeof(sc_memory), 1, fb) ;
    fclose(fb) ;
    return 0 ;
}

/// Инициализирует регистр флагов нулевым значением
/// \return 0
int sc_regInit(){
    sc_regFLAGS = 0 ;
    return 0 ;
}

/// Устанавливает значение указанного регистра флагов
/// \param reg - флаг
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_regSet(int8_t reg, bool value){
    if (reg < 0 || reg >= SC_REG_SIZE)
        return  -1 ;

    value == 1 ? (sc_regFLAGS |= (1 << reg)) : (sc_regFLAGS &= ~(1 << reg)) ;
    return 0 ;

}

/// Возвращает значение указанного флага
/// \param reg - флаг
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_regGet(int8_t reg, bool *value){
    if (reg < 0 || reg >= SC_REG_SIZE)
        return  -1 ;

     *value = sc_regFLAGS & (1 << reg) ;
    return 0 ;
}

/// Кодирует команду с указанным номером и операндом и помещает результат в value
/// \param command - команда
/// \param operand - операнд
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_commandEncode(unsigned short int command, unsigned short int operand, unsigned short int * value){
    if (command > 0x7F)
        return  -1 ;
    if (operand > 0x7F)
        return  -1 ;

    * value =  0 ;

    /* Операнд */
    for (int i = 0 ; i < 7 ;  i++) {
        int8_t bit = (operand >> i) & 1 ;
        *value |= (bit << i) ;
    }
    /* Команда */
    for (int i = 0 ; i < 7 ;  i++) {
        int8_t bit = (command >> i) & 1 ;
        *value |= (bit << (i + 7)) ;
    }
    return 0 ;

}

/// Декодирует значение как команду SС
/// \param value - значение
/// \param command - команда
/// \param operand - операнд
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_commandDecode(unsigned short int value, unsigned short int * command, unsigned short int * operand){

    int tmpCom = 0, tmpOp  = 0 ;
    if ((value >> 14) & 1){
        sc_regSet(INCORRECT_COMMAND, true) ;
        return  -1 ;
    }

    for (int i = 0 ; i < 7 ; i++) {
        int bit = (value >> i) & 1 ;
        tmpOp |= (bit << i) ;
    }

    for (int i = 0 ; i < 7 ; i++) {
        int bit = (value >> (i + 7)) & 1 ;
        tmpCom |= (bit << i) ;
    }

    * command = tmpCom ;
    * operand = tmpOp ;
    return 0 ;
}
