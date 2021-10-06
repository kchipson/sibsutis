//
// Created by kchipson on 23.04.2020.
//

#include "SimpleComputer.hpp"

short  sc_memory[SC_MEM_SIZE] ;
int8_t currMemCell ;
uint8_t sc_regFLAGS ;


/// Инициализирует оперативную память SC, задавая всем её ячейкам нулевые значения
/// \return 0
int sc_memoryInit()
{
    currMemCell = 0 ;
    for (int i = 0 ; i < SC_MEM_SIZE ; i++)
        sc_memory[i] = 0 ;
    return 0 ;
}

/// Задает значение указанной ячейки памяти
/// \param address - ячейка памяти
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memorySet(int8_t address, short int value){
    try
    {
        if (address < 0 || address >= SC_MEM_SIZE)
            throw std::overflow_error("ERROR\tАдрес выходит за границу памяти!") ;

        sc_memory[address] = value ;
        return 0 ;
    }
    catch (std::overflow_error err)
    {
        sc_regSet(OUT_OF_MEMORY, 1) ;
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

/// Возвращает значение указанной ячейки памяти
/// \param address - ячейка памяти
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memoryGet(int8_t address, short int * value){
    try {
        if (address < 0 || address >= SC_MEM_SIZE){
            throw std::overflow_error("ERROR\tАдрес выходит за границу памяти") ;
        }
        *value = sc_memory[address] ;
        return 0 ;
    }
    catch (std::overflow_error err)
    {
        sc_regSet(OUT_OF_MEMORY, 1) ;
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

/// Сохраняет содержимое памяти в файл в бинарном виде
/// \param filename - имя файла
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memorySave(const std::string& filename){
    std::ofstream out(filename, std::ios::binary|std::ios::out) ;
    try{
        if (!out.is_open()) {
            throw std::runtime_error("ERROR\tНе удалось открыть файл \'" + filename + "\'") ;
        }
        out.write((char*)&(sc_memory), sizeof(sc_memory)) ;
        out.close() ;
        return 0 ;
    }
    catch (std::runtime_error err) {
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

///  Загружает из указанного файла содержимое оперативной памяти
/// \param filename - имя файла
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_memoryLoad(const std::string& filename){
    std::ifstream in(filename, std::ios::binary|std::ios::out) ;
    try{
        if (!in.is_open()) {
            throw std::runtime_error("ERROR\tНе удалось открыть файл \'" + filename + "\'") ;
        }
        in.read((char*)&(sc_memory), sizeof(sc_memory)) ;
        in.close() ;
        return 0 ;
    }
    catch (std::runtime_error err) {
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
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
    try{
        if (reg < 0 || reg >= SC_REG_SIZE)
            throw std::overflow_error("ERROR\tНедопустимый регистр") ;
        if (value != 0 && value != 1)
            throw std::invalid_argument("ERROR\tНекорректное значение, допустимы: 0, 1") ;

        value == 1 ? (sc_regFLAGS |= (1 << reg)) : (sc_regFLAGS &= ~(1 << reg)) ;
        return 0 ;
    }
    catch (std::exception err)
    {
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

/// Возвращает значение указанного флага
/// \param reg - флаг
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_regGet(int8_t reg, bool *value){
    try {
        if (reg < 0 || reg >= SC_REG_SIZE)
            throw std::overflow_error("Недопустимый регистр") ;
        (sc_regFLAGS & (1 << reg)) ? *value = 1 : *value = 0 ;
        return 0 ;
    }
    catch (std::overflow_error err)
    {
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

/// Кодирует команду с указанным номером и операндом и помещает результат в value
/// \param command - команда
/// \param operand - операнд
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_commandEncode(short int command, short int operand, short int * value){
    try {
        if (!(command > 0x9 && command < 0x12) && !(command > 0x19 && command < 0x22) && !(command > 0x29 && command < 0x34) && !(command > 0x39 && command < 0x77))
            throw std::invalid_argument("ERROR\tНедопустимая команда") ;
        if ((operand < 0) || (operand >= 128))
            throw std::invalid_argument("ERROR\tНедопустимый операнд") ;
        * value =  0 ;
        /* Операнд */
        for (int i = 0 ; i < 7 ;  i++) {
            int bit = (operand >> i) & 1 ;
            *value |= (bit << i) ;
        }
        /* Команда */
        for (int i = 0 ; i < 7 ;  i++) {
            int8_t bit = (command >> i) & 1 ;
            *value |= (bit << (i + 7)) ;
        }
        return 0 ;
    }
    catch (std::invalid_argument err){
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}

/// Декодирует значение как команду SС
/// \param value - значение
/// \param command - команда
/// \param operand - операнд
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int sc_commandDecode(short int value, short int * command, short int * operand){
    try {
        int tmpCom = 0, tmpOp  = 0 ;
        if ((value >> 14) & 1)
            throw std::invalid_argument("ERROR\tНе является командой") ;

        for (int i = 0 ; i < 7 ; i++) {
            int bit = (value >> i) & 1 ;
            tmpOp |= (bit << i) ;
        }

        for (int i = 0 ; i < 7 ; i++) {
            int bit = (value >> (i + 7)) & 1 ;
            tmpCom |= (bit << i) ;
        }

        if (!(tmpCom > 0x9 && tmpCom < 0x12) && !(tmpCom > 0x19 && tmpCom < 0x22) && !(tmpCom > 0x29 && tmpCom < 0x34) && !(tmpCom > 0x39 && tmpCom < 0x77))
            throw std::invalid_argument("ERROR\tНе удалось декодировать команду") ;
        if ((tmpOp < 0) || (tmpOp >= 128))
            throw std::invalid_argument("ERROR\tНе удалось декодировать операнд") ;

        * command = tmpCom ;
        * operand = tmpOp ;
        return 0 ;
    }
    catch (std::invalid_argument err){
        sc_regSet(INCORRECT_COMMAND, 1) ;
        std::cout << err.what() << std::endl ;
        return -1 ;
    }
}
