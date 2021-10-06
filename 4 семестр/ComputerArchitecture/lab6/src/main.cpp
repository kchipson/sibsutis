//
// Created by kchipson on 23.04.2020.
//
//
#include <signal.h>

#include "SimpleComputer.hpp"
#include "myUI.hpp"
#include "myReadkey.hpp"

void signalHandler(int signal) ;

int main(){
//    char filename[10] ;
//    sc_memoryInit();
//    fgets(filename, 10, stdin) ;
//    sc_memorySave(filename);
//    return 0 ;

    ui_initial() ;
    signal(SIGALRM, signalHandler) ;
    signal(SIGUSR1, signalHandler) ;

    keys key;
    do {
        ui_update() ;
        rk_readKey(&key);
        switch(key){
            case keys::KEY_UP:    ui_moveCurrMemPointer(keys::KEY_UP) ; break ;
            case keys::KEY_RIGHT: ui_moveCurrMemPointer(keys::KEY_RIGHT) ; break ;
            case keys::KEY_DOWN:  ui_moveCurrMemPointer(keys::KEY_DOWN) ; break ;
            case keys::KEY_LEFT:  ui_moveCurrMemPointer(keys::KEY_LEFT) ; break ;

            case keys::KEY_L:     ui_loadMemory() ; break ;
            case keys::KEY_S:     ui_saveMemory() ; break ;

            case keys::KEY_R:     break ;
            case keys::KEY_T:     break ;
            case keys::KEY_I:     raise(SIGUSR1) ; break ;

            case keys::KEY_F5:    break ;
            case keys::KEY_F6:    ui_setICounter() ; break ;

            case keys::KEY_ENTER: ui_setMCellValue() ; break ;

        }
    } while(key != KEY_ESC) ;

    return 0 ;
}

void signalHandler(int signal){
    switch (signal) {
        case SIGALRM:
            break ;
        case SIGUSR1:
            alarm(0) ;
            sc_regInit() ;
            sc_regSet(IGNORING_TACT_PULSES, true) ;
            sc_instructionCounter = 0 ;
            break ;
        default:
            break ;
    }

}
