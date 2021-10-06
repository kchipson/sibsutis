//
// Created by kchipson on 11.01.2020.
//

#include "Board.hpp"

Board::Board()
{
  size = 10 ;

  grid = new FieldCell*[size] ;
  for (uint8_t i = 0 ; i < size ; ++i)
    grid[i] = new FieldCell[size];

  ships = new Ship[size];

}
Board::~Board()
{
  for (uint8_t i = 0 ; i < size ; ++i)
    delete grid[i] ;
  delete[] grid ;
  grid = nullptr ;
  delete[] ships ;
  ships = nullptr ;
}

uint8_t Board::getSize()
{
  return size ;
}

FieldCell** Board::getGrid()
{
  return grid ;
}

Ship* Board::getShips()
{
  return ships ;
}

