//
// Created by kchipson on 11.01.2020.
//

#include "Ship.hpp"

Ship::Ship()
{
  shipSize = 1 ;
  shipOrientation = h ;
  sunkenPart = nullptr ;
  position = nullptr ;
  generateArrays() ;
}

Ship::~Ship()
{
  delete sunkenPart;
  sunkenPart = nullptr;
  delete position;
  position = nullptr;
}

void Ship::generateArrays()
{
  delete sunkenPart;
  delete position ;
  sunkenPart = new bool[shipSize]{false} ;
  position = new coordinates[shipSize] ;
  for (uint8_t i = 0 ; i < shipSize ; i++)
    position[i].x = position[i].y = 0 ;
}

void Ship::setSize(uint8_t size)
{
  if ((size >= 1) && (size <= 4))
    shipSize = size ;
  else
  {
    std::cout << "Error[Incorrect ship size]\n" ;
    throw ;
  }
  generateArrays() ;
}

uint8_t Ship::getSize()
{
  return shipSize ;
}


void Ship::setOrientation(shipOrientationEnum orientation)
{
  shipOrientation = orientation ;
}

shipOrientationEnum Ship::getOrientation()
{
  return shipOrientation ;
}

void Ship::changeOrientation()
{
  (shipOrientation == h) ? (shipOrientation = v) : (shipOrientation = h);
}


void Ship::setCoordinates(uint8_t x, uint8_t y)
{
  if (GlobalVars::Instance().debug)
    std::cout << (int)shipSize << "-ship : " ;

  for (uint8_t i = 0 ; i < shipSize ; i++)
  {
    if (shipOrientation == h)
    {
      position[i].x = x++ ;
      position[i].y = y ;
    }
    else
    {
      position[i].x = x ;
      position[i].y = y++ ;
    }
    if (GlobalVars::Instance().debug)
      std::cout << (int)position[i].x + 1 << "," << (int)position[i].y + 1 << "   " ;
  }
  if (GlobalVars::Instance().debug)
    std::cout << "\n" ;
}

coordinates* Ship::getCoordinates()
{
  return position ;
}

bool Ship::hasCoordinates(int8_t x, int8_t y)
{
  for (uint8_t i = 0 ; i < shipSize ; i++)
    if (position[i].x == x and position[i].y == y)
      return true ;
  return false ;
}


void Ship::setSinkingPart(uint8_t x, uint8_t y)
{
  for (uint8_t i = 0 ; i < shipSize ; i++)
    if (position[i].x == x and position[i].y == y)
      sunkenPart[i] = true ;
}

int8_t Ship::findUnSunkenPart()
{
  for (uint8_t i = 0 ; i < shipSize ; i++)
    if (!sunkenPart[i])
      return i ;
  return -1 ;
}

bool Ship::isSunken()
{
  for (uint8_t i = 0 ; i < shipSize ; i++)
    if (!sunkenPart[i])
      return false ;
  return true ;
}
