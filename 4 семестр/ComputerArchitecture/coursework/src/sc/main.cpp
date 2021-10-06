//
// Created by kchipson on 23.04.2020.
//
//
#include <signal.h>

#include "simpleComputer.hpp"
#include "myUI.hpp"
#include "myReadkey.hpp"
#include "myCU.hpp"

void signalHandler(int signal) ;

#include <iostream>

int main(int argc, char const *argv[]){
    ui_initial() ;
    signal(SIGALRM, signalHandler) ;
    signal(SIGUSR1, signalHandler) ;
    bool zero, out, ignor, comm ;
    keys key;
    
    if (argc == 2){
        sc_memoryLoad((char *)argv[1]) ;
    }
    else if (argc > 2){
        ui_messageOutput((char *)"Exceeded the number of arguments", colors::RED) ; 
        return -1 ;
    }

    do {
        sc_regGet(IGNORING_TACT_PULSES, &ignor);
        ui_update() ;
        rk_readKey(&key);
        if (ignor){
            sc_regGet(DIVISION_ERR_BY_ZERO, &zero) ;
            sc_regGet(OUT_OF_MEMORY, &out) ;
            sc_regGet(INCORRECT_COMMAND, &comm) ;
            if (zero || out || comm){
                switch(key){
                    case keys::KEY_L:
                        ui_initial() ;
                        ui_loadMemory() ;
                        break ;
                    case keys::KEY_S:
                        ui_saveMemory() ;
                        break ;
                    case keys::KEY_I:
                        raise(SIGUSR1) ;
                        break ;
                }
            }
            else{
                switch(key){
                    case keys::KEY_UP:
                        ui_moveCurrMemPointer(keys::KEY_UP) ;
                        break ;
                    case keys::KEY_RIGHT:
                        ui_moveCurrMemPointer(keys::KEY_RIGHT) ;
                        break ;
                    case keys::KEY_DOWN:
                        ui_moveCurrMemPointer(keys::KEY_DOWN) ;
                        break ;
                    case keys::KEY_LEFT:
                        ui_moveCurrMemPointer(keys::KEY_LEFT) ;
                        break ;

                    case keys::KEY_L:
                        ui_initial() ;
                        ui_loadMemory() ;
                        break ;
                    case keys::KEY_S:
                        ui_saveMemory() ;
                        break ;
                    case keys::KEY_R:
                        sc_regInit() ;
                        raise(SIGALRM) ;
                        break ;
                    case keys::KEY_T:
                        setCurrMemPointer_to_ICounter() ;
                        ui_update() ;
                        CU() ;
                        break ;
                    case keys::KEY_I:
                        raise(SIGUSR1) ;
                        break ;

                    case keys::KEY_F5:
                        ui_setAccumulator() ;
                        break ;
                    case keys::KEY_F6:
                        ui_setICounter() ;
                        break ;
                    
                    case keys::KEY_ENTER:
                        ui_setMCellValue() ;
                        break ;
                }
            }
        }
        else
            if (key == keys::KEY_I)
                raise(SIGUSR1) ;

    } while(key != keys::KEY_ESC) ;

    return 0 ;
}

void signalHandler(int signal){
    switch (signal) {
        case SIGALRM:
            setCurrMemPointer_to_ICounter() ;
            ui_update() ;
            if (CU()){
                sc_regSet(IGNORING_TACT_PULSES, true);
                ui_update() ;
                alarm(0) ;
            }
            else
                alarm(1) ; // TODO: заменить (возможно) на setitimer
            rk_myTermRegime(false, 0, 0, false, false) ;
            break ;

        case SIGUSR1:
            alarm(0) ;
            ui_initial() ;
            break ;
        default:
            break ;
    }
}
