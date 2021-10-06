//
// Created by kchipson on 11.01.2020.
//

#ifndef SHIP_HPP
#define SHIP_HPP

#include <SFML/Graphics.hpp>
#include <iostream>

#include "GlobalVars.hpp"

enum shipOrientationEnum:bool {h, v} ;

struct coordinates
{
  int8_t x ;
  int8_t y ;
} ;

class Ship {
  /* Поля */
private:
  uint8_t shipSize ; // кол-во палуб
  shipOrientationEnum shipOrientation ; // ориентация корабля
  bool *sunkenPart; // bool массив затонувших палуб
  coordinates *position ; // координаты палуб

  /* Конструкторы и деструкторы */
public:
  Ship() ;
  ~Ship() ;

  /* Методы */
private:
  void generateArrays() ;

public:
  void setSize(uint8_t size) ;
  uint8_t getSize() ;

  void setOrientation(shipOrientationEnum orientation) ;
  shipOrientationEnum getOrientation() ;
  void changeOrientation() ;

  void setCoordinates(uint8_t x, uint8_t y) ;
  coordinates *getCoordinates() ;
  bool hasCoordinates(int8_t x, int8_t y) ;

  void setSinkingPart(uint8_t x, uint8_t y) ;
  int8_t findUnSunkenPart() ;
  bool isSunken() ;
};

#endif // SHIP_HPP
