//
// Created by kchipson on 09.02.2020.
//

#include "./lib/mySimpleComputer.hpp"
int main(){
    int value ;
    auto* computer = new SimpleComputer() ;
    computer->memoryInit() ;
    computer->memorySet(1,5) ;
    computer->memorySet(2,4) ;
    computer->memorySet(3,3) ;
    computer->memorySet(4,2) ;
    computer->memorySet(5,1) ;
    for (int i = 0 ; i < 5 ; i++) {
        computer->memoryGet(i + 1, &value) ;
        std::cout << "RAM[" << i + 1 << "] = " << value << "\n" ;
    }
    computer->memorySave("test.bin") ;
    std::cout << "Сохранение файла" << "\n" ;
    computer->memorySet(1,99) ;
    computer->memoryGet(1, &value) ;
    std::cout << "RAM[" << 1 << "] = " << value << "\n" ;
    computer->memoryLoad("test.bin") ;
    std::cout << "Чтение файла" << "\n" ;
    for (int i = 0 ; i < 5 ; i++) {
        computer->memoryGet(i + 1, &value) ;
        std::cout << "RAM[" << i + 1 << "] = " << value << "\n" ;
    }

    std::cout << "\n\n" ;
    computer->regInit() ;
    computer->regSet(IGNORING_CLOCK_PULSES, 1);

    computer->regGet(OVERFLOW, &value);
    std::cout << "Флаг \"Переполнение при выполнении операции\": " << value << "\n";
    computer->regGet(DIVISION_ERR_BY_ZERO, &value);
    std::cout << "Флаг \"Ошибка деления на 0\": " << value << "\n";
    computer->regGet(OUT_OF_MEMORY, &value);
    std::cout << "Флаг \"Ошибка выхода за границы памяти\": " << value << "\n";
    computer->regGet(IGNORING_CLOCK_PULSES, &value);
    std::cout << "Флаг \"Игнорирование тактовых импульсов\": " << value << "\n";
    computer->regGet(INCORRECT_COMMAND, &value);
    std::cout << "Флаг \"Указана неверная команда\": " << value << "\n";

    std::cout << "\n\n" ;
    int f = 0, f_c = 0, f_o = 0;
    computer->commandEncode(0x33, 0x59, &f);
    std::cout << "Закодированная команда: "<< f << "\n";
    computer->commandDecode(f, &f_c, &f_o);
    std::cout << "Команда: "<< std::hex << f_c << "   операнд: "<< std::hex << f_o << "\n";


}

