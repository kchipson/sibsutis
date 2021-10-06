//
// Created by kchip on 07.06.2020.
//
const short int MEM_SIZE = 100 ;
unsigned short int memory[MEM_SIZE] {0};

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <ctype.h>

#include "commands.hpp"

int readFile(FILE * fb) ;
int commandEncode(unsigned short int command, unsigned short int operand, unsigned short int * value) ; 
bool checkCorrectInputHEX(const char *buffer) ;

int main(int argc, char const *argv[])
{
    if (argc != 3) {
		printf("\033[38;5;196mThe number of arguments does not match the condition!\033[0m \nThe translator launch command must look like: simpleAssembler file.sa file.o, where file.sa – name of the file that contains the program in Simple Assembler, file. o-translation result\n") ;
		return -1 ;
	}
    if (strcmp(strrchr(argv[1], '.'), ".sa") != 0) {
		printf("\033[38;5;196mThe extension of the first argument, \"%s\", does not match the conditions\033[0m \nThe translator launch command must look like: simpleAssembler file.sa file.o, where file.sa – name of the file that contains the program in Simple Assembler, file. o-translation result\n", argv[1]) ;
		return -1 ;
	}

    if (strcmp(strrchr(argv[2], '.'), ".o") != 0) {
		printf("\033[38;5;196mThe extension of the second argument, \"%s\", does not match the conditions\033[0m \nThe translator launch command must look like: simpleAssembler file.sa file.o, where file.sa – name of the file that contains the program in Simple Assembler, file. o-translation result\n", argv[2]) ;
		return -1 ;
	}
    FILE * fb ;
    if (!(fb = fopen(argv[1], "r"))){
        printf("\033[38;5;196mUnable to open the \"%s\" file. \033[0m \nCheck whether the file is in the directory, as well as access rights.\n", argv[1]) ;
        return -1 ;
    }

    if (readFile(fb))
        return -1 ;
    fclose(fb) ;
    
    if (!(fb = fopen(argv[2], "wb"))){
        printf("\033[38;5;196mUnable to open the \"%s\" file. \033[0m \nCheck your access rights.\n", argv[2]) ;
        return -1 ;
    }

    fwrite(memory, sizeof(memory), 1, fb) ;
    fclose(fb) ;

    return 0 ;
}

int readFile(FILE * fb){
    char buffer[256] ;
    short int prevCell = -1, currCell ;
    unsigned short int currLine = 1, comm = 0, op = 0, res;
    char *part, *strCell; 
    while (fgets(buffer, 256, fb)) {
        /* Часть с адресом ячейки */
        part = strtok (buffer, " ") ;
        if (strlen(part) != 2){
            printf("\033[38;5;196mError | line %d\033[0m \nThe cell address number must be 2 characters long.\n", currLine) ;
            return -1 ;
        }
        for (int i = 0 ; i < 2 ; ++i)
        {
            if (part[i] < '0' || part[i] > '9'){
                printf("\033[38;5;196mError | line %d\033[0m \nThe cell number cannot consist of letters. The cell number must be entered in the 10 number system.\n", currLine) ;
                return -1 ;
            }
        }
        currCell = atoi(part);
        if (currCell <= prevCell){
            printf("\033[38;5;196mError | line %d\033[0m \nThe number of the memory address must be increasing and must not be repeated.\n", currLine) ;
            return -1 ;
        }
        else
            prevCell = currCell ; 

        /* Часть с командой */
        part = strtok (NULL, " ");
        if (strcmp(part, "READ") == 0)
            comm = READ;
        else if (strcmp(part, "WRITE") == 0)
            comm = WRITE;
        else if (strcmp(part, "LOAD") == 0)
            comm = LOAD;
        else if (strcmp(part, "STORE") == 0)
            comm = STORE;
        else if (strcmp(part, "ADD") == 0)
            comm = ADD;
        else if (strcmp(part, "SUB") == 0)
            comm = SUB;
        else if (strcmp(part, "DIVIDE") == 0)
            comm = DIVIDE;
        else if (strcmp(part, "MUL") == 0)
            comm = MUL;
        else if (strcmp(part, "JUMP") == 0)
            comm = JUMP;
        else if (strcmp(part, "JNEG") == 0)
            comm = JNEG;
        else if (strcmp(part, "JZ") == 0)
            comm = JZ;
        else if (strcmp(part, "HALT") == 0)
            comm = HALT;
        else if (strcmp(part, "RCR") == 0)
            comm = RCR;
        else if (strcmp(part, "=") == 0)
            comm = 0 ;
        else{
            printf("\033[38;5;196mError | line %d\033[0m \nUnknown command\n", currLine) ;
            return -1 ;
        }

        /* Часть с операндом */
        part = strtok (NULL, " ");
        if (part[strlen(part) - 1] == '\n') 
                part[strlen(part) - 1] = '\0' ;

        if (comm != 0){ // Если не присваивание 
            for (int i = 0 ; i < strlen(part) ; ++i)
                if (part[i] < '0' || part[i] > '9'){
                    printf("\033[38;5;196mError | line %d\033[0m \nThe operand cannot contain letters. The operand must be set in the 10 number system.\n", currLine) ;
                    return -1 ;
                }
        
            op = atoi(part) ;
            if (commandEncode((unsigned short int)((comm & 0xFF)), (unsigned short int)(op & 0xFF), &res)){
                printf("\033[38;5;196mError | line %d\033[0m \nInvalid command, the command cannot exceed 3FFF.\n", currLine) ;
                return -1 ;
            }
        }
        else{
            res = 0 ;
            int i = 0;
            if (part[0] == '+')
                i = 1 ;
            else{
                res |= (1 << 14) ;
                if (part[0] == '-') {
                    i = 1 ;
                    res |= (1 << 13) ;
                }
                else
                    i = 0 ;
            }
            
            if (!checkCorrectInputHEX(&part[i])){
                printf("\033[38;5;196mError | line %d\033[0m \nIncorrect assignment.\n", currLine) ;
                return -1 ;
            }

            long int number ;
            char * tmp ;
            number = strtol(&part[i], &tmp, 16) ;

            if (part[0] == '+') { // Если команда
                if ((number >> 8) > 0x7F){
                    printf("\033[38;5;196mError | line %d\033[0m \nThe command cannot be more than 7 bits (0x7F).\n", currLine) ;
                    return -1 ;
                }
                if ((number & 0xFF) > 0x7F){
                    printf("\033[38;5;196mError | line %d\033[0m \nThe operand cannot be more than 7 bits (0x7F).\n", currLine) ;
                    return -1 ;
                }
                unsigned short int value = 0;
                commandEncode((unsigned short int)((number >> 8)), (unsigned short int)(number & 0xFF), &value) ;
                res |= value ;
            }
            else { // Если число
                if(number > 0x2000 or (number > 0x1FFF and part[0] != '-') ){
                    printf("\033[38;5;196mError | line %d\033[0m \nThe valid range for the value of the number from -0x2000 to 0x1FFF inclusive.\n", currLine) ;
                    return -1 ;
                }
                if (part[0] == '-') {
                    number = ~number + 1 ;
                    if (!((number >> 13) & 1))
                        res &= ~(1 << 13) ;
                }
                number &= 0x1FFF ;
                res |= number ;
            }
        }

        /* Часть с комментарием */
        part = strtok (NULL, " ");
        // printf("%d %d", part[0], '\n') ;
        if (part != NULL and part[0] != ';' and part[0] != '\n'){
            printf("\033[38;5;196mError | line %d\033[0m \nThe wrong line! Invalid number of arguments or comment doesn't start with ';'\n", currLine) ;
            return -1 ; 
        }
        
        memory[currCell] = res;

		++currLine ;
	}
    return 0 ;
}

/// Кодирует команду с указанным номером и операндом и помещает результат в value
/// \param command - команда
/// \param operand - операнд
/// \param value - значение
/// \return 0 - в случае успешного выполнения, -1 - в случае ошибки
int commandEncode(unsigned short int command, unsigned short int operand, unsigned short int * value){
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

bool checkCorrectInputHEX(const char *buffer){
    if (strlen(buffer) == 0 or strlen(buffer) > 4)
        return false ;
    for (int i = 0 ; i < strlen(buffer) ; ++i)
        if (!(isxdigit(buffer[i])))
            return false ;
    return true ;
}