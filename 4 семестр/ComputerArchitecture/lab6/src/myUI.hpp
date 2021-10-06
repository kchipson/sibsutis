//
// Created by kchipson on 19.05.2020.
//

#ifndef MYUI_HPP
#define MYUI_HPP

#include <string.h>
#include "myBigChars.hpp"
#include "myReadkey.hpp"
#include "SimpleComputer.hpp"

int ui_initial() ;
int ui_update() ;

int ui_moveCurrMemPointer(keys key);
int ui_setMCellValue() ;
int ui_saveMemory() ;
int ui_loadMemory() ;
int ui_setICounter() ;

int clearBuffIn() ;
#endif //MYUI_HPP
