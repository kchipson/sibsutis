//
// Created by kchipson on 23.04.2020.
//

#ifndef SIMPLECOMPUTER_HPP
#define SIMPLECOMPUTER_HPP

#include <fstream>

#define OVERFLOW 0              // Переполнение при выполнении операции
#define DIVISION_ERR_BY_ZERO 1  // Ошибка деления на 0
#define OUT_OF_MEMORY 2         // Ошибка выхода за границы памяти
#define IGNORING_TACT_PULSES 3  // Игнорирование тактовых импульсов
#define INCORRECT_COMMAND 4     // Указана неверная команда

const short int SC_REG_SIZE = 5 ;
const short int SC_MEM_SIZE = 100 ;

extern unsigned short int sc_accumulator ;
extern uint8_t sc_instructionCounter ;

int sc_memoryInit () ;

int sc_memorySet (unsigned short int address, unsigned short int value) ;
int sc_memoryGet (unsigned short int address, unsigned short int * value) ;

int sc_memorySave (char* filename) ;
int sc_memoryLoad (char* filename) ;

int sc_regInit () ;


int sc_regSet (int8_t reg, bool value) ;
int sc_regGet (int8_t reg, bool * value) ;

int sc_commandEncode (unsigned short int command, unsigned short int operand, unsigned short int * value) ;
int sc_commandDecode (unsigned short int value, unsigned short int * command, unsigned short int * operand) ;

#endif //SIMPLECOMPUTER_HPP
