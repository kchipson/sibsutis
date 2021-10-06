//
// Created by kchipson on 09.02.2020.
//

#include "mySimpleComputer.hpp"

SimpleComputer::SimpleComputer(){
    memoryInit() ;
    regInit() ;
}

void SimpleComputer::memoryInit (){
    for (int i = 0 ; i < MEM_SIZE ; i++)
        memory[i] = 0 ;
}

void SimpleComputer::memorySet (int address, int value){
    try
    {
        if (address < 0 || address >= MEM_SIZE){
            throw std::overflow_error("ERROR\tАдрес выходит за границу памяти!");
        }
        memory[address] = value;
    }
    catch (std::overflow_error err)
    {
        regSet(OUT_OF_MEMORY, 1) ;
        std::cout << err.what() << std::endl;
    }

}

void SimpleComputer::memoryGet (int address, int * value){
    try {
        if (address < 0 || address >= MEM_SIZE){
            throw std::overflow_error("ERROR\tАдрес выходит за границу памяти");
        }
        *value = memory[address] ;
    }
    catch (std::overflow_error err)
    {
        regSet(OUT_OF_MEMORY, 1) ;
        std::cout << err.what() << std::endl;
    }
}

void SimpleComputer::memorySave (const std::string& filename){
    std::ofstream out(filename, std::ios::binary|std::ios::out) ;
    try{
        if (!out.is_open()) {
            throw std::runtime_error("ERROR\tНе удалось открыть файл \'" + filename + "\'");
        }
        out.write((char*)&(memory), sizeof(memory)) ;
    }
    catch (std::runtime_error err)
    {
        std::cout << err.what() << std::endl;
    }

    out.close() ;
}

void SimpleComputer::memoryLoad (const std::string& filename){
    std::ifstream in(filename, std::ios::binary|std::ios::out) ;
    try{
        if (!in.is_open()) {
            throw std::runtime_error("ERROR\tНе удалось открыть файл \'" + filename + "\'");
        }
        in.read((char*)&(memory), sizeof(memory)) ;
    }
    catch (std::runtime_error err)
    {
        std::cout << err.what() << std::endl ;
    }

    in.close() ;
}

void SimpleComputer::regInit(){
    regFLAGS = 0 ;
}

void SimpleComputer::regSet (int reg, int value){
    try{
        if (reg < 0 || reg >= REG_SIZE)
            throw std::overflow_error("ERROR\tНедопустимый регистр") ;
        if (value != 0 && value != 1)
            throw std::invalid_argument("ERROR\tНекорректное значение, допустимы: 0, 1") ;

        value == 1 ? (regFLAGS |= (1 << reg)) : (regFLAGS &= ~(1 << reg)) ;
    }
    catch (std::exception err)
    {
        std::cout << err.what() << std::endl ;
    }

}

void SimpleComputer::regGet (int reg, int *value){
    try {
        if (reg < 0 || reg >= REG_SIZE)
            throw std::overflow_error("Недопустимый регистр") ;
        (regFLAGS & (1 << reg)) ? *value = 1 : *value = 0 ;
    }
    catch (std::overflow_error err)
    {
        std::cout << err.what() << std::endl ;
    }
}

void SimpleComputer::commandEncode (int command, int operand, int * value){
    try {
        if (!(command > 0x9 && command < 0x12) && !(command > 0x19 && command < 0x22) && !(command > 0x29 && command < 0x34) && !(command > 0x39 && command < 0x77))
            throw std::invalid_argument("ERROR\tНедопустимая команда") ;
        if ((operand < 0) || (operand >= 128))
            throw std::invalid_argument("ERROR\tНедопустимый операнд") ;
        * value =  0 ;
        /* Операнд */
        for (int i = 0 ; i < 7 ;  i++) {
            int bit = (operand >> i) & 1;
            *value |= (bit << i);
        }
        /* Команда */
        for (int i = 0 ; i < 7 ;  i++) {
            int8_t bit = (command >> i) & 1;
            *value |= (bit << (i + 7));
        }
    }
    catch (std::invalid_argument err){
        std::cout << err.what() << std::endl;
    }

}

void SimpleComputer::commandDecode (int value, int * command, int * operand){
    try {
        int tmpCom = 0, tmpOp  = 0 ;
        if ((value >> 14) & 1)
            throw std::invalid_argument("ERROR\tНе является командой");

        for (int i = 0 ; i < 7 ; i++) {
            int bit = (value >> i) & 1;
            tmpOp |= (bit << i);
        }

        for (int i = 0 ; i < 7 ; i++) {
            int bit = (value >> (i + 7)) & 1;
            tmpCom |= (bit << i);
        }

        if (!(tmpCom > 0x9 && tmpCom < 0x12) && !(tmpCom > 0x19 && tmpCom < 0x22) && !(tmpCom > 0x29 && tmpCom < 0x34) && !(tmpCom > 0x39 && tmpCom < 0x77))
            throw std::invalid_argument("ERROR\tНе удалось декодировать команду") ;
        if ((tmpOp < 0) || (tmpOp >= 128))
            throw std::invalid_argument("ERROR\tНе удалось декодировать операнд") ;

        * command = tmpCom ;
        * operand = tmpOp ;
    }
    catch (std::invalid_argument err){
        regSet(INCORRECT_COMMAND, 1) ;
        std::cout << err.what() << std::endl;
    }

}
