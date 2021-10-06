//
// Created by kchipson on 23.04.2020.
//
#include "iostream"

#include "SimpleComputer.hpp"

int main(){
    int value ;
    sc_memoryInit() ;
    sc_memorySet(1,5) ;
    sc_memorySet(2,4) ;
    sc_memorySet(3,3) ;
    sc_memorySet(4,2) ;
    sc_memorySet(5,1) ;
    for (int i = 0 ; i < 5 ; i++) {
        sc_memoryGet(i + 1, &value) ;
        std::cout << "RAM[" << i + 1 << "] = " << value << "\n" ;
    }
    sc_memorySave("test.bin") ;
    std::cout << "Сохранение файла" << "\n" ;
    sc_memorySet(1,99) ;
    sc_memoryGet(1, &value) ;
    std::cout << "RAM[" << 1 << "] = " << value << "\n" ;
    sc_memoryLoad("test.bin") ;
    std::cout << "Чтение файла" << "\n" ;
    for (int i = 0 ; i < 5 ; i++) {
        sc_memoryGet(i + 1, &value) ;
        std::cout << "RAM[" << i + 1 << "] = " << value << "\n" ;
    }

    std::cout << "\n\n" ;
    sc_regInit() ;
    sc_regSet(IGNORING_TACT_PULSES, 1);

    sc_regGet(OVERFLOW, &value);
    std::cout << "Флаг \"Переполнение при выполнении операции\": " << value << "\n";
    sc_regGet(DIVISION_ERR_BY_ZERO, &value);
    std::cout << "Флаг \"Ошибка деления на 0\": " << value << "\n";
    sc_regGet(OUT_OF_MEMORY, &value);
    std::cout << "Флаг \"Ошибка выхода за границы памяти\": " << value << "\n";
    sc_regGet(IGNORING_TACT_PULSES, &value);
    std::cout << "Флаг \"Игнорирование тактовых импульсов\": " << value << "\n";
    sc_regGet(INCORRECT_COMMAND, &value);
    std::cout << "Флаг \"Указана неверная команда\": " << value << "\n";

    std::cout << "\n\n" ;
    int f = 0, f_c = 0, f_o = 0;
    sc_commandEncode(0x33, 0x59, &f);
    std::cout << "Закодированная команда: "<< f << "\n";
    sc_commandDecode(f, &f_c, &f_o);
    std::cout << "Команда: "<< std::hex << f_c << "   операнд: "<< std::hex << f_o << "\n";
    return 0 ;

}