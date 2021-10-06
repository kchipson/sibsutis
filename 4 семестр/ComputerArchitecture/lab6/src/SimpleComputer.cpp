//
// Created by kchipson on 23.04.2020.
//

#include "SimpleComputer.hpp"

short int sc_memory[SC_MEM_SIZE] ;
uint8_t sc_regFLAGS ;

short int sc_accumulator ;
uint8_t sc_instructionCounter ;


/// Инициализирует оперативную память SC, задавая всем её ячейкам нулевые значения
/// \return 0
int sc_memoryInit()
{
    sc_instructionCounter = 0 ;
    for (short & mem : sc_memory)
        mem = 0 ;
    return 0 ;
}

/// Задает значение указанной ячейки памяти
/// \param address - ячейка памяти
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memorySet(int8_t address, short int value){

    if (address < 0 || address >= SC_MEM_SIZE){
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
int sc_memoryGet(int8_t address, short int * value){
    if (address < 0 || address >= SC_MEM_SIZE){
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
        // TODO : Тут возможно что-то должно быть
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
        // TODO : Тут возможно что-то должно быть
        return  -1 ;
     *value = sc_regFLAGS & (1 << reg) ;
    return 0 ;
}

/// Кодирует команду с указанным номером и операндом и помещает результат в value
/// \param command - команда
/// \param operand - операнд
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_commandEncode(short int command, short int operand, short int * value){

    if (!(command > 0x9 && command < 0x12) && !(command > 0x19 && command < 0x22) && !(command > 0x29 && command < 0x34) && !(command > 0x39 && command < 0x77))
        // TODO : Тут возможно что-то должно быть
        return  -1 ;
    if ((operand < 0) || (operand > 0x7F)) // TODO : может до 0x63
        // TODO : Тут возможно что-то должно быть
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
int sc_commandDecode(short int value, short int * command, short int * operand){

    int tmpCom = 0, tmpOp  = 0 ;
    if ((value >> 14) & 1){
        sc_regSet(INCORRECT_COMMAND, true) ;
        // TODO : Тут возможно что-то должно быть
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

    if (!(tmpCom > 0x9 && tmpCom < 0x12) && !(tmpCom > 0x19 && tmpCom < 0x22) && !(tmpCom > 0x29 && tmpCom < 0x34) && !(tmpCom > 0x39 && tmpCom < 0x77)){
        sc_regSet(INCORRECT_COMMAND, true) ;
        // TODO : Тут возможно  что-то должно быть
        return  -1 ;
    }
    if ((tmpOp < 0) || (tmpOp > 0x7F)){ // TODO : может до 0x63
        sc_regSet(INCORRECT_COMMAND, true) ;
        // TODO : Тут возможно что-то должно быть
        return  -1 ;
    }

    * command = tmpCom ;
    * operand = tmpOp ;
    return 0 ;

}
