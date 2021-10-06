//
// Created by kchipson on 09.02.2020.
//

#ifndef SIMPLECOMPUTER_HPP
#define SIMPLECOMPUTER_HPP

#include <iostream>
#include <fstream>
#include <stdexcept>

#define OVERFLOW 0 /*  Переполнение при выполнении операции */
#define DIVISION_ERR_BY_ZERO 1 /* Ошибка деления на 0 */
#define OUT_OF_MEMORY 2 /* Ошибка выхода за границы памяти */
#define IGNORING_CLOCK_PULSES 3 /* Игнорирование тактовых импульсов */
#define INCORRECT_COMMAND 4 /* Указана неверная команда */
#define REG_SIZE 5


class SimpleComputer {
    /* ПОЛЯ */
private:
    static const int MEM_SIZE = 100 ;
    int memory[MEM_SIZE] ;
    uint8_t regFLAGS;

    /* КОНСТРУКТОРЫ И ДЕСТРУКТОРЫ */
public:
    SimpleComputer() ;

    /* МЕТОДЫ */
public:
    /* Память */
    void memoryInit () ; /* Инициализирует оперативную память SC, задавая всем её ячейкам нулевые значения */
    void memorySet (int address, int value) ; /* Задает значение указанной ячейки памяти как value */
    void memoryGet (int address, int * value) ; /* Возвращает значение указанной ячейки памяти в value */
    void memorySave (const std::string& filename) ; /* Сохраняет содержимое памяти в файл в бинарном виде */
    void memoryLoad (const std::string& filename) ; /* Загружает из указанного файла содержимое оперативной памяти */
    void regInit () ; /* Инициализирует регистр флагов нулевым значением */
    void regSet (int reg, int value) ; /* Устанавливает значение указанного регистра флагов */
    void regGet (int reg, int * value) ; /* Возвращает значение указанного флага */
    void commandEncode (int command, int operand, int * value) ; /* Кодирует команду с указанным номером и операндом и помещает результат в value */
    void commandDecode (int value, int * command, int * operand) ; /* Декодирует значение как команду SС */

};


#endif //SIMPLECOMPUTER_HPP
