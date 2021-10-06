//
// Created by kchipson on 11.12.2019.
//

#ifndef RHOMBUS_HPP
#define RHOMBUS_HPP

#include "circle.hpp"
class Rhombus: public Circle {
  /* Поля */
private:
  sf::CircleShape rhombus;

  /* Конструктор */
public:
  Rhombus(){};
  Rhombus(sf::RenderWindow* window, short int x, short int y, short int radius);

  /* Методы */
public:
  void draw();
  void rotateMove();
};

#endif // RHOMBUS_HPP
