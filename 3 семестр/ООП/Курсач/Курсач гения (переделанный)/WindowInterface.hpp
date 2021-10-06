//
// Created by kchipson on 11.01.2020.
//

#ifndef WINDOWINTERFACE_HPP
#define WINDOWINTERFACE_HPP


#include "SFML/Graphics.hpp"

class WindowInterface
{
public:
  WindowInterface();
  virtual ~WindowInterface();

  virtual int draw(sf::RenderWindow& window) = 0;
};

#endif // WINDOWINTERFACE_HPP
