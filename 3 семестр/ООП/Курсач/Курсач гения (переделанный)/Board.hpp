//
// Created by kchipson on 11.01.2020.
//

#ifndef BOARD_HPP
#define BOARD_HPP

#include "FieldCell.hpp"
#include "Ship.hpp"

class Board {
  /* Поля */
private:
  uint8_t size ;
  FieldCell** grid ;
  Ship* ships ;

  /* Конструкторы и деструкторы */
public:
  Board() ;
  ~Board() ;
  /* Методы */
public:
  uint8_t getSize() ;
  FieldCell** getGrid() ;
  Ship*getShips() ;
} ;

#endif // BOARD_HPP