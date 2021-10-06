//
// Created by kchipson on 23.04.2020.
//

#ifndef SIMPLECOMPUTER_HPP
#define SIMPLECOMPUTER_HPP

#include "iostream"
#include <fstream>
#include <stdexcept>


#define OVERFLOW 0 /*  Переполнение при выполнении операции */
#define DIVISION_ERR_BY_ZERO 1 /* Ошибка деления на 0 */
#define OUT_OF_MEMORY 2 /* Ошибка выхода за границы памяти */
#define IGNORING_TACT_PULSES 3 /* Игнорирование тактовых импульсов */
#define INCORRECT_COMMAND 4 /* Указана неверная команда */

const int SC_REG_SIZE = 5 ;
const int SC_MEM_SIZE = 100 ;

extern int sc_memory[SC_MEM_SIZE] ;
extern uint8_t sc_regFLAGS ;

int sc_memoryInit () ; /* Инициализирует оперативную память SC, задавая всем её ячейкам нулевые значения */
int sc_memorySet (int address, int value) ; /* Задает значение указанной ячейки памяти как value */
int sc_memoryGet (int address, int * value) ; /* Возвращает значение указанной ячейки памяти в value */
int sc_memorySave (const std::string& filename) ; /* Сохраняет содержимое памяти в файл в бинарном виде */
int sc_memoryLoad (const std::string& filename) ; /* Загружает из указанного файла содержимое оперативной памяти */
int sc_regInit () ; /* Инициализирует регистр флагов нулевым значением */
int sc_regSet (int reg, int value) ; /* Устанавливает значение указанного регистра флагов */
int sc_regGet (int reg, int * value) ; /* Возвращает значение указанного флага */
int sc_commandEncode (int command, int operand, int * value) ; /* Кодирует команду с указанным номером и операндом и помещает результат в value */
int sc_commandDecode (int value, int * command, int * operand) ; /* Декодирует значение как команду SС */

#endif //SIMPLECOMPUTER_HPP
